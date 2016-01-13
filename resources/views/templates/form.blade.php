<div class="row">
    <div class="col-md-12">

        {{ Former::open_for_files()->id('inst_create')->rules(['title' => 'required'])->method('post') }}
        {{ Former::text('title')->autofocus()->help('Title of the institution') }}
        {{ Former::text('body')->label('Top Welcome Message') }}
        {{ Former::text('topcolor')->label('Top color')->class('form-control minicolors') }}
        {{ Former::text('topfontcolor')->label('Top Text color')->class('form-control minicolors') }}
        <div class="form-group">
            <label for="" class="control-label col-lg-2 col-sm-4">Logo Upload</label>
            <div class="col-lg-10 col-sm-8">
                @include('uploads.form')
            </div>
        </div>
        {{ Former::textarea('extracomments')->label('Extra Comments') }}
        {{   Former::actions()->large_primary_submit('Submit')
        ->large_inverse_reset('Delete') }}
        {{Former::close()}}
        <div id="addjunk"></div>
    </div>
</div>

<script>
    $(function () {
        'use strict';
        var jupload = $('#fileupload');
        // Initialize the jQuery File Upload widget:
        jupload.fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: '/upload/store'
        });

        // from http://stackoverflow.com/a/21728472
        if (typeof existingfiles !== 'undefined'){
            jupload.fileupload('option', 'done').call(jupload, $.Event('done'), {result: existingfiles});
        };

    });
</script>