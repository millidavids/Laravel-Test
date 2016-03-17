<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Transformers\CompanyTransformer;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Support\Facades\Input;

class CompanyController extends ApiGuardController
{
    public function index()
    {
        $companies = Company::all();

        return $this->response->withCollection($companies, new CompanyTransformer());
    }

    public function show($company_id)
    {
        $company = Company::find($company_id);
        return $company;
    }

    public function create()
    {
        return view('company.create');
    }

    public function edit($company_id)
    {
        $company = Company::find($company_id);
        return view('company.edit', ['company' => $company]);
    }

    public function store()
    {
        Company::create(array(
            'name' => Input::get('name'),
            'web_based' => true,
            'url' => Input::get('url')
        ));

        return redirect('/company');
    }

    public function update($company_id)
    {
        $company = Company::find($company_id);
        $company->name = Input::get('name');
        $company->url = Input::get('url');
        $company->save();

        return redirect('/company/'.$company_id);
    }

    public function destroy($company_id)
    {
        Company::destroy($company_id);

        return redirect('/company');
    }
}
