<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leaves;
use App\Models\employees;
use App\Models\designations;
use App\Models\departments;

use DB;

class daily_leave_report extends Controller
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
       $leave =leaves::join('employees', 'leaves.employeeId', '=', 'employees.employeeId')
            ->join('leavetypes', 'leaves.leave_type', '=', 'leavetypes.id')
            ->join('designations', 'employees.designation', '=', 'designations.id')
            ->join('departments', 'employees.department', '=', 'departments.id')
            ->select('leaves.*','employees.employeeId as em_id','employees.name as em_name','leavetypes.name as leave_type_name','designations.desig_name');
            

         // Apply filters based on search parameters
         if (!empty($employeeId)) {
            $leave->where('leaves.employeeId', $employeeId);
        }

        if (!empty($designation)) {
            $leave->where('employees.designation', $designationId);
        }

        if (!empty($department)) {
            $leave->where('employees.department', $departmentId);
        }

        if (!empty($start_date) && !empty($end_date)) {
            
            $leave->whereDate('leaves.startDateLeave', '>=', $start_date)
                ->whereDate('leaves.endDateLeave', '<=', $end_date);
        }

       
         $leave=$leave->get();    
        
        
        return view('leavetypes.leave_report.daily_leave_report.daily_leave_report_list', compact('leave','employee_info', 'designation_info', 'department_info','employeeId','designationId','departmentId','start_date', 'end_date'));
    }

   

    public function destroy($id)
    {
        leaves::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
