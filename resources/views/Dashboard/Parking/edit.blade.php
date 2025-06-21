@extends('Dashboard.Parking.form')
@section('title_form', 'Edit Parking')
@section('form')
    <form action="{{ route('Dashboard.parking.update', $parking->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
