<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{

    public function dashboard()
    {
        return view("department.dashboard");

    }
    
}
