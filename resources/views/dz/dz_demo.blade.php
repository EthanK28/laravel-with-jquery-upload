<!DOCTYPE html>
<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">

    <form id="upload" action="{{url('dropzone/uploadFiles')}}" class="dropzone">
        {!! csrf_field() !!}
    </form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

<script type="text/javascript">

//    Dropzone.autoDiscover = false;
//    Dropzone.options.upload = false;
    //    var myDropzone = new Dropzone("#upload", {
    //        init: function() {
    //            thisDropzone = this;
    //            this.on("success", function(file, responseText) {
    //                var responseText = file.id; // or however you would point to your assigned file ID here;
    //                console.log(responseText); // console should show the ID you pointed to
    //                console.log("성공");
    //                // do stuff with file.id ...
    //            });
    //        }
    ////        accept: function(file, done) {
    ////            if (file.name == "justinbieber.jpg") {
    ////                done("완료");
    ////            } else {
    ////                done("실패");
    ////            }
    ////        }
    //    });


    Dropzone.options.upload = {
        init: function () {
            thisDropzone = this;
            this.on("success", function (file, responseText) {
                var responseText = file.id; // or however you would point to your assigned file ID here;
                console.log(responseText); // console should show the ID you pointed to
                console.log("성공");
                // do stuff with file.id ...
            });
            this.on("addedfile", function(file) { alert("Added file."); });
        },
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 15, // MB
        addRemoveLinks: true
    };

    //    Dropzone.prototype.events = ["drop", "dragstart", "dragend", "dragenter", "dragover", "dragleave", "addedfile", "removedfile", "thumbnail", "error", "errormultiple", "processing", "processingmultiple", "uploadprogress", "totaluploadprogress", "sending", "sendingmultiple", "success", "successmultiple", "canceled", "canceledmultiple", "complete", "completemultiple", "reset", "maxfilesexceeded", "maxfilesreached", "queuecomplete"];
</script>
</body>
</html>