<?php

namespace App\Http\Controllers\Admin;

use App\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreResultsRequest;
use App\Http\Requests\Admin\UpdateResultsRequest;

class ResultsController extends Controller
{
    /**
     * Display a listing of Result.
     *
     * @return Response
     */
    public function index()
    {
        if (! Gate::allows('result_access')) {
            return abort(401);
        }
        $results = Result::all();

        return view('admin.results.index', compact('results'));
    }

    /**
     * Show the form for creating new Result.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('result_create')) {
            return abort(401);
        }
        return view('admin.results.create');
    }

    /**
     * Store a newly created Result in storage.
     *
     * @param  StoreResultsRequest  $request
     * @return Response
     */
    public function store(StoreResultsRequest $request)
    {
        if (! Gate::allows('result_create')) {
            return abort(401);
        }
        $result = Result::create($request->all());

        return redirect()->route('admin.results.index');
    }

    /**
     * Show the form for editing Result.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('result_edit')) {
            return abort(401);
        }
        $result = Result::findOrFail($id);

        return view('admin.results.edit', compact('result'));
    }

    /**
     * Update Result in storage.
     *
     * @param  UpdateResultsRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateResultsRequest $request, $id)
    {
        if (! Gate::allows('result_edit')) {
            return abort(401);
        }
        $result = Result::findOrFail($id);
        $result->update($request->all());

        return redirect()->route('admin.results.index');
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (! Gate::allows('result_view')) {
            return abort(401);
        }
        $result = Result::findOrFail($id);

        return view('admin.results.show', compact('result'));
    }

    /**
     * Remove Result from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('result_delete')) {
            return abort(401);
        }
        $result = Result::findOrFail($id);
        $result->delete();

        return redirect()->route('admin.results.index');
    }

    /**
     * Delete all selected Result at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('result_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Result::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
