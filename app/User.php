<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $guarded = [
        'id',
        'company_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    private $rules = array(
        'name' => 'required|regex:/^[\pL\s\-]+$/u|min:2',
        'email' => 'required|regex:/@/',
        'password' => 'required|min:6',
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

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Company', 'company_user');
    }

    public function head()
    {
        return $this->hasOne('App\Head');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function scopefirstUser($query)
    {
        return $query->where('id', 1);
    }
}
