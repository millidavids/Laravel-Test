<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [
        'id',
        'imageable_id',
        'imageable_type',
    ];

    private $rules = array(
        'imageable_id' => 'required',
        'imageable_type' => 'required',
        'path' => 'required',
    );

    private $errors;

    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);

        if ($v->fails()) {
            $this->errors = $v->errors();
            return false;
        }

        return true;
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
