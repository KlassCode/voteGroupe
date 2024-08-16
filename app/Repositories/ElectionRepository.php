<?php

namespace App\Repositories;

use App\Models\Election;
use Illuminate\Support\Facades\Log;

class ElectionRepository
{

    protected Election $model;

    public function __construct(Election $election)
    {
        $this->model = $election;
    }

    public function saveElection($dataToSave)
    {
        Log::info(`ElectionRepository::saveElection()`);
        var_dump($dataToSave);
        return $this->model->create([
            'code' => $dataToSave['code'],
            'title' => $dataToSave['title'],
            'open_date' => $dataToSave['open_date'],
            'close_date' => $dataToSave['close_date'],
            'number_of_candidates' => $dataToSave['number_of_candidates'],
            'status' => $dataToSave['status'],
            'user_id' => $dataToSave['user_id'],
        ]);
    }
}
