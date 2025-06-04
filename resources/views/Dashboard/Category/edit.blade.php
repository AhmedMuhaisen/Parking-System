@extends('Dashboard.Category.form')
@section('title_form', 'Edit Category')
@section('form')
    <form action="{{ route('Dashboard.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
