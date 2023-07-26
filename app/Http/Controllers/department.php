<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departments;
use DB;

class Department extends Controller
{
    public function index()
    {
        $department = departments::get();
        return view('settings.departments.department_list', compact('department'));
    }

    public function add_department()
    {
        return view('settings.departments.add_dept');
    }

    public function store(Request $request)
    {
        $data = array();
        $data['dept_name'] = $request['dept_name'];
        $data['dep_description'] = $request['dep_description'];
        $data['dept_short_name'] = $request['dept_short_name'];
        // $data['department_id'] = $request['department_id'];
        departments::insert($data);
        return redirect()->route('department_list')->with('message','Added successfully!');
        //return back();
    }

    public function edit_department(Request $request, $id)
    {
        $department_info = departments::findOrFail($id);
        return view('settings.departments.edit_dept', compact('department_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $department = departments::findOrFail($id);
        // print_r($department);
        // exit;

        $department->dept_name = $request->dept_name;
        $department->dep_description = $request->dep_description;
        $department->dept_short_name = $request->dept_short_name;
        // $department->department_rank = $request->department_rank;

        $department->save();
        return redirect()->route('department_list')->with('message','Updated successfully!');
    }


    public function view_department(Request $request, $id)
    {
        $department_info = departments::findOrFail($id);
        return view('settings.departments.view_dept', compact('department_info'));
    }


    public function destroy($id)
    {
        departments::destroy($id);
        return redirect()->route('department_list')->with('message','Deleted successfully!');
    }
}
