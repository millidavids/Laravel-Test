<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    protected $guarded = [
        'id',
        'user_id',
        'image_path',
        'thumbnail_path',
    ];

    private $rules = array(
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
