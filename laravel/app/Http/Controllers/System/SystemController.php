<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    
    public function dashboard()
    {
        return view('system.dashboard.index');
    }
}
