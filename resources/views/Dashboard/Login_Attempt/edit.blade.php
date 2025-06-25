@extends('Dashboard.Login_Attempt.form')
@section('title_form', 'Edit Login_Attempt')
@section('form')
    <form action="{{ route('Dashboard.login_attempt.update', $login_attempt->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
