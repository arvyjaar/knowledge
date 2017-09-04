<?php

namespace App\Http\Controllers\Admin;

use App\Organisation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrganisationsRequest;
use App\Http\Requests\Admin\UpdateOrganisationsRequest;
use Yajra\Datatables\Datatables;

class OrganisationsController extends Controller
{
    /**
     * Display a listing of Organisation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('organisation_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = Organisation::query();
            $template = 'actionsTemplate';
            if (request('show_deleted') == 1) {
                if (! Gate::allows('organisation_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'organisation_';
                $routeKey = 'admin.organisations';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            return $table->make(true);
        }

        return view('admin.organisations.index');
    }

    /**
     * Show the form for creating new Organisation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('organisation_create')) {
            return abort(401);
        }
        return view('admin.organisations.create');
    }

    /**
     * Store a newly created Organisation in storage.
     *
     * @param  StoreOrganisationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganisationsRequest $request)
    {
        if (! Gate::allows('organisation_create')) {
            return abort(401);
        }
        $organisation = Organisation::create($request->all());

        return redirect()->route('admin.organisations.index');
    }

    /**
     * Show the form for editing Organisation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('organisation_edit')) {
            return abort(401);
        }
        $organisation = Organisation::findOrFail($id);

        return view('admin.organisations.edit', compact('organisation'));
    }

    /**
     * Update Organisation in storage.
     *
     * @param  UpdateOrganisationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganisationsRequest $request, $id)
    {
        if (! Gate::allows('organisation_edit')) {
            return abort(401);
        }
        $organisation = Organisation::findOrFail($id);
        $organisation->update($request->all());

        return redirect()->route('admin.organisations.index');
    }

    /**
     * Display Organisation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('organisation_view')) {
            return abort(401);
        }
        $documents = \App\Document::where('organisation_id', $id)->get();

        $organisation = Organisation::findOrFail($id);

        return view('admin.organisations.show', compact('organisation', 'documents'));
    }

    /**
     * Remove Organisation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('organisation_delete')) {
            return abort(401);
        }
        $organisation = Organisation::findOrFail($id);
        $organisation->delete();

        return redirect()->route('admin.organisations.index');
    }

    /**
     * Delete all selected Organisation at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('organisation_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Organisation::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Organisation from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        if (! Gate::allows('organisation_delete')) {
            return abort(401);
        }
        $organisation = Organisation::onlyTrashed()->findOrFail($id);
        $organisation->restore();

        return redirect()->route('admin.organisations.index');
    }

    /**
     * Permanently delete Organisation from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('organisation_delete')) {
            return abort(401);
        }
        $organisation = Organisation::onlyTrashed()->findOrFail($id);
        $organisation->forceDelete();

        return redirect()->route('admin.organisations.index');
    }
}
