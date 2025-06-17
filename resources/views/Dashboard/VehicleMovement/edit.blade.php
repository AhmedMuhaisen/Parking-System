@extends('Dashboard.VehicleMovement.form')
@section('title_form', 'Edit VehicleMovement')
@section('form')
    <form action="{{ route('Dashboard.vehicleMovement.update', $vehicleMovement->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
