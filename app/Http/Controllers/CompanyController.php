<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use Delatbabel\ApiSecurity\Exceptions\SignatureException;
use Delatbabel\ApiSecurity\Helpers\Server;
use Illuminate\Support\Facades\Input;

class CompanyController extends Controller
{
    public function index()
    {
        $server = new Server();
        $server->setPublicKey(base_path().'/public_key');

        try
        {
            $params = array();
            $server->verifySignature($params);

        } catch (SignatureException $e) {
            return response(401, 401);
        }
        $companies = Company::all();
        return $companies;
    }

    public function show($company_id)
    {
        $company = Company::find($company_id);
        return view('company.show', ['company' => $company]);
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
