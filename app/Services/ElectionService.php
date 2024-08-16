<?php

namespace App\Services;

use App\Repositories\ElectionRepository;

class ElectionService
{

    protected ElectionRepository $electionRepository;

    public function __construct(ElectionRepository $electionRepository)
    {
        $this->electionRepository = $electionRepository;
    }
}
