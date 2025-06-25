@extends('Dashboard.Camera.form')

@section('title_form', 'Create Camera')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.camera.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
