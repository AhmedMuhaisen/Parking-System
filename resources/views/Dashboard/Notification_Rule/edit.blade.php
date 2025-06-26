@extends('Dashboard.Notification_Rule.form')
@section('title_form', 'Edit notification_rule')
@section('form')
    <form action="{{ route('Dashboard.notification_rule.update', $notification_rule->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    @endsection
