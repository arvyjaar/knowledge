<?php

namespace App\Http\Controllers\Admin;

use App\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReasonsRequest;
use App\Http\Requests\Admin\UpdateReasonsRequest;

class ReasonsController extends Controller
{
    /**
     * Display a listing of Reason.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('reason_access')) {
            return abort(401);
        }


                $reasons = Reason::all();

        return view('admin.reasons.index', compact('reasons'));
    }

    /**
     * Show the form for creating new Reason.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('reason_create')) {
            return abort(401);
        }
        return view('admin.reasons.create');
    }

    /**
     * Store a newly created Reason in storage.
     *
     * @param  \App\Http\Requests\StoreReasonsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReasonsRequest $request)
    {
        if (! Gate::allows('reason_create')) {
            return abort(401);
        }
        $reason = Reason::create($request->all());



        return redirect()->route('admin.reasons.index');
    }


    /**
     * Show the form for editing Reason.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('reason_edit')) {
            return abort(401);
        }
        $reason = Reason::findOrFail($id);

        return view('admin.reasons.edit', compact('reason'));
    }

    /**
     * Update Reason in storage.
     *
     * @param  \App\Http\Requests\UpdateReasonsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReasonsRequest $request, $id)
    {
        if (! Gate::allows('reason_edit')) {
            return abort(401);
        }
        $reason = Reason::findOrFail($id);
        $reason->update($request->all());



        return redirect()->route('admin.reasons.index');
    }


    /**
     * Display Reason.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('reason_view')) {
            return abort(401);
        }
        $appeals = \App\Appeal::whereHas('reason',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $reason = Reason::findOrFail($id);

        return view('admin.reasons.show', compact('reason', 'appeals'));
    }


    /**
     * Remove Reason from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('reason_delete')) {
            return abort(401);
        }
        $reason = Reason::findOrFail($id);
        $reason->delete();

        return redirect()->route('admin.reasons.index');
    }

    /**
     * Delete all selected Reason at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('reason_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Reason::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
