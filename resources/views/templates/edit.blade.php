@extends('templates.main')

@section('title')
    Create Institution
@endsection

@section('content')
<div class="page-header">
    <h1 class="text-center">Create Institution</h1>
</div>
{{ Former::populate( $institution ) }}
@include('institutions.form')
<script>
    var existingfiles = {{$json}};
    // from http://stackoverflow.com/a/21728472
    if (typeof existingfiles !== 'undefined'){
        jupload.fileupload('option', 'done').call(jupload, $.Event('done'), {result: existingfiles});
    };
</script>


@endsection
