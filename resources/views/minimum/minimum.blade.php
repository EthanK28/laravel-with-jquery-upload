<!DOCTYPE HTML>
<html>
<head>

    <title>jQuery File Upload Example</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
<input id="fileupload" type="file" name="file" data-url="/jqupload" multiple>
<p>

</p>
<script src="/lib/bower/jquery/dist/jquery.js"></script>
<script src="/lib/bower/blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="/lib/bower/blueimp-file-upload/js/jquery.iframe-transport.js"></script>
<script src="/lib/bower/blueimp-file-upload/js/jquery.fileupload.js"></script>
<script>
    $(function () {
        $('#fileupload').fileupload({
//            url: '/apply/upload',
            dataType: 'json',
            formAcceptCharset : 'utf-8',
            add: function (e, data) {
                console.log(data);
                data.context = $('<p/>').text('Uploading...').appendTo(document.body);
                data.submit();
            },
            done: function (e, data) {
                console.log(data);
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo(document.body);
                    console.log(file.name);
                });





            }
        });
    });
</script>
</body>
</html>