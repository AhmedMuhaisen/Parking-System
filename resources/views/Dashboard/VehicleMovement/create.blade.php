@extends('Dashboard.VehicleMovement.form')

@section('title_form', 'Create VehicleMovement')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.vehicleMovement.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
