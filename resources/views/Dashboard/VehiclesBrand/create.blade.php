@extends('Dashboard.VehiclesBrand.form')

@section('title_form', 'Create Vehicles Brands')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.vehiclesBrand.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
