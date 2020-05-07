@extends('layouts-warehouse.app')

@section('content')
    <div id="app">
        <rack-edit-component 
            id="{{ $id }}" 
            shelf_type="{{ json_encode($shelfType) }}" 
            max_shelf_unit="{{ config('btd.rack.max_shelf_unit') }}"
            action_edit_rack="{{ route('racks.edit', [$subdomain, $id])}}"
            action_edit_shelf="{{ route('subshelfs.edit', [$subdomain, $id])}}"
            action_print_subshelf="{{ route('subshelfs.print', [$subdomain, $id])}}"
            errors="{{ json_encode($errors->all()) }}"
            error="{{ Session::get('error') }}"
            success="{{ Session::get('success') }}"


        >
        </rack-edit-component>
    </div>
@endsection
