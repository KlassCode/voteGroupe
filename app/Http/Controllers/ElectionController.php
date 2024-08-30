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

    public function create()
    {
        return view('elections.create');
    }

    public function store(Request $request)
    {
        validator($request->all(), [
            'title' => 'required',
            'open_date' => 'required',
            'close_date' => 'required',
            'number_of_candidates' => 'required',
        ])->validate();
        $election = $this->electionService->saveBasicElectionInformation($request->all());
        return redirect()->route('candidate.create', ['code' => $election->code]);
    }
}
