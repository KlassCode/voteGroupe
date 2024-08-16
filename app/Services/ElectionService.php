<?php

namespace App\Services;

use App\Models\Election;
use Illuminate\Support\Str;
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
            "code" => $generateCode,
            "status" => Election::CREATE,
            "user_id" => intval("1"),
        ]);
        return $this->electionRepository->saveElection($dataToSave);
    }

    public function codeGeneration()
    {
        return Str::random(6);
    }
}
