@extends('Dashboard.Message.form')

@section('title_form', 'Create Message')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.message.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
