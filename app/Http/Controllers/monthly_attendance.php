<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\attendances;
use App\Models\employees;
use App\Models\designations;
use App\Models\departments;

use DB;

class monthly_attendance extends Controller
{
    public function index(Request $request)
    {

        $employeeId = $request->input('emId');
        
        $designationId = $request->input('designation');
        $departmentId = $request->input('department');
        $month = $request->input('startDateLeave');
        $year = $request->input('endDateLeave');
        $str = '';


       $employee_info = employees::all();
       $designation_info = designations::all();
       $department_info = departments::all();
       $attendance_info =attendances::join('employees', 'attendances.employeeId', '=', 'employees.id')
            ->leftJoin('designations', 'employees.designation', '=', 'designations.id')
            ->leftJoin('departments', 'employees.department', '=', 'departments.id')
            ->leftJoin('leaves', 'attendances.id', '=', 'leaves.id')
            ->leftJoin('leavetypes', 'leaves.id', '=', 'leavetypes.id')
            ->select('attendances.*','employees.id as em_id','employees.name as em_name','employees.joinDate','designations.desig_name','departments.dept_name','departments.dept_short_name','leaves.leave_type','leavetypes.name as leavetypes_name','leavetypes.short_name as leavetypes_short_name',);

            $days_in_month = date('t', mktime(0, 0, 0, $month, 2, $year));
            for ($x = 0; $x < $days_in_month; $x++) {
                $str .= '<td class="calendar-day-head">' . ($x + 1) . ' </td>';
            }
            for ($x = 0; $x < $days_in_month; $x++) {
            $day = date("l", strtotime($year . '-' . $month . '-' . ($x + 1)));
            $str .= '<td class=" {{ $day === "4" ? "bg-info calendar-day-head":" calendar-day-head"}}">' . substr($day, 0, 3) . ' </td>';
        }
            

         // Apply filters based on search parameters
         if (!empty($employeeId)) {
            $attendance_info->where('attendances.employeeId', $employeeId);
        }

        if (!empty($designationId)) {
            $attendance_info->where('employees.designation', $designationId);
        }

        if (!empty($departmentId)) {
            $attendance_info->where('employees.department', $departmentId);
        }

        if (!empty($start_date) && !empty($end_date)) {
            
            $attendance_info->whereDate('attendances.date', '>=', $start_date)
                ->whereDate('attendances.date', '<=', $end_date);
        }

       
         $attendance_info=$attendance_info->get();    
        
        
        return view('attendance.monthly_attendance_list', compact('attendance_info','employee_info', 'designation_info', 'department_info','employeeId','designationId','departmentId'
        ,'year',
        'month',
        'days_in_month', 
        'str'));
    }

   

    public function destroy($id)
    {
        attendances::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
