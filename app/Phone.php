<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'number',
    ];

    protected $guarded = [
        'id',
        'user_id',
    ];

    private $rules = array(
        'number' => 'required',
        'user_id' => 'required',
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
