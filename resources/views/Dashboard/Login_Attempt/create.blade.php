@extends('Dashboard.Login_Attempt.form')

@section('title_form', 'Create Login_Attempt')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.login_attempt.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
