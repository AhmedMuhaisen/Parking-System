@extends('Dashboard.Notification_Rule.form')

@section('title_form', 'Create notification_rule')
<!-- General Form Elements -->
@section('form')
    <form action="{{ route('Dashboard.notification_rule.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @endsection
