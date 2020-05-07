@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @dd(Auth::user()); --}}
    <edit-user-component 
        link_edit="{{ route('users.edit', [$id]) }}"
        errors="{{ json_encode($errors->all()) }}"
        error="{{ Session::get('error') }}"
        success="{{ Session::get('success') }}"
        :auth_user="{{ Auth::user() }}"
        :user_roles="{{ $roles }}"

    ></edit-user-component>
</div>
@endsection
