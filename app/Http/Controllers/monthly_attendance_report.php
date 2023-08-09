<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\confirmattendances;
use App\Models\employees;
use App\Models\designations;
use App\Models\departments;

use DB;

class monthly_attendance_report extends Controller
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
       $attendance_info =confirmattendances::join('employees', 'confirmattendances.emId', '=', 'employees.id')
            ->leftJoin('designations', 'employees.designation', '=', 'designations.id')
            ->leftJoin('departments', 'employees.department', '=', 'departments.id')
            ->leftJoin('leaves', 'confirmattendances.id', '=', 'leaves.id')
            ->leftJoin('leavetypes', 'leaves.id', '=', 'leavetypes.id')
            ->select('confirmattendances.*','employees.id as em_id','employees.name as em_name','employees.joinDate','designations.desig_name','departments.dept_name','departments.dept_short_name','leaves.leave_type','leavetypes.name as leavetypes_name','leavetypes.short_name as leavetypes_short_name',);
            

         // Apply filters based on search parameters
         if (!empty($employeeId)) {
            $attendance_info->where('confirmattendances.emId', $employeeId);
        }

        if (!empty($designationId)) {
            $attendance_info->where('employees.designation', $designationId);
        }

        if (!empty($departmentId)) {
            $attendance_info->where('employees.department', $departmentId);
        }

        if (!empty($start_date) && !empty($end_date)) {
            
            $attendance_info->whereDate('confirmattendances.month', '>=', $start_date)
                ->whereDate('confirmattendances.month', '<=', $end_date);
        }

       
         $attendance_info=$attendance_info->get();    
        
        
        return view('attendance.report.monthly_attendance_report_list', compact('attendance_info','employee_info', 'designation_info', 'department_info','employeeId','designationId','departmentId','start_date', 'end_date'));
    }

   

    public function destroy($id)
    {
        confirmattendances::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
