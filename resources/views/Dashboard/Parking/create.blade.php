@extends('dashboard.Parking.form')

@section('title_form', 'Create Parking')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.parking.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
