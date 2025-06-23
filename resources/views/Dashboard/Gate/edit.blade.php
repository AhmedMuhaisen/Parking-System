@extends('Dashboard.Gate.form')
@section('title_form', 'Edit Gate')
@section('form')
    <form action="{{ route('Dashboard.gate.update', $gate->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
