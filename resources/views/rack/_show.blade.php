@extends('layouts-warehouse.app')

@section('content')
    <div id="app">
        <rack-show-component
        errors="{{ json_encode($errors->all()) }}"
        error="{{ Session::get('error') }}"
            success="{{ Session::get('success') }}"
            ></rack-show-component>
    </div>
@endsection
