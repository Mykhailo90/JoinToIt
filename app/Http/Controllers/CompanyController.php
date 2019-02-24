<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyCreateRequest;
use App\Notifications\CreateCompanyNotification;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
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
        $companies = Company::all();

        return view('company.index', compact('companies'));
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
     * @param  CompanyCreateRequest  $request
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

        if($company)
            $company->notify(new CreateCompanyNotification($company));

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
        $company = Company::findOrFail($id);

        return view('company.show', [
            'company' => $company,
            'employees' => $company->employees()->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Company $company)
    {
        $company = $company->findOrFail($id);

        return view('company.update', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyCreateRequest $request, Company $company)
    {
        $company = $company->findOrFail($request->id);
        $company->updateInfo($request);

        return redirect($company->path());
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
