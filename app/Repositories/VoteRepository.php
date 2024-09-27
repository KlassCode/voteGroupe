<?php

namespace App\Repositories;

use App\Models\Vote;
use Illuminate\Support\Facades\Log;

class VoteRepository
{

    protected Vote $model;

    public function __construct(Vote $vote)
    {
        $this->model = $vote;
    }
    public function storeVote($data)
    {
        Log::info(`VoteRepository::storeVote()`);
        return $this->model->create([
            "user_id" => $data["userId"],
            "candidate_id" => $data["candidateId"],
        ]);
    }
}
