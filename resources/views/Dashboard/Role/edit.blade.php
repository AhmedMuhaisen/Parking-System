@extends('Dashboard.role.form')
@section('title_form', 'Edit Role')

@section('form')
    <form action="{{ route('Dashboard.role.update', $role->id) }}" method="post">
        @csrf
        @method('put')
    @endsection
