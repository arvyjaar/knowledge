<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Category;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentsRequest;
use App\Http\Requests\Admin\UpdateDepartmentsRequest;
use Yajra\Datatables\Datatables;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of Department.
     *
     * @return Response
     */
    public function index()
    {
        if (! Gate::allows('department_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('department_delete')) {
                return abort(401);
            }
            $departments = Department::onlyTrashed()->get();
        } else {
            $departments = Department::all();
        }

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating new Department.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('department_create')) {
            return abort(401);
        }
        return view('admin.departments.create');
    }

    /**
     * Store a newly created Department in storage.
     *
     * @param  StoreDepartmentsRequest  $request
     * @return Response
     */
    public function store(StoreDepartmentsRequest $request)
    {
        if (! Gate::allows('department_create')) {
            return abort(401);
        }
        $department = Department::create($request->all());

        return redirect()->route('admin.departments.index');
    }

    /**
     * Show the form for editing Department.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('department_edit')) {
            return abort(401);
        }
        $department = Department::findOrFail($id);

        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update Department in storage.
     *
     * @param  UpdateDepartmentsRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateDepartmentsRequest $request, $id)
    {
        if (! Gate::allows('department_edit')) {
            return abort(401);
        }
        $department = Department::findOrFail($id);
        $department->update($request->all());

        return redirect()->route('admin.departments.index');
    }

    /**
     * Display Department.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (! Gate::allows('department_view')) {
            return abort(401);
        }
        $categories = Category::where('department_id', $id)->get();
        $questions = Question::where('department_id', $id)->get();

        $department = Department::findOrFail($id);

        return view('admin.departments.show', compact('department', 'categories', 'questions'));
    }

    /**
     * Remove Department from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('department_delete')) {
            return abort(401);
        }
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('admin.departments.index');
    }

    /**
     * Delete all selected Department at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('department_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Department::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Department from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        if (! Gate::allows('department_delete')) {
            return abort(401);
        }
        $department = Department::onlyTrashed()->findOrFail($id);
        $department->restore();

        return redirect()->route('admin.departments.index');
    }

    /**
     * Permanently delete Department from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('department_delete')) {
            return abort(401);
        }
        $department = Department::onlyTrashed()->findOrFail($id);
        $department->forceDelete();

        return redirect()->route('admin.departments.index');
    }
}
