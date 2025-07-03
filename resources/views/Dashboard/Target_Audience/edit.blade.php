@extends('Dashboard.Target_Audience.form')
@section('title_form', 'Edit target_audience')

@section('form')
    <form action="{{ route('Dashboard.target_audience.update', $target_audience->id) }}" method="post">
        @csrf
        @method('put')
    @endsection
