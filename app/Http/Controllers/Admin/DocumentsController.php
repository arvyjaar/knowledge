<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use App\Organisation;
use App\Doccategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentsRequest;
use App\Http\Requests\Admin\UpdateDocumentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\Datatables\Datatables;

class DocumentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('document_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = Document::query();
            $query->with("organisation");
            $query->with("category");
            $query->with("changed");
            $template = 'actionsTemplate';
            if (request('show_deleted') == 1) {
                if (! Gate::allows('document_delete')) {
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
                $gateKey  = 'document_';
                $routeKey = 'admin.documents';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('nr', function ($row) {
                return $row->nr ? $row->nr : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('signed', function ($row) {
                return $row->signed ? $row->signed : '';
            });
            $table->editColumn('valid_from', function ($row) {
                return $row->valid_from ? $row->valid_from : '';
            });
            $table->editColumn('valid_till', function ($row) {
                return $row->valid_till ? $row->valid_till : '';
            });
            $table->editColumn('organisation.title', function ($row) {
                return $row->organisation ? $row->organisation->title : '';
            });
            $table->editColumn('category.title', function ($row) {
                return $row->category ? $row->category->title : '';
            });
            $table->editColumn('file', function ($row) {
                $build  = '';
                foreach ($row->getMedia('file') as $media) {
                    $build .= '<p class="form-group"><a href="' . $media->getUrl() . '" target="_blank">' . $media->name . '</a></p>';
                }
                
                return $build;
            });
            $table->editColumn('changed.nr', function ($row) {
                return $row->changed ? $row->changed->nr : '';
            });

            return $table->make(true);
        }

        return view('admin.documents.index');
    }

    /**
     * Show the form for creating new Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }
        
        $organisations = Organisation::get()->pluck('title', 'id')->prepend('Please select', '');
        $categories = Doccategory::get()->pluck('title', 'id')->prepend('Please select', '');
        $changeds = Document::get()->pluck('nr', 'id')->prepend('Please select', '');

        return view('admin.documents.create', compact('organisations', 'categories', 'changeds'));
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param  StoreDocumentsRequest  $request
     * @return Response
     */
    public function store(StoreDocumentsRequest $request)
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $document = Document::create($request->all());


        foreach ($request->input('file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $document->id;
            $file->save();
        }

        return redirect()->route('admin.documents.index');
    }

    /**
     * Show the form for editing Document.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }
        
        $organisations = \App\Organisation::get()->pluck('title', 'id')->prepend('Please select', '');
        $categories = \App\Doccategory::get()->pluck('title', 'id')->prepend('Please select', '');
        $changeds = \App\Document::get()->pluck('nr', 'id')->prepend('Please select', '');

        $document = Document::findOrFail($id);

        return view('admin.documents.edit', compact('document', 'organisations', 'categories', 'changeds'));
    }

    /**
     * Update Document in storage.
     *
     * @param  UpdateDocumentsRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateDocumentsRequest $request, $id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $document = Document::findOrFail($id);
        $document->update($request->all());

        $media = [];
        foreach ($request->input('file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $document->id;
            $file->save();
            $media[] = $file;
        }
        $document->updateMedia($media, 'file');

        return redirect()->route('admin.documents.index');
    }

    /**
     * Display Document.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (! Gate::allows('document_view')) {
            return abort(401);
        }
        
        $organisations = Organisation::get()->pluck('title', 'id')->prepend('Please select', '');
        $categories = Doccategory::get()->pluck('title', 'id')->prepend('Please select', '');
        $changeds = Document::get()->pluck('nr', 'id')->prepend('Please select', '');
        $documents = Document::where('changed_id', $id)->get();

        $document = Document::findOrFail($id);

        return view('admin.documents.show', compact('document', 'documents'));
    }

    /**
     * Remove Document from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
        $document = Document::findOrFail($id);
        $document->deletePreservingMedia();

        return redirect()->route('admin.documents.index');
    }

    /**
     * Delete all selected Document at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Document::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }

    /**
     * Restore Document from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
        $document = Document::onlyTrashed()->findOrFail($id);
        $document->restore();

        return redirect()->route('admin.documents.index');
    }

    /**
     * Permanently delete Document from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
        $document = Document::onlyTrashed()->findOrFail($id);
        $document->forceDelete();

        return redirect()->route('admin.documents.index');
    }
}
