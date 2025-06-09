@extends('Dashboard.Vehicle.form')
@section('title_form', 'Edit Vehicle')
@section('form')
    <form action="{{ route('Dashboard.vehicle.update', $vehicle->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
