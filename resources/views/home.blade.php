@extends('adminlte::page')

@section('title', 'Mini-CRM')
<style>
    h1, p{
        text-align: center;
        font-weight: bolder;
    }
    p{
        color: #00a157;
        font-size: 1.5vw;
    }
</style>
@section('content_header')
    <h1>Best CRM</h1>
@stop

@section('content')
    <p>You have successfully logged in. You can start asset management.</p>
    {{--@if ( $companyLogos->count() )--}}
        {{--@foreach()--}}
            {{----}}
        {{--@endforeach--}}
    {{--@endif--}}
@stop