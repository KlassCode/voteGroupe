<?php

namespace App\Services;

use App\Repositories\ElectionRepository;
use App\Repositories\CandidateRepository;
use App\Repositories\VoteRepository;

class CandidateService
{

    protected ElectionRepository $electionRepository;
    protected CandidateRepository $candidateRepository;
    protected VoteRepository $voteRepository;


    public function __construct(
        ElectionRepository $electionRepository,
        CandidateRepository $candidateRepository,
        VoteRepository $voteRepository
    ) {
        $this->electionRepository = $electionRepository;
        $this->candidateRepository = $candidateRepository;
        $this->voteRepository = $voteRepository;
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
        $savedVote = $this->voteRepository->storeVote([
            "userId" => auth()->user()->id,
            "candidateId" => $candidate->id,
        ]);
        if ($savedVote) {
            $nbVotes = $candidate->number_of_votes + 1;
            $this->candidateRepository->updateVoteNumbers($candidate->id, $nbVotes);
            $election = $candidate->election;
            $election->total_votes_received += 1;
            $election->save();
            return true;
        }
        return false;
    }
}
