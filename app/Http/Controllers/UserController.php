<?php

namespace App\Http\Controllers;

use App\Jobs\SendTestEmail;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function show($id)
    {
        return view('user.show', ['user' => \App\User::findOrFail($id)]);
    }

    public function email($id)
    {
        $user = \App\User::findOrFail($id);
        $this->dispatch(new SendTestEmail($user));
        return view('user.show', ['user' => $user]);
    }
}
