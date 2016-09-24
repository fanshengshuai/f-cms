'use strict';
//加载Node的Path模块
var path = require('path');
//加载Node的fs模块
var fs = require('fs');
//加载webpack模块
var webpack = require('webpack');

//srcDir为当前开发目录(/src)
var srcDir = path.resolve(process.cwd(), 'assets-src');
//distDir为当前建立目录(/assets)
var distDir = path.join(__dirname, 'dist');

//加载自动化css独立加载插件
var ExtractTextPlugin = require('extract-text-webpack-plugin');
//加载自动化HTML自动化编译插件
var HtmlWebpackPlugin = require('html-webpack-plugin');

//加载JS模块压缩编译插件
var UglifyJsPlugin = webpack.optimize.UglifyJsPlugin;
//加载公用组件插件
var CommonsChunkPlugin = webpack.optimize.CommonsChunkPlugin;
//设置需要排除单独打包的插件
var singleModule = ['react', 'react-dom', 'jquery'];
//postcss辅助插件
var postcssImport = require('postcss-import');
//排除的页面入口js
var jsExtract = [];


// definePlugin 接收字符串插入到代码当中, 所以你需要的话可以写上 JS 的字符串
var definePlugin = new webpack.DefinePlugin({
    __DEV__: JSON.stringify(JSON.parse(process.env.BUILD_DEV || 'true')),
    __PRERELEASE__: JSON.stringify(JSON.parse(process.env.BUILD_PRERELEASE || 'false'))
});


//if (__DEV__) {
//    console.warn('Extra logging');
//}


//获取本级IP 以方便手机端测试使用
function getIPAddress() {
    var interfaces = require('os').networkInterfaces();
    for (let devName in interfaces) {
        var iface = interfaces[devName];
        for (var i = 0; i < iface.length; i++) {
            var alias = iface[i];
            if (alias.family === 'IPv4' && alias.address !== '127.0.0.1' && !alias.internal) {
                return alias.address;
            }
        }
    }
}

//加载webpack目录参数配置
var config = {
    build: {
        srcDir: srcDir, distDir: distDir
    },
    devtool: 'cheap-module-eval-source-map',
    entry: getEntry(),
    output: {
        path: distDir,
        filename: 'res/js/[name].[chunkhash:8].min.js',
        publicPath: 'http://' + getIPAddress() + ':3000/'
    }
    ,
    plugins: [
        definePlugin,
        //排除css压缩加载在页面
        new ExtractTextPlugin('res/css/[name].css'),
        //合并额外的js包
        new CommonsChunkPlugin('lib', './res/js/common.js', jsExtract),
        new webpack.HotModuleReplacementPlugin(),
        new webpack.NoErrorsPlugin(),
        new webpack.ProvidePlugin({
            $: 'jquery'
        })
    ],
    module: {
        //加载器配置
        loaders: [{
            test: /\.css$/,
            exclude: path.resolve(__dirname, 'assets-src/css/common'),
            loaders: [
                'style-loader',
                'css',
                //'css-loader?modules&localIdentName=[name]__[local]___[hash:base64:5]&sourceMap&importLoaders=1',
                'postcss-loader?sourceMap=true'
            ]
        }, {
            test: /\.jsx?$/,
            loaders: ['react-hot', 'babel?presets[]=react,presets[]=es2015'],
            exclude: /node_modules/
        }, {
            test: /\.(png|jpeg|jpg|gif)$/,
            loader: 'file?name=dist/img/[name].[ext]'
        }, {
            test: /\.(woff|eot|ttf)$/i,
            loader: 'url?limit=10000&name=dist/fonts/[name].[ext]'
        }, {
            test: /\.json$/,
            loader: 'json'
        }]
    }
    ,
    postcss: function (webpack) {
        return [
            postcssImport({
                addDependencyTo: webpack
            }),
            require('postcss-display-inline-block'),
            require('autoprefixer'),
            require('precss')
        ];
    }
};

if (process.env.NODE_ENV === 'production') {
    config.plugins = [
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        }),
        new webpack.optimize.OccurenceOrderPlugin()
    ]
} else {
    config.devtool = '#source-map'
}

//设置入口文件
function getEntry() {
    var jsDir = path.resolve(srcDir, '');
    var names = fs.readdirSync(jsDir);
    var map = {};
    names.forEach(function (name) {
        var m = name.match(/(.+)\.js$/);
        var entry = m ? m[1] : '';
        var entryPath = entry ? path.resolve(jsDir, name) : '';
        var entryArr = [];
        entryArr.push(entryPath);
        entryArr.push('eventsource-polyfill');
        entryArr.push('webpack-hot-middleware/client');
        jsExtract.push(name);
        if (entry) {
            jsExtract.push(name.substring(0, name.length - 3));
            map[entry] = entryArr;
        }
    });
    //自定义额外加载包,不会合并在页面对应js中
    map['lib'] = singleModule;
    return map;
}

var pages = fs.readdirSync(srcDir);
pages.forEach(function (filename) {
    var m = filename.match(/(.+)\.html$/);
    if (m) {
        var conf = {
            template: path.resolve(srcDir, filename),
            inject: true, //允许插件修改哪些内容，包括head与body
            hash: true, //为静态资源生成hash值
            minify: { //压缩HTML文件
                removeComments: true, //移除HTML中的注释
                collapseWhitespace: false //删除空白符与换行符
            },
            filename: filename
        };

        if (m[1] in config.entry) {
            conf.chunks = ['vendors', m[1]];
        }

        config.plugins.push(new HtmlWebpackPlugin(conf));
    }
});

module.exports = config;
