<?php

namespace App\Services;

use App\Repositories\ElectionRepository;
use App\Repositories\CandidateRepository;

class CandidateService
{

    protected ElectionRepository $electionRepository;
    protected CandidateRepository $candidateRepository;

    public function __construct(ElectionRepository $electionRepository, CandidateRepository $candidateRepository)
    {
        $this->electionRepository = $electionRepository;
        $this->candidateRepository = $candidateRepository;
    }

    public function addNewCandidate($data)
    {
        return $this->candidateRepository->saveElectionCandidate($data);
    }

    public function updateCandidateInformation($dataUpdate)
    {
        return $this->candidateRepository->updateCandidate($dataUpdate);
    }
    public function removeCandidate($candidateId)
    {
        return $this->candidateRepository->deleteCandidate($candidateId);
    }
}
