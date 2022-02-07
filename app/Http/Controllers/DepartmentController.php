<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    public function index()
    {
        return DepartmentResource::collection(Department::get());
    }
    public function store(Request $request)
    {
        $request->merge(array('name'=>strtoupper($request->name),'code' => strtoupper($request->code)));
        $validated = $request->validate([
            'code' => 'required|unique:departments',
            'name' => 'required|unique:departments',
        ]);

        $department = new Department();
        $department->name = strtoupper($request->name);
        $department->code = strtoupper($request->code);
        $department->save();
        return DepartmentResource::make($department);
    }
    public function destroy($id)
    {
        $department =Department::find($id);
        $department->delete();
        return DepartmentResource::make($department);
    }
}
