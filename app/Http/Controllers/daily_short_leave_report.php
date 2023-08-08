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
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        


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

        if (!empty($designationId)) {
            $leave->where('employees.designation', $designationId);
        }

        if (!empty($departmentId)) {
            $leave->where('employees.department', $departmentId);
        }

        if (!empty($startDate) && !empty($endDate)) {
           
            $leave->whereDate('shortleaves.date', '>=', $startDate)
                ->whereDate('shortleaves.date', '<=', $endDate);
                
        }

       
         $leave=$leave->get();    
        
        
        return view('leavetypes.leave_report.daily_leave_report.daily_short_leave_report_list', compact('leave','employee_info', 'designation_info', 'department_info','employeeId','designationId','departmentId','endDate','startDate'));
    }
   

    public function destroy($id)
    {
        shortleaves::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
