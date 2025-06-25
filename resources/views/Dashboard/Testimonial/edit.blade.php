@extends('Dashboard.Testimonial.form')
@section('title_form', 'Edit Testimonial')
@section('form')
    <form action="{{ route('Dashboard.testimonial.update', $testimonial->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
