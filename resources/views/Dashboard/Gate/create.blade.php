@extends('Dashboard.Gate.form')

@section('title_form', 'Create Gate')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.gate.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
