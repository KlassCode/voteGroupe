<?php

namespace App\Repositories;

use App\Models\Election;

class ElectionRepository
{

    protected Election $election;

    public function __construct(Election $election)
    {
        $this->election = $election;
    }
}
