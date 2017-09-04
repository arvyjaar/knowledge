<?php

namespace App\Http\Controllers\Api\V1;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionsRequest;
use App\Http\Requests\Admin\UpdateQuestionsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\Datatables\Datatables;

class QuestionsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Question::all();
    }

    public function show($id)
    {
        return Question::findOrFail($id);
    }

    public function update(UpdateQuestionsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $question = Question::findOrFail($id);
        $question->update($request->all());

        return $question;
    }

    public function store(StoreQuestionsRequest $request)
    {
        $request = $this->saveFiles($request);
        $question = Question::create($request->all());

        return $question;
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return '';
    }
}
