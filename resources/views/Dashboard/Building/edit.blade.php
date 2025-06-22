@extends('Dashboard.Building.form')
@section('title_form', 'Edit Building')
@section('form')
    <form action="{{ route('Dashboard.building.update', $building->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
