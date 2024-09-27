<?php

namespace App\Repositories;

use App\Models\Visitor;
use Illuminate\Support\Facades\Log;

class VisitorRepository
{

    protected Visitor $model;

    public function __construct(Visitor $visitor)
    {
        $this->model = $visitor;
    }
    public function storeVisit($data)
    {
        Log::info(`VisitorRepository::saveVisit()`);
        return $this->model->create([
            "ip_address" => $data["ipAddress"],
            "user_agent" => $data["userAgent"],
            "election_id" => $data["electionId"],
        ]);
    }
    public function countVisitors($id)
    {
        Log::info(`VisitorRepository::countVisitors()`);
        return $this->model->where('election_id', $id)->get()->count();
    }
}
