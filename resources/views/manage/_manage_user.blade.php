@extends('layouts.app')

@section('content')
<div class="container">
    <manage-user link_register="{{ route('users.create') }}"
    errors="{{ json_encode($errors->all()) }}"
    error="{{ Session::get('error') }}"
    success="{{ Session::get('success') }}"

    ></manage-user>
</div>
@endsection
