<?php

namespace Backstage\Crm\Http\Controllers\Api;

use Backstage\Crm\Models\Department;
use Backstage\Crm\Resources\DepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }

    public function show(Department $Department)
    {
        return new DepartmentResource($Department);
    }

    public function store(Request $request)
    {
        $Department = Department::create($request->input());

        return new DepartmentResource($Department);
    }

    public function update(Request $request, Department $Department)
    {
        $Department->update($request->input());

        return new DepartmentResource($Department);
    }

    public function destroy(Department $Department)
    {
        $Department->delete();

        return response()->noContent();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $Departments = Department::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        return DepartmentResource::collection($Departments);
    }
}
