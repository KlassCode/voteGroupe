<?php

namespace App\Repositories;

use App\Models\Candidate;
use Illuminate\Support\Facades\Log;

class CandidateRepository
{

    protected Candidate $model;

    public function __construct(Candidate $candidate)
    {
        $this->model = $candidate;
    }

    public function saveElectionCandidate($dataToSave)
    {
        Log::info(`CandidateRepository::saveElectionCandidate()`);
        // var_dump($dataToSave);
        return $this->model->create([
            'fullname' => $dataToSave['fullname'],
            'email' => $dataToSave['email'],
            'number_of_votes' => 0,
            'election_id' => $dataToSave['election_id'],
        ]);
    }

    public function findElectionByCode($code)
    {
        Log::info("ElectionRepository::findElectionBycode()");
        return $this->model->where('code', '=', $code)->first();
    }

    public function updateCandidate($dataToUpdate)
    {
        Log::info("CandidateRepository::updateCandidate()");
        return $this->model->where('id', $dataToUpdate['candidate_id'])->update(['fullname' => $dataToUpdate['fullnamem'], 'email' => $dataToUpdate['emailm']]);
    }
}
