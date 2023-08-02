<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employeesalaries;
use App\Models\employees;
use App\Models\salaryarrears;
use DB;

class salary_arrear extends Controller
{
    public function index()
    {
        $salary_arrear_info = salaryarrears::all();
        $salary_arrear = salaryarrears::join('employees', 'salaryarrears.emId', '=', 'employees.id')
                                    ->join('designations', 'employees.designation', '=', 'designations.id')
                                    ->join('departments', 'employees.department', '=', 'departments.id')
                                    ->select('salaryarrears.*', 'employees.id as em_id', 'employees.name as em_name', 'employees.employeeId','employees.designation','employees.department','departments.dept_short_name','employees.salary','employees.company','designations.desig_name')
                                    
                                     ->get();
        return view('payroll.salary_arrear.salary_arrear_list', compact('salary_arrear','salary_arrear_info'));
    }

    public function add_salary_arrear()
    {
        $employee_info = employees::join('designations', 'employees.designation', '=', 'designations.id')
         ->select('employees.*','designations.desig_name')->get();                       

        return view('payroll.salary_arrear.add_salary_arrear', compact('employee_info'));
    }

    public function store(Request $request)
    {
        $data = array();

        $data['emId'] = $request['emId'];
        $data['adjust_month'] = $request['adjust_month'];
        $data['payable_days'] = $request['payable_days'];
        $data['amount'] = $request['amount'];
        $data['status'] = $request['status'];
        
        
        salaryarrears::insert($data);
        return redirect()->route('salary_arrear_list')->with('message','Added successfully!');
        //return back();
    }

    public function edit_salary_arrear(Request $request, $id)
    {
        $salary_arrear_info = salaryarrears::findOrFail($id);

        $employee = employees::where('id',$salary_arrear_info->emId)->first();

        $employee_info = DB::table('employees')
                    ->join('designations', 'employees.designation', '=', 'designations.id')
                     ->select('employees.*','designations.desig_name')
                    ->get();
       
        return view('payroll.salary_arrear.edit_salary_arrear', compact('salary_arrear_info','employee_info','employee'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $salary_arrear = salaryarrears::findOrFail($id);
        

        $salary_arrear->emId = $request->emId;
        $salary_arrear->adjust_month = $request->adjust_month;
        $salary_arrear->payable_days = $request->payable_days;
        $salary_arrear->amount = $request->amount;
        $salary_arrear->status = $request->status;
       

        $salary_arrear->save();
        return redirect()->route('salary_arrear_list')->with('message','Updated successfully!');
    }


    public function view_salary_arrear(Request $request, $id)
    {
        $salary_arrear_info = salaryarrears::findOrFail($id);

        $employee = employees::where('id',$salary_arrear_info->emId)->first();

        $employee_info = DB::table('employees')
                    ->join('designations', 'employees.designation', '=', 'designations.id')
                     ->select('employees.*','designations.desig_name')
                    ->get();
       
        return view('payroll.salary_arrear.view_salary_arrear', compact('salary_arrear_info','employee_info','employee'));
    }


    public function destroy($id)
    {
        salaryarrears::destroy($id);
        return redirect()->route('salary_arrear_list')->with('message','Deleted successfully!');
    }
}
