@extends('dashboard.Category.form')

@section('title_form', 'Create Category')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
