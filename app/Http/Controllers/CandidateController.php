<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CandidateService;
use App\Services\ElectionService;
use Ramsey\Uuid\Type\Integer;

class CandidateController extends Controller
{
    protected $candidateService;
    protected $electionService;

    public function __construct(CandidateService $candidateService, ElectionService $electionService)
    {
        $this->candidateService = $candidateService;
        $this->electionService = $electionService;
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

    public function update(Request $request)
    {
        validator($request->all(), [
            'fullnamem' => 'required|',
            'emailm' => 'required|',
        ])->validate();
        if ($this->candidateService->updateCandidateInformation($request->all())) {
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
