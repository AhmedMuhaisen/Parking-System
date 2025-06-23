@extends('Dashboard.Spot.form')

@section('title_form', 'Create Spot')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.spot.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
