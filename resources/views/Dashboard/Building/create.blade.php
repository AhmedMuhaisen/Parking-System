@extends('Dashboard.Building.form')

@section('title_form', 'Create Building')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.building.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
