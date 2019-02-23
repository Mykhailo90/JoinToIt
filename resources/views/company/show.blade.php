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
    <h1>{{ $company->name}} </h1>
    <div id="logo">
        @if ($company->logo)
            <img src="{{ URL::asset('/storage/'.$company->logo) }}">
        @endif
    </div>
@stop

@section('content')
    <div class="card col-md-6 col-md-offset-3">
        <div class="card-header">
            <div class="level">
                <h4 class="flex">Total employees:</h4>
                {{ $company->employees_count }} {{str_plural('employee', $company->employees_count)}}
            </div>

            <div class="level">
                <h4 class="flex">Email:</h4>
                {{ $company->email}}
            </div>

            <div class="level">
                <h4 class="flex">Website:</h4>
                {{ $company->website}}
            </div>
            <div class="level">
                <a type="button" class="btn btn-success btn-lg" href="/admin/companies/{{$company->id}}/update">Update Info</a>

                <a type="button" class="btn btn-danger btn-lg" href="/admin/companies/{{$company->id}}/delete" data-method="delete">Delete Company</a>
            </div>
        </div>
    </div>

    @if ($company->employees_count)
        <div class="card col-md-10 col-md-offset-1" style="background-color: lavender">
            <div class="card-header" style="text-align: center">
                <h3>List Employees</h3>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <th scope="row">{{ $employee->id }}</th>
                            <td>{{ $employee->first_name }}</td>
                            <td><a href="/admin/employees/{{ $employee->id }}">{{ $employee->last_name }} </a></td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div style="text-align: center">
                    {{ $employees->links() }}
                </div>

            </div>
        </div>
    @endif
@stop