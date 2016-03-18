<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use Delatbabel\ApiSecurity\Exceptions\SignatureException;
use Delatbabel\ApiSecurity\Helpers\Server;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($this->verifySecurity($request->all())) {
            $companies = Company::all();
            return $companies;
        } else {
            return response(401, 401);
        }
    }

    public function show(Request $request, $company_id)
    {
        if ($this->verifySecurity($request->all())) {
            $company = Company::find($company_id);
            return $company;
        } else {
            return response(401, 401);
        }
    }

    public function store(Request $request)
    {
        if ($this->verifySecurity($request->all())) {
            Company::create(array(
                'name' => Input::get('name'),
                'web_based' => true,
                'url' => Input::get('url')
            ));
            return response(201, 201);
        } else {
            return response(401, 401);
        }
    }

    public function update(Request $request, $company_id)
    {
        if ($this->verifySecurity($request->all())) {
            $company = Company::find($company_id);
            $company->name = Input::get('name');
            $company->url = Input::get('url');
            $company->save();

            return response(202, 202);
        } else {
            return response(401, 401);
        }
    }

    public function destroy(Request $request, $company_id)
    {
        if ($this->verifySecurity($request->all())) {
            Company::destroy($company_id);
            return response(202, 202);
        } else {
            return response(401, 401);
        }
    }

    private function verifySecurity(Array $params)
    {
        $server = new Server();
        $server->setPublicKey(base_path().'/public_key');
        try
        {
            $server->verifyHMAC($params);

        } catch (SignatureException $e) {
            return false;
        }
        return true;
    }
}
