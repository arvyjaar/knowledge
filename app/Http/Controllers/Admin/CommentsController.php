<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentsRequest;
use App\Http\Requests\Admin\UpdateCommentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class CommentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Comment.
     *
     * @return Response
     */
    public function index()
    {
        if (! Gate::allows('comment_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('comment_delete')) {
                return abort(401);
            }
            $comments = Comment::onlyTrashed()->get();
        } else {
            $comments = Comment::all();
        }

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating new Comment.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('comment_create')) {
            return abort(401);
        }
        
        $questions = \App\Question::get()->pluck('question', 'id')->prepend('Please select', '');

        return view('admin.comments.create', compact('questions'));
    }

    /**
     * Store a newly created Comment in storage.
     *
     * @param  StoreCommentsRequest  $request
     * @return Response
     */
    public function store(StoreCommentsRequest $request)
    {
        if (! Gate::allows('comment_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $comment = Comment::create($request->all());

        return redirect()->route('admin.comments.index');
    }

    /**
     * Show the form for editing Comment.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('comment_edit')) {
            return abort(401);
        }
        $questions = \App\Question::get()->pluck('question', 'id')->prepend('Please select', '');
        $comment = Comment::findOrFail($id);

        return view('admin.comments.edit', compact('comment', 'questions'));
    }

    /**
     * Update Comment in storage.
     *
     * @param  UpdateCommentsRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCommentsRequest $request, $id)
    {
        if (! Gate::allows('comment_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return redirect()->route('admin.comments.index');
    }

    /**
     * Display Comment.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (! Gate::allows('comment_view')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);

        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Remove Comment from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.comments.index');
    }

    /**
     * Delete all selected Comment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Comment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Comment from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        $comment = Comment::onlyTrashed()->findOrFail($id);
        $comment->restore();

        return redirect()->route('admin.comments.index');
    }

    /**
     * Permanently delete Comment from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        $comment = Comment::onlyTrashed()->findOrFail($id);
        $comment->forceDelete();

        return redirect()->route('admin.comments.index');
    }
}
