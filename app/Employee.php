<?php

namespace App;

use App\Http\Requests\EmployeeUpdateRequest;
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

    public function updateInfo(EmployeeUpdateRequest $request)
    {
        $this->first_name = ($request->first_name) ? $request->first_name :  $this->first_name;
        $this->last_name = ($request->last_name) ? $request->last_name :  $this->last_name;
        $this->email = ($request->email) ? $request->email :  $this->email;
        $this->phone = ($request->phone) ? $request->phone :  $this->phone;
        $this->company_id = ($request->company_id) ? $request->company_id :  $this->company_id;

        $this->save();
    }

}
