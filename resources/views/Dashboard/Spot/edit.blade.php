@extends('Dashboard.Spot.form')
@section('title_form', 'Edit Spot')
@section('form')
    <form action="{{ route('Dashboard.spot.update', $spot->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
