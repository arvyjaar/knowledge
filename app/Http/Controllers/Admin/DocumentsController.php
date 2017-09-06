<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentsRequest;
use App\Http\Requests\Admin\UpdateDocumentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

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


        if (request('show_deleted') == 1) {
            if (! Gate::allows('document_delete')) {
                return abort(401);
            }
            $documents = Document::onlyTrashed()->get();
        } else {
            $documents = Document::all();
        }

        return view('admin.documents.index', compact('documents'));
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
        
        $categories = \App\Doccategory::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $organisations = \App\Organisation::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $departments = \App\Department::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $changeds = \App\Document::get()->pluck('nr', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.documents.create', compact('categories', 'organisations', 'departments', 'changeds'));
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentsRequest  $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }
        
        $categories = \App\Doccategory::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $organisations = \App\Organisation::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $departments = \App\Department::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $changeds = \App\Document::get()->pluck('nr', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $document = Document::findOrFail($id);

        return view('admin.documents.edit', compact('document', 'categories', 'organisations', 'departments', 'changeds'));
    }

    /**
     * Update Document in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('document_view')) {
            return abort(401);
        }
        
        $categories = \App\Doccategory::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $organisations = \App\Organisation::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $departments = \App\Department::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $changeds = \App\Document::get()->pluck('nr', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$documents = \App\Document::where('changed_id', $id)->get();

        $document = Document::findOrFail($id);

        return view('admin.documents.show', compact('document', 'documents'));
    }


    /**
     * Remove Document from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
