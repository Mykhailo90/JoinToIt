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
<h1>Update Company</h1>
@stop

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/admin/companies/{{ $company->id }}/update" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Company name:</label>
                            <input type="text" class="form-control" name="name", id="name" placeholder="Company name" value="{{ $company->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email", id="email" placeholder="Email" value="{{ $company->email }}">
                        </div>

                        <div class="form-group">
                            <label for="website">Website:</label>
                            <input type="text" class="form-control" name="website", id="website" placeholder="http://test.site.com" value="{{ $company->website }}">
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo:</label>
                            <input type="file" class="form-control" name="logo", id="logo" placeholder="logo" value="{{ $company->logo }}" >
                            <span>*Image must be more then 100 x 100 px!</span>
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