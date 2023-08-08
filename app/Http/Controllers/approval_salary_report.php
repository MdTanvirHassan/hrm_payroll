<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\genaratedsalaries;
use App\Models\employees;
use App\Models\designations;
use App\Models\departments;

use DB;

class approval_salary_report extends Controller
{
    public function index(Request $request)
    {

        $employeeId = $request->input('emId');
        
        $designationId = $request->input('designation');
        $departmentId = $request->input('department');
        $start_date = $request->input('startDateLeave');
        $end_date = $request->input('endDateLeave');


       $employee_info = employees::all();
       $designation_info = designations::all();
       $department_info = departments::all();
       $generate_info =genaratedsalaries::join('employees', 'genaratedsalaries.emId', '=', 'employees.id')
            ->leftJoin('designations', 'employees.designation', '=', 'designations.id')
            ->leftJoin('departments', 'employees.department', '=', 'departments.id')
            ->select('genaratedsalaries.*','employees.id as em_id','employees.name as em_name','employees.joinDate','designations.desig_name','departments.dept_name','departments.dept_short_name');
            

         // Apply filters based on search parameters
         if (!empty($employeeId)) {
            $generate_info->where('genaratedsalaries.emId', $employeeId);
        }

        if (!empty($designationId)) {
            $generate_info->where('employees.designation', $designationId);
        }

        if (!empty($departmentId)) {
            $generate_info->where('employees.department', $departmentId);
        }

        if (!empty($start_date) && !empty($end_date)) {
            
            $generate_info->whereDate('genaratedsalaries.month', '>=', $start_date)
                ->whereDate('genaratedsalaries.month', '<=', $end_date);
        }

       
         $generate_info=$generate_info->get();    
        
        
        return view('payroll.report.approval_salary_report_list', compact('generate_info','employee_info', 'designation_info', 'department_info','employeeId','designationId','departmentId','start_date', 'end_date'));
    }

   

    public function destroy($id)
    {
        genaratedsalaries::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
