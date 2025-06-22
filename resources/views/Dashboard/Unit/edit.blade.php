@extends('Dashboard.Unit.form')
@section('title_form', 'Edit Unit')
@section('form')
    <form action="{{ route('Dashboard.unit.update', $unit->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
