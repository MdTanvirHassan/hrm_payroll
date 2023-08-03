<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leaves;
use App\Models\employees;
use App\Models\leavetypes;
use Carbon\Carbon;

use DB;

class monthly_leave_report extends Controller
{
    public function index()
    {
       $leave =leaves::join('employees', 'leaves.employeeId', '=', 'employees.employeeId')
            ->join('leavetypes', 'leaves.leave_type', '=', 'leavetypes.id')
            ->join('designations', 'employees.designation', '=', 'designations.id')
            ->select('leaves.*','employees.employeeId as em_id','employees.name as em_name','leavetypes.name as leave_type_name','designations.desig_name')
            ->get();
        
        // echo '<pre>';
        // print_r($leave);
        // exit;
        return view('leavetypes.leave_report.monthly_leave_report.monthly_leave_report_list', compact('leave'));
    }

   

    public function destroy($id)
    {
        leaves::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
