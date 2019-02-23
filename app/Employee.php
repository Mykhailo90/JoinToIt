<?php

namespace App;

use App\Http\Requests\EmployeeCreateRequest;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    protected $table = 'employees';

    protected $with = ['company'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function updateInfo(EmployeeCreateRequest $request)
    {
        dd('test');
    }

}
