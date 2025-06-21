@extends('Dashboard.permission.form')
@section('title_form', 'Edit Permission')

@section('form')
    <form action="{{ route('Dashboard.permission.update', $permission->id) }}" method="post">
        @csrf
        @method('put')
    @endsection
