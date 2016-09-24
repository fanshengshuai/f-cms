<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="/res/lib/webuploader/0.1.5/webuploader.css">

<!--引入JS-->
<script type="text/javascript" src="/res/lib/webuploader/0.1.5/webuploader.js"></script>

<div id="uploader" class="wu-example">
    <!--用来存放文件信息-->
    <div id="thelist" class="uploader-list"></div>
    <div class="btns">
        <div id="picker">选择文件</div>
        <button id="ctlBtn" class="btn btn-default">开始上传</button>
    </div>
</div>


<div class="file_upload_1"></div>
<script type="text/javascript">
    $(function () {
        var $ = jQuery,
            $list = $('#thelist'),
            $btn = $('#ctlBtn'),
            state = 'pending',
            uploader;

        uploader = WebUploader.create({
            swf: '/res/lib/webuploader/0.1.5/Uploader.swf',
            server: '/admin/delivery/import',
            pick: '#picker',
//                    accept: {
//                        title: 'Excel csv',
//                        extensions: 'csv',
//                        mimeTypes: 'text/comma-separated-values'
//                    },
            resize: false
        });
        // 当有文件被添加进队列的时候
        uploader.on('fileQueued', function (file) {
            $list.append('<div id="' + file.id + '" class="item">' +
                '<h4 class="info">' + file.name + '</h4>' +
                '<p class="state">等待上传...</p>' +
                '</div>');
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on('uploadProgress', function (file, percentage) {
            var $li = $('#' + file.id),
                $percent = $li.find('.progress .progress-bar');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<div class="progress progress-striped active">' +
                    '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                    '</div>' +
                    '</div>').appendTo($li).find('.progress-bar');
            }

            $li.find('p.state').text('上传中');

            $percent.css('width', percentage * 100 + '%');
        });
        uploader.on('uploadSuccess', function (file) {
            console.log(file);
            $('#' + file.id).find('p.state').text('已上传');
        });

        uploader.on('uploadError', function (file) {
            $('#' + file.id).find('p.state').text('上传出错');
        });

        uploader.on('uploadComplete', function (file) {
            $('#' + file.id).find('.progress').fadeOut();
        });


        $btn.on('click', function () {
            if (state === 'uploading') {
                uploader.stop();
            } else {
                uploader.upload();
            }
        });


    });
</script>