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
</script>
@endsection