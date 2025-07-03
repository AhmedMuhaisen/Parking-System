@extends('Dashboard.Notification_System.form')

@section('title_form', 'Create notification_system')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.notification_system.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
