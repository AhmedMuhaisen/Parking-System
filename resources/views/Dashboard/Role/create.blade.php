@extends('Dashboard.role.form')

@section('title_form', 'Create Role')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.role.store') }}" method="post">
        @csrf
    @endsection
