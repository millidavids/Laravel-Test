<?php

namespace App\Transformers;

use App\Company;
use League\Fractal;

class CompanyTransformer extends Fractal\TransformerAbstract
{
    public function transform(Company $company)
    {
        return [
            'id'      => (int) $company->id,
            'name'   => $company->name,
            'url' => $company->url,
        ];
    }
}