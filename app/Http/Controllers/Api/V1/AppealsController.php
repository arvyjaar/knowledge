<?php

namespace App\Http\Controllers\Api\V1;

use App\Appeal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppealsRequest;
use App\Http\Requests\Admin\UpdateAppealsRequest;

class AppealsController extends Controller
{
    public function index()
    {
        return Appeal::all();
    }

    public function show($id)
    {
        return Appeal::findOrFail($id);
    }

    public function update(UpdateAppealsRequest $request, $id)
    {
        $appeal = Appeal::findOrFail($id);
        $appeal->update($request->all());

        return $appeal;
    }

    public function store(StoreAppealsRequest $request)
    {
        $appeal = Appeal::create($request->all());

        return $appeal;
    }

    public function destroy($id)
    {
        $appeal = Appeal::findOrFail($id);
        $appeal->delete();
        return '';
    }
}
