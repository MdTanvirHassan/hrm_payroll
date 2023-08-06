<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leaves;
use App\Models\employees;
use App\Models\designations;
use App\Models\departments;

use DB;

class leave_register extends Controller
{
    public function index(Request $request)
    {

        $employeeId = $request->input('emId');
        
        $designationId = $request->input('designation');
        $departmentId = $request->input('department');
        $year = $request->input('date');
        


       $employee_info = employees::all();
       $designation_info = designations::all();
       $department_info = departments::all();
       $leave =leaves::join('employees', 'leaves.employeeId', '=', 'employees.employeeId')
            ->join('leavetypes', 'leaves.leave_type', '=', 'leavetypes.id')
            ->join('designations', 'employees.designation', '=', 'designations.id')
            ->join('departments', 'employees.department', '=', 'departments.id')
            ->select('leaves.*','employees.employeeId as em_id','employees.name as em_name','leavetypes.name as leave_type_name','leavetypes.allowedLeave','designations.desig_name');
            

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

        if (!empty($year) ) {
            // Assuming 'startDateLeave' and 'endDateLeave' are the columns for leave dates in the 'leaves' table
            $leave->whereDate('leaves.year', '=', $year);
              
        }

       
         $leave=$leave->get();    
        
        
        return view('leavetypes.leave_report.leave_register_list', compact('leave','employee_info', 'designation_info', 'department_info','employeeId','designationId','departmentId','year', ));
    }

   

    public function destroy($id)
    {
        leaves::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
