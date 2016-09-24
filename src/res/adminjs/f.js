String.prototype.replaceAll = function (e, t) {
    return this.replace(new RegExp(e, "gm"), t)
};

jQuery.browser = {msie: false, version: 0};
if (navigator.userAgent.match(/MSIE ([0-9]+)./)) {
    jQuery.browser.msie = true;
    jQuery.browser.version = RegExp.$1;
}

if (typeof console == 'undefined') {
    console = {
        log: function () {
        }
    };
}

define('jquery', [], function () {
    console && console.log('Flib: jQuery has build in, enjoy!');
    return jQuery;
});
define('angular', [], function () {
    console && console.log('Flib: angular has build in, enjoy!');
    return angular;
});

require.config({
        baseUrl: '/res/js/',
        paths: {
            //angular: "../lib/angular/1.4.6/angular.min",
            "angular.ui.router": "../lib/angular/angular-ui-router"
            //"angular.animate": "angular-animate/angular-animate",
            //"jquery": "jquery-1.8.2.min",
            //"jquery": "../res/js/jquery/1.11.3/jquery.min",
            //"jquery.cookie": "jquery.cookie",
            //underscore: "underscore/underscore-min",
            //'jBox': '/Style/JBox/jquery.jBoxConfig',
            //'jquery.ui-tab': '/Style/Js/ui.tabs',
            //'jquery.ui-widget': '/js/jquery.ui.widget'
        },
        shim: {
            //angular: {exports: "angular"},
            //"angular.animate": ["angular"],
            "angular.ui.router": ["angular"]
            //"jquery.cookie": {deps: ["jquery"], exports: 'jquery.cookie'},
            //'jBox': ['/Style/JBox/jquery.jBox.min.js'],
            //'jquery.ui-widget': ['/Style/Js/ui.core.js'],
            //'jquery.ui-tab': {deps: ['jquery.ui-widget']}
        }
    }
);

define('jquery.cookie', [], function () {
    console && console.log('Flib: jQuery.cookie has build in, enjoy!');

    return jQuery.cookie;
});

//var init_js = ['angular'];
var module = null;

require(['angular'], function (angular) {
    //console.log(angular);
    $.browser = [];
    $.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());

    //window.module = angular.module('f', [])
    //if (F.init_angular) {
        //angularModule = angular.module("f", ["ui.router"]);
        //(typeof F != 'undefined' &&
        //require(F.page_script, function () {
            angular.element(document).ready(function () {
                window.module = angular.module('f', []);
                //angular.bootstrap(document, ["f"]);
            });
        //}));
    //} else {
        (typeof F != 'undefined' &&
        require(F.page_script, function () {
            angular.bootstrap(document, ["f"]);
        }));
    //}
});