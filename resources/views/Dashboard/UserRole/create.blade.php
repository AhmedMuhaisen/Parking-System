@extends('Dashboard.UserRole.form')

@section('title_form', 'Create Role_User')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.role.update') }}" method="post">
        @csrf
          @method('put')
    @endsection
