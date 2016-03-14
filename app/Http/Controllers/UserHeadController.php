<?php

namespace App\Http\Controllers;

use App\Head;
use App\Http\Requests;

class UserHeadController extends Controller
{
    public function index($user_id)
    {

    }

    public function show($user_id, $head_id)
    {

    }

    public function create($user_id)
    {
        return view('user.head.create',
            ['user' => \App\User::findOrFail($user_id)]);
    }

    public function store($user_id)
    {
        $head = \App\User::findOrFail($user_id)->head()->save(new Head());
        return redirect('user/'.$user_id);
    }

    public function edit($user_id, $head_id)
    {

    }

    public function update($user_id, $head_id)
    {

    }

    public function destroy($user_id, $head_id)
    {
        \App\Head::destroy($head_id);
        return redirect('user/'.$user_id);
    }
}
