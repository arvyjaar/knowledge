<?php

namespace App\Http\Controllers\Admin;

use App\Doccategory;
use App\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDoccategoriesRequest;
use App\Http\Requests\Admin\UpdateDoccategoriesRequest;
use Yajra\Datatables\Datatables;

class DoccategoriesController extends Controller
{
    /**
     * Display a listing of Doccategory.
     *
     * @return Response
     */
    public function index()
    {
        if (! Gate::allows('doccategory_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = Doccategory::query();
            $template = 'actionsTemplate';
            if (request('show_deleted') == 1) {
                if (! Gate::allows('doccategory_delete')) {
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
                $gateKey  = 'doccategory_';
                $routeKey = 'admin.doccategories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            return $table->make(true);
        }

        return view('admin.doccategories.index');
    }

    /**
     * Show the form for creating new Doccategory.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('doccategory_create')) {
            return abort(401);
        }
        return view('admin.doccategories.create');
    }

    /**
     * Store a newly created Doccategory in storage.
     *
     * @param  StoreDoccategoriesRequest  $request
     * @return Response
     */
    public function store(StoreDoccategoriesRequest $request)
    {
        if (! Gate::allows('doccategory_create')) {
            return abort(401);
        }
        $doccategory = Doccategory::create($request->all());

        return redirect()->route('admin.doccategories.index');
    }

    /**
     * Show the form for editing Doccategory.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('doccategory_edit')) {
            return abort(401);
        }
        $doccategory = Doccategory::findOrFail($id);

        return view('admin.doccategories.edit', compact('doccategory'));
    }

    /**
     * Update Doccategory in storage.
     *
     * @param  UpdateDoccategoriesRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateDoccategoriesRequest $request, $id)
    {
        if (! Gate::allows('doccategory_edit')) {
            return abort(401);
        }
        $doccategory = Doccategory::findOrFail($id);
        $doccategory->update($request->all());

        return redirect()->route('admin.doccategories.index');
    }

    /**
     * Display Doccategory.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (! Gate::allows('doccategory_view')) {
            return abort(401);
        }
        $documents = Document::where('category_id', $id)->get();
        $doccategory = Doccategory::findOrFail($id);

        return view('admin.doccategories.show', compact('doccategory', 'documents'));
    }

    /**
     * Remove Doccategory from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('doccategory_delete')) {
            return abort(401);
        }
        $doccategory = Doccategory::findOrFail($id);
        $doccategory->delete();

        return redirect()->route('admin.doccategories.index');
    }

    /**
     * Delete all selected Doccategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('doccategory_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Doccategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Doccategory from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        if (! Gate::allows('doccategory_delete')) {
            return abort(401);
        }
        $doccategory = Doccategory::onlyTrashed()->findOrFail($id);
        $doccategory->restore();

        return redirect()->route('admin.doccategories.index');
    }

    /**
     * Permanently delete Doccategory from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('doccategory_delete')) {
            return abort(401);
        }
        $doccategory = Doccategory::onlyTrashed()->findOrFail($id);
        $doccategory->forceDelete();

        return redirect()->route('admin.doccategories.index');
    }
}
