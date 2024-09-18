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
    public function confirmElectionInvite($candidateId)
    {
        return $this->candidateRepository->enableCandidateParticipation($candidateId);
    }
    public function searchCandidate($candidateId)
    {
        return $this->candidateRepository->findCandidate($candidateId);
    }
    public function isAlreadyUser($candidateEmail)
    {
        return $this->candidateRepository->isCandidateRegistred($candidateEmail);
    }
    public function getAllCandidature($user)
    {
        return $this->candidateRepository->findAllCandidatureWithMail($user->email);
    }
}
