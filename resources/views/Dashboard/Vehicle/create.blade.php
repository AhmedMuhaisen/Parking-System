@extends('Dashboard.Vehicle.form')

@section('title_form', 'Create Vehicle')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.vehicle.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
