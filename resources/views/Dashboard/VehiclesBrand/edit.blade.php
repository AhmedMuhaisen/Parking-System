@extends('Dashboard.VehiclesBrand.form')
@section('title_form', 'Edit vehiclesBrand')
@section('form')
    <form action="{{ route('Dashboard.vehiclesBrand.update', $vehiclesBrand->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
