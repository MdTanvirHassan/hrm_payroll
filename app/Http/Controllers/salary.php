<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employeesalaries;
use DB;

class salary extends Controller
{
    public function index()
    {
        $salary_info = employeesalaries::all();
        $salary = employeesalaries::join('employees', 'employeesalaries.employeeId', '=', 'employees.id')
                                    ->join('designations', 'employees.designation', '=', 'designations.id')
                                    // ->select('employees.*', 'designations.id', 'designations.desig_name')
                                    ->select('employeesalaries.*', 'employees.id as em_id', 'employees.name as em_name', 'employees.employeeId','employees.designation','employees.department','employees.salary','employees.company','designations.desig_name')
                                    
                                     ->get();

        return view('payroll.salary.salary_list', compact('salary', 'salary_info'));
    }

    public function add_salary()
    {
        $employee_info = Db::table('employees')->select('employees.*')->get();
        $salary_info = employeesalaries::join('employees', 'employeesalaries.employeeId', '=', 'employees.id')
                                    ->join('designations', 'employees.designation', '=', 'designations.id')
                                    // ->select('employees.*', 'designations.id', 'designations.desig_name')
                                    ->select('employeesalaries.*', 'employees.id', 'employees.name as em_name', 'employees.employeeId','employees.designation','employees.department','employees.salary','employees.company','designations.desig_name')->get();

        return view('payroll.salary.add_salary', compact('salary_info','employee_info'));
    }

    public function store(Request $request)
    {
        $data = array();
        $data['employeeId'] = $request['employeeId'];
        // $data['name'] = $request['name'];
        //$data['designation'] = $request['designation'];
        $data['gross'] = $request['gross'];
        $data['others'] = $request['others'];
        $data['net_gross'] = $request['net_gross'];
        $data['Stamp'] = $request['Stamp'];
        $data['Tax'] = $request['Tax'];
        $data['security_amount'] = $request['security_amount'];
        // $data['net_gross'] = $request['net_gross'];
        // $data['net_gross'] = $request['net_gross'];
        employeesalaries::insert($data);
        return redirect()->route('salary_list')->with('message','Added successfully!');
        //return back();
    }

    public function edit_salary(Request $request, $id)
    {
        $salary_info = employeesalaries::findOrFail($id);

        $employee_info = Db::table('employees')->select('employees.*')->get();

        $salary_details = employeesalaries::join('employees', 'employeesalaries.employeeId', '=', 'employees.id')
        ->join('designations', 'employees.designation', '=', 'designations.id')
        ->select('employeesalaries.*', 'employees.id', 'employees.name as em_name', 'employees.employeeId','employees.designation','employees.department','employees.salary','employees.company','designations.desig_name')->get();
       
        return view('payroll.salary.edit_salary', compact('salary_info', 'employee_info', 'salary_details'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $salary = employeesalaries::findOrFail($id);
        // print_r($salary);
        // exit;

        $salary->employeeId = $request->employeeId;
        $salary->gross = $request->gross;
        $salary->others = $request->others;
        $salary->net_gross = $request->net_gross;
        $salary->Stamp = $request->Stamp;
        $salary->Tax = $request->Tax;
        $salary->security_amount = $request->security_amount;
       

        $salary->save();
        return redirect()->route('salary_list')->with('message','Updated successfully!');
    }


    public function view_salary(Request $request, $id)
    {
        $salary_info = employeesalaries::findOrFail($id);
        $employee_info = Db::table('employees')->select('employees.*')->get();
        $salary_details = employeesalaries::join('employees', 'employeesalaries.employeeId', '=', 'employees.id')
        ->join('designations', 'employees.designation', '=', 'designations.id')
        ->select('employeesalaries.*', 'employees.id', 'employees.name as em_name', 'employees.employeeId','employees.designation','employees.department','employees.salary','employees.company','designations.desig_name')->get();

        return view('payroll.salary.view_salary', compact('salary_info', 'employee_info', 'salary_details'));
    }


    public function destroy($id)
    {
        employeesalaries::destroy($id);
        return redirect()->route('salary_list')->with('message','Deleted successfully!');
    }
}
