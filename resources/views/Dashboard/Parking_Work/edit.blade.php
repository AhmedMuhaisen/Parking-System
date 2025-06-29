@extends('Dashboard.Parking_Work.form')
@section('title_form', 'Edit Parking Work')
@section('form')
    <form action="{{ route('Dashboard.parking_work.update', $parking_work->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
