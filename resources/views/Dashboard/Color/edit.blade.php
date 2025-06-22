@extends('Dashboard.color.form')
@section('title_form', 'Edit color')

@section('form')
    <form action="{{ route('Dashboard.color.update', $color->id) }}" method="post">
        @csrf
        @method('put')
    @endsection
