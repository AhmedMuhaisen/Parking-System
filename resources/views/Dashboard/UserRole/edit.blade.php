@extends('Dashboard.UserRole.form')
@section('title_form', 'User_Role')

@section('form')
    <form action="{{ route('Dashboard.user_role.update') }}" method="post">
        @csrf
        @method('put')
    @endsection
