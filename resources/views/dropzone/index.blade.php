<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <script src="/lib/bower/jquery/dist/jquery.js"></script>
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">


</head>
<body>


<p>
    {{ Config::get('images.full_size') }}
    This is the most minimal example of Dropzone. The upload in this example
    doesn't work, because there is no actual server to handle the file upload.
</p>

<!-- Change /upload-target to your upload address -->
{{--<form action="{{ url('dropzone/upload') }}" class="dropzone"></form>--}}

<form id="mydropzone" class="dropzone"></form>


<script>

    Dropzone.options.myDropZone = {

    };
    $(function () {
        var myDropzone = new Dropzone("#mydropzone", {
                url: "/dropzone/upload",
                headers: {
                    'X-CSRF-Token': $('meta[name="token"]').attr('content')
                }
            }
        );


    });

</script>
</body>
</html>

