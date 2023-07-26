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
        $this->setOutputMode(NORMAL);
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
        //echo dateDiffCount($from,$to)-(countWeekendDays(strtotime($from),strtotime($to),$weekend)+holidayCount($from,$to,$weekend));
        //echo $this->dateDiffCount($from, $to);
        $total_day = $this->dateDiffCount($from, $to);
        $f_date = date('Y-m-d', strtotime($from));
        $t_date = date('Y-m-d', strtotime($to));
        $start_time = strtotime($f_date);
        $end_time = strtotime($t_date);
        $holiday_chek=$this->holidayCheck($f_date,$t_date,$emId);
        $total_weekend = $this->weekendCount($start_time, $end_time, $emId);
        $total_holiday = $this->holidayCount($f_date,$t_date,$emId);
        
//        if($holiday_chek>=2){
//            $net_leave_day = ($total_day+1) - ($total_weekend + $total_holiday);
//        }else{
//            $net_leave_day = $total_day - ($total_weekend + $total_holiday);
//        }
        
//         if($holiday_chek>=2){
//            $net_leave_day = ($total_day+1) - ($total_weekend + $total_holiday);
//        }else if(!empty($total_weekend)){
//            $net_leave_day = $total_day;
//        }else if(!empty($total_holiday)){
//            $net_leave_day = $total_day;
//        }
        
        
        if($holiday_chek>=2){
            $net_leave_day = ($total_day+1) - ($total_weekend + $total_holiday);
        }else if(!empty($total_weekend)){
            $net_leave_day = $total_day;
        }else if(!empty($total_holiday)){
            $net_leave_day = $total_day;
        }else{
            $net_leave_day = $total_day;
        }
        
    //    $year = date('Y');
        
        
        $leave_type = $this->input->post('leave_type');
        $type = $this->m_common->get_row_array('leaveType', array('id' => $leave_type), '*');
     //   $leave_availed = $leave = $this->m_common->get_row_array('leaves', array('leave_type' => $leave_type, 'employeeId' => $emId, 'status' => "Approved", 'year' => $year), 'sum(leaveDay) as leaveDay');
        $sql="select sum(leaveDay) as leaveDay from leaves where leave_type='$leave_type' and employeeId=".$emId." and status!='Rejected' and (startDateLeave>='$year_first_date' and endDateLeave<='$year_last_date' )";
        $leave_availed = $leave = $this->m_common->customeQuery($sql);
        if($type[0]['short_name']=="CL"){
            $casual_leave_deduction=$this->m_common->get_row_array('absent_reduce',array('employeeId'=>$emId,'year'=>$year),'sum(cl_deduction) as cl_deduction');
            if(!empty($casual_leave_deduction)){
                $due_leave = $type[0]['allowedLeave'] - ($leave_availed[0]['leaveDay']+$casual_leave_deduction[0]['cl_deduction']);
            }else{
                $due_leave = $type[0]['allowedLeave'] - $leave_availed[0]['leaveDay'];
            }
        }else if($type[0]['short_name']=="ML"){
            $medical_leave_deduction=$this->m_common->get_row_array('absent_reduce',array('employeeId'=>$emId,'year'=>$year),'sum(ml_deduction) as ml_deduction');
            if(!empty($medical_leave_deduction)){
                $due_leave = $type[0]['allowedLeave'] - ($leave_availed[0]['leaveDay']+$medical_leave_deduction[0]['ml_deduction']);
            }else{
                $due_leave = $type[0]['allowedLeave'] - $leave_availed[0]['leaveDay'];
            }
        }else{
            $due_leave = $type[0]['allowedLeave'] - $leave_availed[0]['leaveDay'];
        }
        $msg = array();
        if($type[0]['short_name']=="CPL"){
            $msg['msg'] = 'success';
        }else{
           if($due_leave >= $net_leave_day){
                $msg['msg'] = 'success';
           }else{
                $msg['msg'] = 'failed';
           } 
        }
        $msg['leaveDay'] = $net_leave_day;
        echo json_encode($msg);
    }


}
