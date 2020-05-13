@extends('layouts.app')

@section('content')
<div class="container">

    <edit-user-component 
        errors="{{ json_encode($errors->all()) }}"
        error="{{ Session::get('error') }}"
        success="{{ Session::get('success') }}"
        :auth_user="{{ Auth::user() }}"
        :user_roles="{{ json_encode($roles) }}"
        link_update="{{ route('users.update', [$id]) }}"
    >
    
    </edit-user-component>
</div>
@endsection
