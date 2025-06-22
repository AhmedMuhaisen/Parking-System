@extends('Dashboard.color.form')

@section('title_form', 'Create color')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.color.store') }}" method="post">
        @csrf
    @endsection
