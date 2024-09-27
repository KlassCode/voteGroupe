<?php

namespace App\Http\Controllers;

use App\Services\ElectionService;
use Illuminate\Http\Request;

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
        $elections = $this->electionService->getPublicElections();
        return view('elections.vcspace', compact('elections'));
    }
    public function show($code, Request $request)
    {
        $election = $this->electionService->searchElectionWithCode($code);
        $this->electionService->saveVisit($election->id, $request);
        $visitorsNumber = $this->electionService->getElectionVisitorsNumber($election->id);

        return view('elections.show', compact('election', 'visitorsNumber'));
    }
}
