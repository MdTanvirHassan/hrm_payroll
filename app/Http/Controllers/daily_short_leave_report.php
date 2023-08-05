<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shortleaves;
use App\Models\employees;
use App\Models\departments;
use App\Models\designations;

use DB;

class daily_short_leave_report extends Controller
{

    public function index(Request $request)
    {

        $employeeId = $request->input('emId');
        
        $designationId = $request->input('designation');
        $departmentId = $request->input('department');
        $date = $request->input('date');
        


       $employee_info = employees::all();
       $designation_info = designations::all();
       $department_info = departments::all();
       $leave =shortleaves::join('employees', 'shortleaves.employeeId', '=', 'employees.employeeId')
            // ->join('leavetypes', 'leaves.leave_type', '=', 'leavetypes.id')
            ->join('designations', 'employees.designation', '=', 'designations.id')
            ->join('departments', 'employees.department', '=', 'departments.id')
            ->select('shortleaves.*','employees.employeeId as em_id','employees.name as em_name','designations.desig_name');
            

         // Apply filters based on search parameters
         if (!empty($employeeId)) {
            $leave->where('shortleaves.employeeId', $employeeId);
        }

        if (!empty($designation)) {
            $leave->where('employees.designation', $designationId);
        }

        if (!empty($department)) {
            $leave->where('employees.department', $departmentId);
        }

        if (!empty($date) ) {
            // Assuming 'startDateLeave' and 'endDateLeave' are the columns for leave dates in the 'leaves' table
            $leave->whereDate('shortleaves.date', '>=', $date);
                
        }

       
         $leave=$leave->get();    
        
        
        return view('leavetypes.leave_report.daily_leave_report.daily_short_leave_report_list', compact('leave','employee_info', 'designation_info', 'department_info','employeeId','designationId','departmentId','date'));
    }
   

    public function destroy($id)
    {
        shortleaves::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
