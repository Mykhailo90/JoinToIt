<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\EmployeeCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);

        return view('employee.index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
    {
        $path = null;
        if ($request->hasFile('logo')) {
            $path = $request->logo->store('public');
        }

        $fileName = ($path) ? basename($path) : NULL;

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $fileName
        ]);

        return redirect($company->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employee.show', [
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $employee = Employee::findOrFail($id);

        return view('company.update', [
            'companies' => $companies,
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeCreateRequest $request, Employee $employee)
    {
        $employee = $employee->findOrFail($request->id);
        $employee->updateInfo($request);

        return redirect('/admin/employees/'.$employee->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Company $company)
    {
        $company = $company->findOrFail($id);
        Storage::delete('public/'.$company->logo);
        $employees = $company->employees;

        foreach ($employees as $item)
        {
            $item->delete();
        }

        $company->delete();

        return redirect('/admin/companies');
    }
}
