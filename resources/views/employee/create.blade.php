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
</style>
@section('content_header')
    <h1>Create Employee</h1>
@stop

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="/admin/employees">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">First name:</label>
                                <input type="text" class="form-control" name="first_name", id="first_name" placeholder="First name" value="{{ old('first_name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Last name:</label>
                                <input type="text" class="form-control" name="last_name", id="last_name" placeholder="Last name" value="{{ old('last_name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email", id="email" placeholder="Email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="phone" class="form-control" name="phone", id="phone" placeholder="Phone" value="{{ old('phone') }}">
                            </div>

                            <div class="form-group">
                                <label for="company">Choose a Company:</label>
                                <select name="company_id", id='company_id' class="form-control" required>
                                    <option value="">Choose company...</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                            {{$company->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
                @if(count($errors))
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    </div>

@stop