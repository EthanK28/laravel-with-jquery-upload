@extends('templates.main') <!-- this is just header,footer, css & js-->

@section('title')
    Create Institution
@endsection

@section('content')

    <div class="page-header">
        <h1 class="text-center">Create Institution</h1>
    </div>

    @include('institutions.form')

@endsection