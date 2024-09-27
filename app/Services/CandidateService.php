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
    public function approuveCandidature($candidateId, $fullname)
    {
        return $this->candidateRepository->UpdateInformationAndParticipation($candidateId, $fullname);
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
        $candidatures = $this->candidateRepository->findAllCandidatureWithMail($user->email);
        $validCandidatures = [];
        foreach ($candidatures as $candidate) {
            # code...
            if ($this->electionRepository->ifElectionArchived($candidate->election_id)) {
                array_push($validCandidatures, $candidate);
            }
        }
        return $validCandidatures;
    }
    public function newVote($candidateId)
    {
        $candidate = $this->candidateRepository->findCandidate($candidateId);
        $nbVotes = $candidate->number_of_votes + 1;
        return $this->candidateRepository->updateVoteNumbers($candidate->id, $nbVotes);
    }
}
