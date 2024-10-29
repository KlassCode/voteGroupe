<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Election;
use Illuminate\Http\Request;
use App\Services\ElectionService;

class ElectionController extends Controller
{
    protected ElectionService $electionService;

    public function __construct(ElectionService $electionService)
    {
        $this->electionService = $electionService;
    }

    public function create()
    {
        return view('elections.create');
    }

    public function store(Request $request)
    {
        validator($request->all(), [
            'title' => 'required',
            'open_date' => 'required',
            'close_date' => 'required',
            'number_of_candidates' => 'required|integer|between:1,10',
        ])->validate();
        $election = $this->electionService->saveBasicElectionInformation($request->all());
        return redirect()->route('election.edit', ['code' => $election->code]);
    }

    public function edit($code)
    {
        set_time_limit(8000000);
        $election = $this->electionService->searchElectionWithCode($code);
        return view('elections.edit', compact('election'));
    }

    public function update($electionId, Request $request)
    {
        validator($request->all(), [
            'title' => 'required',
            'open_date' => 'required',
            'close_date' => 'required',
            'number_of_candidates' => 'required|integer|between:1,10',
        ])->validate();

        if ($this->electionService->updateElectionInformation($electionId, $request->all())) {
            return redirect()->route('election.edit', ['code' => $request->input('code')]);
        }
    }

    public function fetchAllElections()
    {
        $elections = $this->electionService->getUserElections(auth()->user());
        return view('elections.list', compact('elections'));
    }
    public function delete($id)
    {
        if ($this->electionService->removeElection($id)) {
            return redirect()->back();
        }
    }
    public function displayAllPublicElection()
    {
        $electionsDatas = [];
        $elections = $this->electionService->getPublicElections();

        foreach ($elections as $election) {
            # code...
            array_push($electionsDatas, [
                "title" => $election->title,
                "code" => $election->code,
                "status" => $election->status,
                "open_date" => $election->open_date,
                "close_date" => $election->close_date,
                'number_of_candidates' => $election->number_of_candidates,
                'user_id' => $election->user_id,
                'total_votes_received' => $election->total_votes_received,
                "days" => $this->daysBetweenDates($election->close_date, $election->open_date),
            ]);
        }

        return view('elections.vcspace', compact('electionsDatas'));
    }
    public function checkExpiredElections($closeDate)
    {
        $today = (new DateTime())->format('Y-m-d'); //use format whatever you are using
        $expiry = (new DateTime($closeDate))->format('Y-m-d');
        return strtotime($today) > strtotime($expiry);
    }
    public function show($code, Request $request)
    {
        $election = $this->electionService->searchElectionWithCode($code);
        $this->electionService->saveVisit($election->id, $request);
        $visitorsNumber = $this->electionService->getElectionVisitorsNumber($election->id);

        return view('elections.show', compact('election', 'visitorsNumber'));
    }
    public function daysBetweenDates($date1, $date2)
    {

        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a'); //now do whatever you like with $days
        return $days;
    }
}
