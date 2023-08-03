<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\halfleaves;
use App\Models\employees;
use App\Models\leavetypes;
use Carbon\Carbon;

use DB;

class daily_half_leave_report extends Controller
{
    public function index()
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
