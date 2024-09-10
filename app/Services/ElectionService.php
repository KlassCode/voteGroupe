<?php

namespace App\Services;

use App\Models\Election;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;
use App\Repositories\ElectionRepository;

class ElectionService
{

    protected ElectionRepository $electionRepository;

    public function __construct(ElectionRepository $electionRepository)
    {
        $this->electionRepository = $electionRepository;
    }

    public function saveBasicElectionInformation($basicInformations)
    {

        $generateCode = $this->codeGeneration();
        $dataToSave = array_merge($basicInformations, [
            "code" => strtoupper($generateCode),
            "status" => Election::CREATE,
            "user_id" => Auth::user()->id,
        ]);
        return $this->electionRepository->saveElection($dataToSave);
    }

    public function codeGeneration()
    {
        return Str::random(6);
    }

    public function searchElectionWithCode($codeElection)
    {
        return $this->electionRepository->findElectionByCode($codeElection);
    }

    public function updateElectionInformation($electionId, $dataToUpdate)
    {
        $election = $this->searchElectionWithCode($dataToUpdate["code"]);
        if ($election->candidates->count() > (int) $dataToUpdate["number_of_candidates"]) {
            $dataToUpdate["number_of_candidates"] = $election->candidates->count();
        }
        return $this->electionRepository->updateElection($electionId, $dataToUpdate);
    }

    public function getUserElections($user)
    {
        return $this->electionRepository->getAllElections($user);
    }
    public function removeElection($electionId)
    {
        return $this->electionRepository->deleteElection($electionId);
    }
}
