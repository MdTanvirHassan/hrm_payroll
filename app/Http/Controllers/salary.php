<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employeesalaries;
use App\Models\employees;
use App\Models\banks;
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
        $employee_info = DB::table('employees')
                    ->join('designations', 'employees.designation', '=', 'designations.id')
                     ->select('employees.*','designations.desig_name')
                    ->get();
        $bank_info = banks::all();                        

        return view('payroll.salary.add_salary', compact('employee_info','bank_info'));
    }

    public function store(Request $request)
    {
        
        $data = array();
        $data['employeeId'] = $request['employeeId'];

        $employee_info = employees::findOrFail($request['employeeId']);

        $pre_salary_info=employeesalaries::where('employeeId',$request['employeeId'])->first();
       

        if(!empty($pre_salary_info)){
            $pre_salary_info->gross = $request['gross'];
            $pre_salary_info->others = $request['others'];
            $pre_salary_info->net_gross = $request['net_gross'];
            $pre_salary_info->Stamp = $request['Stamp'];
            $pre_salary_info->Tax = $request['Tax'];
            $pre_salary_info->security_amount = $request['security_amount'];

            $gross = $request['gross'];
            $basicPercent = $request['basic_percent'];
            $houseRentPercent = $request['house_rent_percent'];
            $medicalPercent = $request['medical_percent'];

            $pre_salary_info->Basic=$basic = round(($gross * $basicPercent) / 100, 2);
            $pre_salary_info->HouseRent=$h_rent = round(($basic * $houseRentPercent) / 100, 2);
            $pre_salary_info->Medical=$medical = round(($basic * $medicalPercent) / 100, 2);
            $pre_salary_info->Transport=$transport = $gross - ($basic + $h_rent + $medical);


            $pre_salary_info->save();

        }else{
            $data['employeeId'] = $request['employeeId'];
            $data['gross'] = $request['gross'];
            $data['others'] = $request['others'];
            $data['net_gross'] = $request['net_gross'];
            $data['Stamp'] = $request['Stamp'];
            $data['Tax'] = $request['Tax'];
            $data['security_amount'] = $request['security_amount'];


            $gross = $request['gross'];
            $basicPercent = $request['basic_percent'];
            $houseRentPercent = $request['house_rent_percent'];
            $medicalPercent = $request['medical_percent'];

            $data['Basic'] =$basic = round(($gross * $basicPercent) / 100, 2);
            $data['HouseRent'] =$h_rent = round(($basic * $houseRentPercent) / 100, 2);
            $data['Medical'] =$medical = round(($basic * $medicalPercent) / 100, 2);
            $data['Transport'] =$transport = $gross - ($basic + $h_rent + $medical);
            
            employeesalaries::insert($data);
        }
   
        $employee_info->distribution_type = $request['distribution_type'];
        $employee_info->bank_portion = $request['bank_portion'];
        $employee_info->cash_portion = $request['cash_portion'];
        $employee_info->bank_id = $request['bank_id'];
        $employee_info->bank_acct_no = $request['bank_acct_no'];
        $employee_info->salary_held_up = $request['salary_held_up'];
        $employee_info->save();


        

        
        

        return redirect()->route('salary_list')->with('message','Added successfully!');
        //return back();
    }

    public function edit_salary(Request $request, $id)
    {
        $salary_info = employeesalaries::findOrFail($id);

        $employee_bank_info = employees::where('id',$salary_info->employeeId)->first();

        $employee_info = employees::join('designations', 'employees.designation', '=', 'designations.id')
                     ->select('employees.*','designations.desig_name')
                    ->get();
        $bank_info = banks::all();
       
        return view('payroll.salary.edit_salary', compact('salary_info', 'employee_info','employee_bank_info', 'bank_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $salary = employeesalaries::findOrFail($id);
        $salary->employeeId = $request->employeeId;
        $salary->gross = $request->gross;
        $salary->others = $request->others;
        $salary->net_gross = $request->net_gross;
        $salary->Stamp = $request->Stamp;
        $salary->Tax = $request->Tax;
        $salary->security_amount = $request->security_amount;
        $gross = $request['gross'];
        $basicPercent = $request['basic_percent'];
        $houseRentPercent = $request['house_rent_percent'];
        $medicalPercent = $request['medical_percent'];

        $salary->Basic=$basic = round(($gross * $basicPercent) / 100, 2);
        $salary->HouseRent=$h_rent = round(($basic * $houseRentPercent) / 100, 2);
        $salary->Medical=$medical = round(($basic * $medicalPercent) / 100, 2);
        $salary->Transport=$transport = $gross - ($basic + $h_rent + $medical);
        $salary->save();

        $employee_info = employees::findOrFail($request['employeeId']);
        $employee_info->distribution_type = $request['distribution_type'];
        $employee_info->bank_portion = $request['bank_portion'];
        $employee_info->cash_portion = $request['cash_portion'];
        $employee_info->bank_id = $request['bank_id'];
        $employee_info->bank_acct_no = $request['bank_acct_no'];
        $employee_info->salary_held_up = $request['salary_held_up'];
        $employee_info->save();
        return redirect()->route('salary_list')->with('message','Updated successfully!');
    }


    public function view_salary(Request $request, $id)
    {
        $salary_info = employeesalaries::findOrFail($id);

        $employee_bank_info = employees::where('id',$salary_info->employeeId)->first();

        $employee_info = DB::table('employees')
                    ->join('designations', 'employees.designation', '=', 'designations.id')
                     ->select('employees.*','designations.desig_name')
                    ->get();
        $bank_info = banks::all();

        return view('payroll.salary.view_salary', compact('salary_info', 'employee_info','employee_bank_info', 'bank_info'));
    }


    public function destroy($id)
    {
        employeesalaries::destroy($id);
        return redirect()->route('salary_list')->with('message','Deleted successfully!');
    }
}
