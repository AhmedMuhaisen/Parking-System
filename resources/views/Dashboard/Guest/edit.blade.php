@extends('Dashboard.Guest.form')
@section('title_form', 'Edit Guest')
@section('form')
    <form action="{{ route('Dashboard.guest.update', $guest->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
