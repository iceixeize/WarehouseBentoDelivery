@extends('layouts-warehouse.app')

@section('content')
    <div id="app">
        <rack-component 
            rack_no="{{ $rackNo }}" 
            shelf_type='{{ $shelfType }}'
            action="{{ route('racks.store', [$subdomain])}}"
            {{-- {{ route('Manage\Rack\RackController@store') }}" --}}
            errors="{{ json_encode($errors->all()) }}"
            error="{{ Session::get('error') }}"
            max_shelf="{{ json_encode(config('btd.rack.max_shelf')) }}"
        ></rack-component>
    </div>
@endsection

@push('script-foot')


<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script> 
    {!! JsValidator::formRequest('App\Http\Requests\RackRequest') !!}
@endpush
