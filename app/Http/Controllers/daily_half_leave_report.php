<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\halfleaves;
use App\Models\employees;
use App\Models\designations;
use App\Models\departments;

use DB;

class daily_half_leave_report extends Controller
{

    public function index(Request $request)
    {

        $employeeId = $request->input('emId');
        
        $designationId = $request->input('designation');
        $departmentId = $request->input('department');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        


       $employee_info = employees::all();
       $designation_info = designations::all();
       $department_info = departments::all();
       $leave =halfleaves::join('employees', 'halfleaves.employeeId', '=', 'employees.employeeId')
            // ->join('leavetypes', 'leaves.leave_type', '=', 'leavetypes.id')
            ->join('designations', 'employees.designation', '=', 'designations.id')
            ->join('departments', 'employees.department', '=', 'departments.id')
            ->select('halfleaves.*','employees.employeeId as em_id','employees.name as em_name','designations.desig_name');
            

         // Apply filters based on search parameters
         if (!empty($employeeId)) {
            $leave->where('halfleaves.employeeId', $employeeId);
        }

        if (!empty($designationId)) {
            $leave->where('employees.designation', $designationId);
        }

        if (!empty($departmentId)) {
            $leave->where('employees.department', $departmentId);
        }

        if (!empty($startDate) && !empty($endDate)) {
           
            $leave->whereDate('halfleaves.date', '>=', $startDate)
                ->whereDate('halfleaves.date', '<=', $endDate);
                
        }

       
         $leave=$leave->get();    
        
        
        return view('leavetypes.leave_report.daily_leave_report.daily_half_leave_report_list', compact('leave','employee_info', 'designation_info', 'department_info','employeeId','designationId','departmentId','endDate','startDate'));
    }
    public function index2()
    {
       $leave =halfleaves::join('employees', 'halfleaves.employeeId', '=', 'employees.employeeId')
            // ->join('leavetypes', 'halfleaves.leave_type', '=', 'leavetypes.id')
            ->join('designations', 'employees.designation', '=', 'designations.id')
            ->select('halfleaves.*','employees.employeeId as em_id','employees.name as em_name','designations.desig_name')
            ->get();
        
        // echo '<pre>';
        // print_r($leave);
        // exit;
        return view('leavetypes.leave_report.daily_leave_report.daily_half_leave_report_list', compact('leave'));
    }

   

    public function destroy($id)
    {
        halfleaves::destroy($id);
        return redirect()->route('daily_half_leave_report_list')->with('message','Deleted successfully!');
    }

}
