@extends('Dashboard.Register_Request.form')

@section('title_form', 'Create register_request')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.register_request.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
