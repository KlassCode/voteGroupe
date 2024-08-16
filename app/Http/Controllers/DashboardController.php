<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        var_dump(auth()->user());
        return view('dashboard.show');
    }
}
