@extends('Dashboard.Target_Audience.form')

@section('title_form', 'Create target_audience')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.target_audience.store') }}" method="post">
        @csrf
    @endsection
