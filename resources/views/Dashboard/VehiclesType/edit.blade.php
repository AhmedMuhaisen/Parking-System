@extends('Dashboard.VehiclesType.form')
@section('title_form', 'Edit vehiclesType')
@section('form')
    <form action="{{ route('Dashboard.vehiclesType.update', $vehiclesType->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
