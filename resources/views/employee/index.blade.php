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
    <h1>List Employees</h1>
@stop

@section('content')

    <div class="row col-md-6 col-md-offset-3">
        <a href="/admin/employees/create" class="btn btn-success btn-lg btn-block">Add Employee</a>
    </div>
    @if ($employees->count() == 0)
        <div class="row alert alert-warning" id="alert" role="alert">
            Employees list is empty!
        </div>
    @else
        <div class="card col-md-12" style="background-color: lavender; margin-top: 30px">

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Company</th>
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

                            <td><a href="/admin/companies/{{ $employee->company->id }}">{{ $employee->company->name }}</a></td>
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