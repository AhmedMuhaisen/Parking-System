@extends('Dashboard.Permission.form')

@section('title_form', 'Create Permission')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.permission.store') }}" method="post">
        @csrf
    @endsection
