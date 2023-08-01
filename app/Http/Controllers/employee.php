<?php

namespace App\Http\Controllers;
use App\Models\employees;

use Illuminate\Http\Request;

class employee extends Controller
{
    public function index()
    {    
        return view('employees.employee_list');
    }
    public function add_employee()
    {    
        return view('employees.add');
    }

    public function store(Request $request)
    {  
        $data=array();  
        $data['name'] = $request['name'];
        $data['designation'] = $request['designation'];
        $data['department'] = $request['department'];
        $data['phone'] = $request['phone'];
        employees::insert($data);
        return redirect()->route('employee_list');
        // echo '<pre>';
        // print_r(employee::insert($data));
        // exit;
        //return back();
    }

    public function edit_employee(Request $request, $id)
    {    
        $employee_info= employees::findOrFail($id);
        return view('employees.edit',compact('employee_info'));
    }

    public function update(Request $request)
    {  
        $id=$request->id;
        $employee = employees::findOrFail($id);
        // print_r($employee);
        // exit;
        
        $employee->name = $request->name;
        $employee->designation = $request->designation;
        $employee->department = $request->department;
        $employee->phone = $request->phone;
        $employee->email = $request->email;

        $employee->save();   
        return redirect()->route('employee_list');
        
    }


    public function view_employee(Request $request, $id)
    {    
        $employee_info= employees::findOrFail($id);    
        return view('employees.view',compact('employee_info'));
    }


    public function destroy($id)
    {
        employees::destroy($id);
        return redirect()->route('employee_list');
    }
}
