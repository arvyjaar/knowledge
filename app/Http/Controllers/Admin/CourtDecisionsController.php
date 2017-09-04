<?php

namespace App\Http\Controllers\Admin;

use App\CourtDecision;
use App\Appeal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourtDecisionsRequest;
use App\Http\Requests\Admin\UpdateCourtDecisionsRequest;

class CourtDecisionsController extends Controller
{
    /**
     * Display a listing of CourtDecision.
     *
     * @return Response
     */
    public function index()
    {
        if (! Gate::allows('court_decision_access')) {
            return abort(401);
        }
        $court_decisions = CourtDecision::all();

        return view('admin.court_decisions.index', compact('court_decisions'));
    }

    /**
     * Show the form for creating new CourtDecision.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('court_decision_create')) {
            return abort(401);
        }
        return view('admin.court_decisions.create');
    }

    /**
     * Store a newly created CourtDecision in storage.
     *
     * @param  StoreCourtDecisionsRequest  $request
     * @return Response
     */
    public function store(StoreCourtDecisionsRequest $request)
    {
        if (! Gate::allows('court_decision_create')) {
            return abort(401);
        }
        $court_decision = CourtDecision::create($request->all());

        return redirect()->route('admin.court_decisions.index');
    }

    /**
     * Show the form for editing CourtDecision.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('court_decision_edit')) {
            return abort(401);
        }
        $court_decision = CourtDecision::findOrFail($id);

        return view('admin.court_decisions.edit', compact('court_decision'));
    }

    /**
     * Update CourtDecision in storage.
     *
     * @param  UpdateCourtDecisionsRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCourtDecisionsRequest $request, $id)
    {
        if (! Gate::allows('court_decision_edit')) {
            return abort(401);
        }
        $court_decision = CourtDecision::findOrFail($id);
        $court_decision->update($request->all());

        return redirect()->route('admin.court_decisions.index');
    }

    /**
     * Display CourtDecision.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (! Gate::allows('court_decision_view')) {
            return abort(401);
        }
        $appeals = Appeal::where('court_decision_id', $id)->get();

        $court_decision = CourtDecision::findOrFail($id);

        return view('admin.court_decisions.show', compact('court_decision', 'appeals'));
    }

    /**
     * Remove CourtDecision from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('court_decision_delete')) {
            return abort(401);
        }
        $court_decision = CourtDecision::findOrFail($id);
        $court_decision->delete();

        return redirect()->route('admin.court_decisions.index');
    }

    /**
     * Delete all selected CourtDecision at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('court_decision_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CourtDecision::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
