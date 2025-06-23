@extends('Dashboard.Guest.form')

@section('title_form', 'Create Guest')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.guest.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
