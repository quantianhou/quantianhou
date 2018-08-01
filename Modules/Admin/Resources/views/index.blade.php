@extends('admin::layouts.master')

@section('content')
    <h1>Hello {{$userInfo->name}}</h1>

    <p>
        This view is loaded from module: {!! config('admin.name') !!} {{$userInfo->email}}
    </p>
@stop
