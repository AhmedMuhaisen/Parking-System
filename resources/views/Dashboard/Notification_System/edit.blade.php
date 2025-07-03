@extends('Dashboard.Notification_System.form')
@section('title_form', 'Edit notification_system')
@section('form')
    <form action="{{ route('Dashboard.notification_system.update', $notification_system->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
