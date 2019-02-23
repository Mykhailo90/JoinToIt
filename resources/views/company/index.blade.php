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

    .card{
        margin-bottom: 20px;
    }
    body{
        padding-bottom: 100px;
    }
    .level{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .flex{
        flex: 1;
    }
    #alert{
        margin-top: 70px;
    }
</style>
@section('content_header')
    <h1>Companies List</h1>
@stop

@section('content')
    <div class="row col-md-6 col-md-offset-3">
        <a href="/admin/companies/create" class="btn btn-success btn-lg btn-block">Add company</a>
    </div>
    @if ($companies->count() == 0)
        <div class="row alert alert-warning" id="alert" role="alert">
            Companies list is empty!
        </div>
    @else
        @foreach($companies as $company)

            <div class="card col-md-6 col-md-offset-3">
                <div class="card-header">
                    <div class="level">
                        <h4 class="flex">
                            {{ $company->id }}.
                            <a href="{{ $company->path() }}">
                                {{  $company->name }}
                            </a>
                        </h4>
                       {{ $company->employees_count }} {{str_plural('employee', $company->employees_count)}}
                    </div>
                </div>
            </div>
        @endforeach
    @endif




@stop