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
    #logo{
        margin-top: 30px;
        text-align: center;
    }
    img{
        width:100%;
        max-width:300px;
        max-height: 400px;
    }
</style>
@section('content_header')
    <h1>{{ $employee->first_name}}  {{ $employee->last_name }}</h1>
@stop

@section('content')

        <div class="card col-md-6 col-md-offset-3">
            <div class="card-header">
                <div class="level">
                    <h4 class="flex">Email:</h4>
                    <span>{{ $employee->email }}</span>
                </div>

                <div class="level">
                    <h4 class="flex">Phone:</h4>
                    {{ $employee->phone }}
                </div>

                <div class="level">
                    <h4 class="flex">Company:</h4>
                    {{ $employee->company->name}}
                </div>
                <div class="level" style="margin-top: 30px">
                    <a type="button" class="btn btn-success btn-lg" href="/admin/employees/{{$employee->id}}/update">Update Info</a>

                    <a type="button" class="btn btn-danger btn-lg" href="/admin/employees/{{$employee->id}}/delete" data-method="delete">Delete Employee</a>
                </div>
            </div>
        </div>

@stop