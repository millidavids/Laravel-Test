<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Company extends Model
{
    protected $fillable = [
        'name',
        'web_based',
        'url',
    ];

    protected $guarded = ['id'];

    private $rules = array(
        'name' => 'required',
        'url' => 'required_if:web_based,true',
    );

    private $errors;

    private $messages = array(
        'url.required_if' => 'Web based companies need urls.'
    );

    public function validate($data)
    {
        $v = Validator::make($data, $this->rules, $this->messages);

        if ($v->fails()) {
            $this->errors = $v->errors();
            return false;
        }

        return true;
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
