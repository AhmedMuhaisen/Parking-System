@extends('Dashboard.Message.form')
@section('title_form', 'Edit Message')
@section('form')
    <form action="{{ route('Dashboard.message.update', $message->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
