<?php

namespace App;

use App\Http\Requests\CompanyCreateRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use Notifiable;

    protected $guarded = [];

    protected $table = 'companies';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('employeesCount', function($builder) {
            $builder->withCount('employees');
        });

    }

    public function path()
    {
        return "/admin/companies/{$this->id}";
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);

    }

    public function addEmployee($employee)
    {
        $this->employees()->create($employee);
    }

    public function updateInfo(CompanyCreateRequest $request)
    {
        $this->name = $request->name;
        $this->email = ($request->email) ? $request->email : $this->email;
        $this->website = ($request->website) ? $request->website : $this->website;

        $path = null;
        if ($request->hasFile('logo')) {
            $path = $request->logo->store('public');
        }
        $fileName = ($path) ? basename($path) : NULL;

        if ($fileName)
        {
            Storage::delete('public/'.$this->logo);
            $this->logo = $fileName;
        }

        $this->save();
    }

}
