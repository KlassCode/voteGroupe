<?php

namespace App\Http\Controllers;

use App\Services\ElectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected ElectionService $electionService;

    public function show()
    {
        $user = Auth::user();
        return view('dashboard.show', compact('user'));
    }
}
