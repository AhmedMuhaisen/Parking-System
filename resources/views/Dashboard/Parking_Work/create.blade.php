@extends('Dashboard.Parking_Work.form')

@section('title_form', 'Create Parking Work')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.parking_work.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
