<?php

namespace App\Http\Controllers\Admin;

use App\Appeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppealsRequest;
use App\Http\Requests\Admin\UpdateAppealsRequest;

class AppealsController extends Controller
{
    /**
     * Display a listing of Appeal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('appeal_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('appeal_delete')) {
                return abort(401);
            }
            $appeals = Appeal::onlyTrashed()->get();
        } else {
            $appeals = Appeal::all();
        }

        return view('admin.appeals.index', compact('appeals'));
    }

    /**
     * Show the form for creating new Appeal.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('appeal_create')) {
            return abort(401);
        }
        
        $tags = \App\Tag::get()->pluck('title', 'id');

        $reasons = \App\Reason::get()->pluck('title', 'id');

        $court_decisions = \App\CourtDecision::get()->pluck('title', 'id')->prepend('Please select', '');

        return view('admin.appeals.create', compact('tags', 'reasons', 'court_decisions'));
    }

    /**
     * Store a newly created Appeal in storage.
     *
     * @param  \App\Http\Requests\StoreAppealsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppealsRequest $request)
    {
        if (! Gate::allows('appeal_create')) {
            return abort(401);
        }
        $appeal = Appeal::create($request->all());
        $appeal->tags()->sync(array_filter((array)$request->input('tags')));
        $appeal->reason()->sync(array_filter((array)$request->input('reason')));



        return redirect()->route('admin.appeals.index');
    }


    /**
     * Show the form for editing Appeal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('appeal_edit')) {
            return abort(401);
        }
        
        $tags = \App\Tag::get()->pluck('title', 'id');

        $reasons = \App\Reason::get()->pluck('title', 'id');

        $court_decisions = \App\CourtDecision::get()->pluck('title', 'id')->prepend('Please select', '');

        $appeal = Appeal::findOrFail($id);

        return view('admin.appeals.edit', compact('appeal', 'tags', 'reasons', 'court_decisions'));
    }

    /**
     * Update Appeal in storage.
     *
     * @param  \App\Http\Requests\UpdateAppealsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppealsRequest $request, $id)
    {
        if (! Gate::allows('appeal_edit')) {
            return abort(401);
        }
        $appeal = Appeal::findOrFail($id);
        $appeal->update($request->all());
        $appeal->tags()->sync(array_filter((array)$request->input('tags')));
        $appeal->reason()->sync(array_filter((array)$request->input('reason')));



        return redirect()->route('admin.appeals.index');
    }


    /**
     * Display Appeal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('appeal_view')) {
            return abort(401);
        }
        $appeal = Appeal::findOrFail($id);

        return view('admin.appeals.show', compact('appeal'));
    }


    /**
     * Remove Appeal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('appeal_delete')) {
            return abort(401);
        }
        $appeal = Appeal::findOrFail($id);
        $appeal->delete();

        return redirect()->route('admin.appeals.index');
    }

    /**
     * Delete all selected Appeal at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('appeal_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Appeal::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Appeal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('appeal_delete')) {
            return abort(401);
        }
        $appeal = Appeal::onlyTrashed()->findOrFail($id);
        $appeal->restore();

        return redirect()->route('admin.appeals.index');
    }

    /**
     * Permanently delete Appeal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('appeal_delete')) {
            return abort(401);
        }
        $appeal = Appeal::onlyTrashed()->findOrFail($id);
        $appeal->forceDelete();

        return redirect()->route('admin.appeals.index');
    }
}
