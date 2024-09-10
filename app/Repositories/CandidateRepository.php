<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Support\Facades\Log;

class CandidateRepository
{

    protected Candidate $model;
    protected User $modelUser;

    public function __construct(Candidate $candidate, User $modelUser)
    {
        $this->model = $candidate;
        $this->modelUser = $modelUser;
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

    public function findCandidate($id)
    {
        Log::info("CandidateRepository::findCandidate()");
        return $this->model->findOrFail($id);
    }

    public function updateCandidate($dataToUpdate)
    {
        Log::info("CandidateRepository::updateCandidate()");
        return $this->model->where('id', $dataToUpdate['candidate_id'])->update(['fullname' => $dataToUpdate['fullnamem'], 'email' => $dataToUpdate['emailm']]);
    }
    public function deleteCandidate($id)
    {
        Log::info("CandidateRepository::deleteCandidate()");
        return $this->model->where('id', $id)->delete();
    }
    public function enableCandidateParticipation($id)
    {
        Log::info("CandidateRepository::enableCandidateParticipation()");
        return $this->model->where('id', $id)->update(["participation_confirm" => 1]);
    }

    public function isCandidateRegistred($email)
    {
        Log::info("CandidateRepository::isCandidateRegistred()");
        return $this->modelUser->where('email', $email)->first();
    }
}
