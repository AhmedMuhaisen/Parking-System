@extends('Dashboard.Camera.form')
@section('title_form', 'Edit Camera')
@section('form')
    <form action="{{ route('Dashboard.camera.update', $camera->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
