<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employeesalaries;
use App\Models\employees;
use App\Models\absentpayments;
use DB;

class absent_payments extends Controller
{
    public function index()
    {
        $absent_payments_info = absentpayments::all();
        $absent_payments = absentpayments::join('employees', 'absentpayments.emId', '=', 'employees.id')
                                    ->join('designations', 'employees.designation', '=', 'designations.id')
                                    ->join('departments', 'employees.department', '=', 'departments.id')
                                    ->select('absentpayments.*', 'employees.id as em_id', 'employees.name as em_name', 'employees.employeeId','employees.designation','employees.department','departments.dept_short_name','employees.salary','employees.company','designations.desig_name')
                                    
                                     ->get();
        return view('payroll.absent_payments.absent_payments_list', compact('absent_payments','absent_payments_info'));
    }

    public function add_absent_payments()
    {
        $employee_info = employees::join('designations', 'employees.designation', '=', 'designations.id')
         ->select('employees.*','designations.desig_name')->get();                       

        return view('payroll.absent_payments.add_absent_payments', compact('employee_info'));
    }

    public function store(Request $request)
    {
        $data = array();

        $data['emId'] = $request['emId'];
        $data['adjust_month'] = $request['adjust_month'];
        $data['payment_days'] = $request['payment_days'];
        $data['absent_days'] = $request['absent_days'];
        $data['amount'] = $request['amount'];
        $data['status'] = $request['status'];
        
        
        absentpayments::insert($data);
        return redirect()->route('absent_payments_list')->with('message','Added successfully!');
        //return back();
    }

    public function edit_absent_payments(Request $request, $id)
    {
        $absent_payments_info = absentpayments::findOrFail($id);

        $employee = employees::where('id',$absent_payments_info->emId)->first();

        $employee_info = DB::table('employees')
                    ->join('designations', 'employees.designation', '=', 'designations.id')
                     ->select('employees.*','designations.desig_name')
                    ->get();
       
        return view('payroll.absent_payments.edit_absent_payments', compact('absent_payments_info','employee_info','employee'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $absent_payments = absentpayments::findOrFail($id);
        

        $absent_payments->emId = $request->emId;
        $absent_payments->adjust_month = $request->adjust_month;
        $absent_payments->payment_days = $request->payment_days;
        $absent_payments->amount = $request->amount;
        $absent_payments->status = $request->status;
       

        $absent_payments->save();
        return redirect()->route('absent_payments_list')->with('message','Updated successfully!');
    }


    public function view_absent_payments(Request $request, $id)
    {
        $absent_payments_info = absentpayments::findOrFail($id);

        $employee = employees::where('id',$absent_payments_info->emId)->first();

        $employee_info = DB::table('employees')
                    ->join('designations', 'employees.designation', '=', 'designations.id')
                     ->select('employees.*','designations.desig_name')
                    ->get();
       
        return view('payroll.absent_payments.view_absent_payments', compact('absent_payments_info','employee_info','employee'));
    }


    public function destroy($id)
    {
        absentpayments::destroy($id);
        return redirect()->route('absent_payments_list')->with('message','Deleted successfully!');
    }
}
