<?php

namespace millidavids\SimpleGui\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class SimpleGuiController extends Controller
{

    public function index()
    {
        return view('SimpleGui::index');
    }
}