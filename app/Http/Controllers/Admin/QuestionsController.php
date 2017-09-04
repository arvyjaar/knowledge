<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Category;
use App\Department;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionsRequest;
use App\Http\Requests\Admin\UpdateQuestionsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\Datatables\Datatables;

class QuestionsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Question.
     *
     * @return Response
     */
    public function index()
    {
        if (! Gate::allows('question_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('question_delete')) {
                return abort(401);
            }
            $questions = Question::onlyTrashed()->get();
        } else {
            $questions = Question::all();
        }

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating new Question.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('question_create')) {
            return abort(401);
        }
        
        $categories = Category::get()->pluck('category', 'id')->prepend('Please select', '');
        $departments = Department::get()->pluck('title', 'id')->prepend('Please select', '');

        return view('admin.questions.create', compact('categories', 'departments'));
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param  StoreQuestionsRequest  $request
     * @return Response
     */
    public function store(StoreQuestionsRequest $request)
    {
        if (! Gate::allows('question_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $question = Question::create($request->all());

        foreach ($request->input('file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $question->id;
            $file->save();
        }

        return redirect()->route('admin.questions.index');
    }

    /**
     * Show the form for editing Question.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('question_edit')) {
            return abort(401);
        }
        
        $categories = Category::get()->pluck('category', 'id')->prepend('Please select', '');
        $departments = Department::get()->pluck('title', 'id')->prepend('Please select', '');

        $question = Question::findOrFail($id);

        return view('admin.questions.edit', compact('question', 'categories', 'departments'));
    }

    /**
     * Update Question in storage.
     *
     * @param  UpdateQuestionsRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateQuestionsRequest $request, $id)
    {
        if (! Gate::allows('question_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $question = Question::findOrFail($id);
        $question->update($request->all());

        $media = [];
        foreach ($request->input('file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $question->id;
            $file->save();
            $media[] = $file;
        }
        $question->updateMedia($media, 'file');

        return redirect()->route('admin.questions.index');
    }

    /**
     * Display Question.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (! Gate::allows('question_view')) {
            return abort(401);
        }
        
        $categories = Category::get()->pluck('category', 'id')->prepend('Please select', '');
        $departments = Department::get()->pluck('title', 'id')->prepend('Please select', '');
        $comments = Comment::where('question_id', $id)->get();
        $question = Question::findOrFail($id);

        return view('admin.questions.show', compact('question', 'comments'));
    }

    /**
     * Remove Question from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::findOrFail($id);
        $question->deletePreservingMedia();

        return redirect()->route('admin.questions.index');
    }

    /**
     * Delete all selected Question at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('question_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Question::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }

    /**
     * Restore Question from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        if (! Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->restore();

        return redirect()->route('admin.questions.index');
    }

    /**
     * Permanently delete Question from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->forceDelete();

        return redirect()->route('admin.questions.index');
    }
}
