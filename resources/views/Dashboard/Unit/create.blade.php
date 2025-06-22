@extends('Dashboard.Unit.form')

@section('title_form', 'Create Unit')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.unit.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
