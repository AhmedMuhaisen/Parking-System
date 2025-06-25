@extends('Dashboard.Testimonial.form')

@section('title_form', 'Create Testimonial')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.testimonial.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
