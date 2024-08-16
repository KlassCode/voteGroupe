<?php

namespace App\Http\Controllers;

use App\Services\ElectionService;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    protected ElectionService $electionService;

    public function __construct(ElectionService $electionService)
    {
        $this->electionService = $electionService;
    }
}
