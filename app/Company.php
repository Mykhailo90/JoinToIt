<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    protected $table = 'companies';

//    protected $with = ['creator', 'channel'];

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

//    public function scopeFilter($query, $filters)
//    {
//        return $filters->apply($query);
//    }
}
