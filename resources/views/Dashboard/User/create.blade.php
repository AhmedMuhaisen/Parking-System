@extends('Dashboard.user.form')

@section('title_form', 'Create user')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
