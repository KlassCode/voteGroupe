<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CandidateService;
use App\Services\ElectionService;

class CandidateController extends Controller
{
    protected $candidateService;
    protected $electionService;

    public function __construct(CandidateService $candidateService, ElectionService $electionService)
    {
        $this->candidateService = $candidateService;
        $this->electionService = $electionService;
    }


    public function create($code)
    {
        set_time_limit(8000000);
        $election = $this->electionService->searchElectionWithCode($code);
        return view('candidates.create', compact('election'));
    }

    public function store(Request $request)
    {

        validator($request->all(), [
            'fullname' => 'required|',
            'email' => 'required|',
        ])->validate();

        if ($this->candidateService->addNewCandidate($request->all())) {
            return response()->json([
                "message" => "success",
            ]);
        } else {
            return response()->json([
                "message" => "error",
            ]);
        }
    }
}
