<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leaves;
use App\Models\leavetypes;
use Carbon\Carbon;

use DB;

class full_leaves extends Controller
{
    public function index()
    {
       $leave =leaves::join('employees', 'leaves.employeeId', '=', 'employees.id')
            ->join('leavetypes', 'leaves.leave_type', '=', 'leavetypes.id')
            ->select('leaves.*','employees.name','leavetypes.name as leave_type_name')
            ->get();
        
        // echo '<pre>';
        // print_r($leave);
        // exit;
        return view('leavetypes.fullleaves.full_leave_list', compact('leave'));
    }

    public function add_full_leave()
    {
        // $leave_info = DB::table('leaves')
        //     ->join('employees', 'leaves.employeeId', '=', 'employees.id')
        //     ->get();
        
        $leave_info = DB::table('employees')->get();
        $leave_type = leavetypes::get();

        return view('leavetypes.fullleaves.add_full_leave', compact('leave_info', 'leave_type'));
    }
    

    

    public function store(Request $request)
    {
        $request->validate([
            'employeeId' => 'required',
            'leave_type' => 'required',
            'startDateLeave' => 'required|date',
            'endDateLeave' => 'required|date|after_or_equal:startDateLeave',
            // 'status' => 'required',
        ]);
    
        // Calculate the number of leave days
        $startDate = Carbon::parse($request->startDateLeave);
        $endDate = Carbon::parse($request->endDateLeave);
        $daysDifference = $endDate->diffInDays($startDate);
        $leaveDay = $daysDifference + 1; // Include both start and end dates
    
        // Now you can save the data to the database
        $data = [
            'employeeId' => $request->employeeId,
            'leave_type' => $request->leave_type,
            'startDateLeave' => $request->startDateLeave,
            'endDateLeave' => $request->endDateLeave,
            'leaveDay' => $leaveDay, // Use the calculated value
            'leave_reason' => $request->leave_reason,
            'status' => $request->status,
        ];
    
        leaves::insert($data);
    
        return redirect()->route('full_leave_list')->with('message', 'Added successfully!');
    }
    


    public function edit_full_leave(Request $request, $id)
    {
        $leave_info = leaves::findOrFail($id);
        $leave_infos = DB::table('employees')->get();
        $leave_type = leavetypes::get();
        return view('leavetypes.fullleaves.edit_full_leave', compact('leave_info','leave_type','leave_infos'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $leave = leaves::findOrFail($id);
        // print_r($leave);
        // exit;

        $leave->employeeId = $request->employeeId;
        $leave->leave_type = $request->leave_type;
        $leave->startDateLeave = $request->startDateLeave;
        $leave->endDateLeave = $request->endDateLeave;
        $leave->leaveDay = $request->leaveDay;
        $leave->leave_reason = $request->leave_reason;
    //    echo '<pre>';
    //    print_r($leave);
    //    exit;outtimeRange

        $leave->save();
        return redirect()->route('full_leave_list')->with('message','Updated successfully!');
    }


    public function view_full_leave(Request $request, $id)
    {
        $leave_info = leaves::findOrFail($id);
        $leave_infos = DB::table('employees')->get();
        $leave_type = leavetypes::get();
        return view('leavetypes.fullleaves.view_full_leave', compact('leave_info','leave_type','leave_infos'));
    }


    public function destroy($id)
    {
        leaves::destroy($id);
        return redirect()->route('full_leave_list')->with('message','Deleted successfully!');
    }


    function total_leave_working_days() {
        
        if (isset($_POST['startDateLeave']) and isset($_POST['endDateLeave'])) {
            $from = $_POST['startDateLeave'];
            $to = $_POST['endDateLeave'];
        }
        
       // $year_first_date=date('Y')."-01-01";
       // $year_last_date=date('Y')."-12-31";
        
        $year=date('Y', strtotime($from));
        $year_first_date=$year."-01-01";
        $year_last_date=$year."-12-31";
        
        $emId = $_POST['emId'];
       
        $total_day = $this->dateDiffCount($from, $to);
        $f_date = date('Y-m-d', strtotime($from));
        $t_date = date('Y-m-d', strtotime($to));
        $start_time = strtotime($f_date);
        $end_time = strtotime($t_date);
        // $holiday_chek=$this->holidayCheck($f_date,$t_date,$emId);
         $total_weekend = $this->weekendCount($start_time, $end_time,$emId);
        // $total_holiday = $this->holidayCount($f_date,$t_date,$emId);
        //$total_holiday = $this->holidayCount($f_date, $t_date, $emId);

        

        
        
      
         $leave_type = $_POST['leave_type'];
         $leave_type_info = leavetypes::findOrFail($leave_type);
         
        // $type = $this->m_common->get_row_array('leaveType', array('id' => $leave_type), '*');
     
        // $sql="select sum(leaveDay) as leaveDay from leaves where leave_type='$leave_type' and employeeId=".$emId." and status!='Rejected' and (startDateLeave>='$year_first_date' and endDateLeave<='$year_last_date' )";
        // $leave_availed = $leave = $this->m_common->customeQuery($sql);

        $leave_availed = leaves::where('leave_type', $leave_type)
                            ->where('employeeId', $emId)
                            ->where('status', 'Approved')
                            ->select(DB::raw('sum(leaveDay) AS total_leave_days'))
                            ->get();

      // $leave_availed->whereBetween('orders.date', [strtotime($start_date), strtotime($end_date)]);
        

        $balance=$leave_type_info->allowedLeave-$leave_availed[0]->total_leave_days;

        $net_total_days=$total_day-$total_weekend;

        $msg = array();


        if($net_total_days<=$balance){
            $msg['msg'] = 'success';
        }else{
            $msg['msg'] = 'failure';
        }
        
        $msg['leaveDay'] =$net_total_days;
        echo json_encode($msg);
    }


    function dateDiffCount($from, $to) {
        $date1 = date_create($to);
        $date2 = date_create($from);
        $diff = date_diff($date1, $date2);
        return abs($diff->format("%R%a")) + 1;
    }


    function weekendCount($start_time, $end_time, $emId=false) {
        //$employee_info = $this->m_common->get_row_array('v_employee', array('id' => $emId), '*');
        $weekend ="Friday";
        $iter = 24 * 60 * 60; // whole day in seconds
        $count = 0; // keep a count of Sats & Suns

        for ($i = $start_time; $i <= $end_time; $i = $i + $iter) {
            if (date("l", $i) == $weekend) {
                $count++;
            }
        }
        return $count;
    }


    function holidayCount($from, $to, $emId) {
        $company_info = $this->m_common->get_row_array('v_employee', array('id' => $emId), '*');
        $company_id = $company_info[0]['company'];
        $sql = "SELECT count(*) as total from holiday where company in (" . $company_id . ") and the_date between '$from' and '$to' and category='Govt Holiday' ";
        $govt_holiday = $this->m_common->customeQuery($sql);
        $sql_others = "SELECT count(*) as total from holiday where company in (" . $company_id . ") and the_date between '$from' and '$to' and category='Others' ";
        $others_holiday = $this->m_common->customeQuery($sql_others);
        return $govt_holiday[0]['total'] + $others_holiday[0]['total'];
    }

}
