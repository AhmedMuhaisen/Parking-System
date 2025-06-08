@extends('dashboard.VehiclesType.form')

@section('title_form', 'Create vehiclesType')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.vehiclesType.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
