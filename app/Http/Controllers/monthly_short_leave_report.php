<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shortleaves;
use App\Models\employees;
use App\Models\leavetypes;
use Carbon\Carbon;

use DB;

class monthly_short_leave_report extends Controller
{
    public function index()
    {
       $leave =shortleaves::join('employees', 'shortleaves.employeeId', '=', 'employees.employeeId')
            // ->join('leavetypes', 'leaves.leave_type', '=', 'leavetypes.id')
            ->join('designations', 'employees.designation', '=', 'designations.id')
            ->select('shortleaves.*','employees.employeeId as em_id','employees.name as em_name','designations.desig_name')
            ->get();
        
        // echo '<pre>';
        // print_r($leave);
        // exit;
        return view('leavetypes.leave_report.monthly_leave_report.monthly_short_leave_report_list', compact('leave'));
    }

   

    public function destroy($id)
    {
        shortleaves::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }

}
