<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Appeal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTagsRequest;
use App\Http\Requests\Admin\UpdateTagsRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of Tag.
     *
     * @return Response
     */
    public function index()
    {
        if (! Gate::allows('tag_access')) {
            return abort(401);
        }
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating new Tag.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('tag_create')) {
            return abort(401);
        }
        return view('admin.tags.create');
    }

    /**
     * Store a newly created Tag in storage.
     *
     * @param  StoreTagsRequest  $request
     * @return Response
     */
    public function store(StoreTagsRequest $request)
    {
        if (! Gate::allows('tag_create')) {
            return abort(401);
        }
        $tag = Tag::create($request->all());

        return redirect()->route('admin.tags.index');
    }

    /**
     * Show the form for editing Tag.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('tag_edit')) {
            return abort(401);
        }
        $tag = Tag::findOrFail($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update Tag in storage.
     *
     * @param  UpdateTagsRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateTagsRequest $request, $id)
    {
        if (! Gate::allows('tag_edit')) {
            return abort(401);
        }
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return redirect()->route('admin.tags.index');
    }

    /**
     * Display Tag.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (! Gate::allows('tag_view')) {
            return abort(401);
        }
        $appeals = Appeal::whereHas(
            'tags',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    }
        )->get();

        $tag = Tag::findOrFail($id);

        return view('admin.tags.show', compact('tag', 'appeals'));
    }

    /**
     * Remove Tag from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('tag_delete')) {
            return abort(401);
        }
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('admin.tags.index');
    }

    /**
     * Delete all selected Tag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('tag_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Tag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
