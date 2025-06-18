@extends('Dashboard.user.form')
@section('title_form', 'Edit user')
@section('form')
    <form action="{{ route('Dashboard.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
