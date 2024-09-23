<?php

namespace App\Http\Controllers;

use App\Mail\CandidatureInvitationMail;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use App\Services\ElectionService;
use App\Services\CandidateService;
use Illuminate\Support\Facades\Mail;

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

        if ($candidate = $this->candidateService->addNewCandidate($request->all())) {
            Mail::to($request->email)->send(new CandidatureInvitationMail($candidate));
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
    public function delete($id)
    {
        if ($this->candidateService->removeCandidate($id)) {
            return redirect()->back();
        }
    }

    // not finish
    public function candidateConfirm($id)
    {
        $candidate = $this->candidateService->searchCandidate($id);
        $email = $candidate->email;
        if (
            $this->candidateService->confirmElectionInvite($candidate->id) &&
            !$this->candidateService->isAlreadyUser($candidate->email)
        ) {
            return redirect()->route('register');
        } else {
            return redirect()->route('login');
        }
    }
    public function fetchAllUserCandidature()
    {
        $candidatures = $this->candidateService->getAllCandidature(auth()->user());
        // dd($candidatures[0]->election->where('id', $candidatures[0]->election_id));
        return view('candidates.candidatures')->with('candidatures', $candidatures);
    }
}
