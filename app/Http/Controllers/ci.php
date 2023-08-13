function monthlyAttendance($isPdf = false, $date_info = false) {
        //$this->page_name = 'attendanceReport';
        $this->page_name = 'Attendance Report';
        $this->menu_name = 'report';
        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->title("Monthly Attendance");
        if (isset($_POST['date']) && !empty($_POST['date'])) {
            $date = date('Y-m', strtotime($_POST['date']));
        } elseif (!empty($date_info) && $date_info != date('Y-m')) {
            $date = date('Y-m', strtotime($date_info));
        } else {
            $date = date('Y-m');
        }
        
        
        if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
            $data['from_date']=$from_date= date('Y-m-d', strtotime($_POST['from_date']));
            $data['to_date']=$to_date=date('Y-m-d', strtotime($_POST['to_date']));
        }else{
            $data['from_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $to_date = date('Y-m-t');
        }
        
        
        // $companyId = $this->session->userdata('companyId');
        if (isset($companyId)) {
          //  $data['company'] = $this->m_common->get_row_array('companies', array('id' => $companyId), '*');
            $data['company'] = $this->m_common->get_row_array('companies', '', '*');
            
        } else {
            $data['company'] = $this->m_common->get_row_array('companies', '', '*');
        }
        
        
        
        // $data['department'] = $this->m_common->get_row_array('department', '', '*');
        // $data['section'] = $this->m_common->get_row_array('section', '', '*');
        // $data['designation'] = $this->m_common->get_row_array('designation', '', '*');
        


        $data['shift'] = $this->m_common->get_row_array('shift', '', '*');
        $data['designation'] = getDesignation($companyId);
        $data['department'] = getDepartment($companyId);
        $data['section'] = getSection($companyId);
        
        
        $data['date'] = $date;
        $postData = $this->input->post();
        if (!empty($postData['fieldIndex'])) {
            $col_index = $postData['fieldIndex'];
            $data['fieldindex'] = $col_index;
        }
        $where = array();
        if (!empty($postData['company'])) {
            $companyId= $postData['company'];
        }
        
        $data['company_info']=$this->m_common->get_row_array('companies',array('id'=>$companyId), '*');
        $company_name=$data['company_info'][0]['name'];        
         
        if (isset($companyId)) {
            if ($user_type==1 || $user_type==3) {
                 $data['employees'] = $this->m_common->get_row_array('employee', array('company' => $companyId,'status'=>"Active"), '*'); //added by alauddin
              
                 
            } else {
               $data['employees'] = $this->m_common->get_row_array('employee', array('company' => $companyId, 'id' => $employee_id,'status'=>"Active"), '*'); //added by alauddin
                 
            }
        } else {
           // $data['employees'] = $this->m_common->get_row_array('employee', '', '*');
             $data['employees'] = $this->m_common->get_row_array('employee',array('status'=>"Active"), '*');
        }
        
        
        
        
        
        
        
       // $where1=array();
        $where1='';
        
        if (isset($companyId)) {
            $where['company'] = $companyId;
            $where1 .= 'company='.$companyId;
        }
        
        if(!empty($postData['department'])){
            $where['departmentId'] = $postData['department'];
            $k=0;
            foreach($postData['department'] as $value){
                $k++;
                if($k==1){
                    if($k==count($postData['department'])){
                        $where1 .= ' AND (departmentId=' . "'" . $value . "')";
                    }else{
                        $where1 .= ' AND (departmentId=' . "'" . $value . "'";
                    }
                }else{
                    if($k==count($postData['department'])){
                        $where1 .= ' OR departmentId=' . "'" . $value . "')";
                    }else{
                        $where1 .= ' OR departmentId=' . "'" . $value . "'";
                    }
                }
            }
        }
        if (!empty($postData['designation'])) {
            $where['designationId'] = $postData['designation'];
            $l=0;
            foreach($postData['designation'] as $value1){
                $l++;
                if($l==1){
                    if($l==count($postData['designation'])){
                        $where1 .= ' AND (designationId=' . "'" . $value1 . "')";
                    }else{
                        $where1 .= ' AND (designationId=' . "'" . $value1 . "'";
                    }
                }else{
                    if($l==count($postData['designation'])){
                        $where1 .= ' OR designationId=' . "'" . $value1 . "')";
                    }else{
                        $where1 .= ' OR designationId=' . "'" . $value1 . "'";
                    }
                }
            }
        }
        if (!empty($postData['section'])) {
            $where['sectionId'] = $postData['section'];
            $m=0;
            foreach($postData['section'] as $value1){
                $m++;
                if($m==1){
                    if($m==count($postData['section'])){
                        $where1 .= ' AND (sectionId=' . "'" . $value1 . "')";
                    }else{
                        $where1 .= ' AND (sectionId=' . "'" . $value1 . "'";
                    }
                }else{
                    if($m==count($postData['section'])){
                        $where1 .= ' OR sectionId=' . "'" . $value1 . "')";
                    }else{
                        $where1 .= ' OR sectionId=' . "'" . $value1 . "'";
                    }
                }
            }
           // $where1 .= ' AND sectionId='.$postData['section'];
        }


        if (!empty($postData['shift'])) {
            $where['shiftId'] = $postData['shift'];

            $m=0;
            foreach($postData['shift'] as $value1){
                $m++;
                if($m==1){
                    if($m==count($postData['shift'])){
                        $where1 .= ' AND (shiftId=' . "'" . $value1 . "')";
                    }else{
                        $where1 .= ' AND (shiftId=' . "'" . $value1 . "'";
                    }
                }else{
                    if($m==count($postData['shift'])){
                        $where1 .= ' OR shiftId=' . "'" . $value1 . "')";
                    }else{
                        $where1 .= ' OR shiftId=' . "'" . $value1 . "'";
                    }
                }
            }

           // $where1 .= ' AND shiftId='.$postData['shift'];
        }

        
        if (!empty($postData['employeeId'])) {
            $where['id'] = $postData['employeeId'];
            $where1 .= ' AND id='.$postData['employeeId'];
        }else{
            if($user_type==2){
               $where['id'] = $employee_id; 
               $where1 .= ' AND id='.$employee_id;
            }
        }
        $where['status'] ="Active";
        $where1 .= " AND status='Active' ";
        //$employees = $this->m_common->get_row_array('v_employee', $where, '*');
        $employees = $this->m_common->get_row_array('v_employee', $where1, '*','','','d_rank','ASC');

      
       
        $data['searched'] = $where;
       
        
        // $employees = $this->m_common->get_row_array('v_employee', '', '*');
        $first_date = date('01', strtotime($date));
        $last_date = date('t', strtotime($date));
        $result = array();

        $data['totalDay'] = $last_date;
        $data['data'] = $result;
        if (!empty($col_index)) {
            $data['fieldindex'] = $col_index;
        } else {
            $data['fieldindex'] = "1,2,3";
        }

        if($isPdf =='print'){
            $print_calendar = $this->print_draw_calendar($company_name,$employees, date('m', strtotime($date)), date('Y', strtotime($date)),$date);
            $data['print_html'] = $print_calendar;
            $html = $this->load->view('report/monthlyattendancePdf', $data, true);
         //   $html = $this->load->view('report/monthlyattendancePrint', $data, true);
        }else if ($isPdf == "pdf") {
            $print_calendar = $this->print_draw_calendar($company_name,$employees, date('m', strtotime($date)), date('Y', strtotime($date)),$date);
            $data['print_html'] = $print_calendar;
            $html = $this->load->view('report/monthlyattendancePdf', $data, true);
        }else{
           // $calendar = $this->draw_calendar($employees, date('m', strtotime($date)), date('Y', strtotime($date))); //06-11-2022
            $calendar = $this->draw_calendar($employees, date('m', strtotime($date)), date('Y', strtotime($date)),$date);
            $data['html'] = $calendar;
            $this->load->view('report/attendance/monthlyAttendance', $data);
        }
        
        
//        if ($isPdf == true) {
//            echo $html;
//            exit;
//            $this->load->library("mpdf_lib5");
//            $this->mpdf_lib5->WriteHTML($html);
//            $this->mpdf_lib5->Output();
//        }
        
        if ($isPdf == "print") {
            echo $html;
            exit;
            
        }else if ($isPdf == "pdf") {
            $this->load->library("mpdf_lib5");
            $this->mpdf_lib5->AddPage('L', // L - landscape, P - portrait
                        '', '', '', '', 10, // margin_left
                        10, // margin right
                        22, // margin top
                        15, // margin bottom
                        5, // margin header
                        5); // margin footer
            $this->mpdf_lib5->WriteHTML($html);
            $this->mpdf_lib5->Output();
        }
    }
    
     function draw_calendar($employees, $month, $year,$year_month=false) {
        /* days and weeks vars now ... */
        $running_day = date('w', mktime(0, 0, 0, $month, 2, $year));
        $days_in_month = date('t', mktime(0, 0, 0, $month, 2, $year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();
        /* draw table */
        $calendar = '<h5 style="text-align:center;">' . strtoupper(date('F',strtotime('01-'.$month.'-'.$year))) . ' -  ' . date('Y',strtotime('01-'.$month.'-'.$year)) . '</h5><table id="player_table" cellpadding="0" cellspacing="0" class="calendar">';

        /* table headings */
        $str = '<td rowspan="2" class="calendar-day-head">Name</td>';
        $str .= '<td rowspan="2" class="calendar-day-head">Designation</td>';
        $str .= '<td rowspan="2" class="calendar-day-head">Time</td>';
        for ($x = 0; $x < $days_in_month; $x++) {
            $str .= '<td class="calendar-day-head">' . ($x + 1) . ' </td>';
        }

        $calendar.= '<tr class="calendar-row">' . $str . '</tr>';
        $str = '';
        for ($x = 0; $x < $days_in_month; $x++) {
            $day = date("l", strtotime($year . '-' . $month . '-' . ($x + 1)));
            $str .= '<td class="calendar-day-head">' . substr($day, 0, 3) . ' </td>';
        }

        $calendar.= '<tr class="calendar-row">' . $str . '</tr>';
        foreach ($employees as $employee) {

            $em_joinmonth=date('Y-m',strtotime($employee['joinDate']));
            if($em_joinmonth>$year_month){
                continue;
            }

            if(!empty($employee['activationDate'])){
                $em_activemonth=date('Y-m',strtotime($employee['activationDate']));
                if($em_activemonth>$year_month){
                    continue;
                }
            }    



            $intime = '';
            $outtime = '';
            $emId = $employee['id'];
            $em_lday = $this->m_common->get_row_array('v_employee', array('id' => $emId), '*');
            $em_lday1 = $this->m_common->get_row_array('v_employee', array('id' => $emId), '*');
            $comId = $this->session->userdata('companyId');
            if (empty($em_lday)) {
                return false;
            }
            /* row for week one */
            $calendar .= '<tr class="calendar-row">';
            $intime .= '<tr class="calendar-row">';
            $outtime .= '<tr class="calendar-row">';
            $calendar .= '<td rowspan="3" style="width:10%" class="calendar-day-head">' . $employee['name'] . ' ('.$employee['employeeId'].')</td>';
            $calendar .= '<td rowspan="3" style="width:5%" class="calendar-day-head">' . $employee['designation'] . '</td>';
            $calendar .= '<td class="calendar-day-head">Status</td>';
            $intime = '<td class="calendar-day-head">In</td>';
            $outtime = '<td class="calendar-day-head">Out</td>';


            /* keep going with days.... */
            for ($list_day = 1; $list_day <= $days_in_month; $list_day++) {
                $calendar.= '<td class="calendar-day">';
                $intime.= '<td class="calendar-day">';
                $outtime.= '<td class="calendar-day">';
                
                
                
               
                if (time() >= strtotime($year . '-' . $month . '-' . $list_day)) {
                    
                 // $schedule_info = $this->m_common->get_row_array('time_schedule', array('date' => date('Y-m-d', strtotime($year . '-' . $month . '-' . $list_day))), '*'); //14-11-2022
                 $schedule_info = $this->m_common->get_row_array('time_schedule', array('date' => date('Y-m-d', strtotime($year . '-' . $month . '-' . $list_day)),'shift_id'=>$em_lday1[0]['shiftId']), '*');
                  if(isset($schedule_info[0]['startTime']) && !empty($schedule_info[0]['startTime'])){
                    $schedule_info[0]['weekEnd']=$em_lday1[0]['weekEnd'];   
                    $em_lday=$schedule_info; 
                    
                  }else{
                      $em_lday=$em_lday1;
                  }  
                    

                   
                    /* add in the day number */
                        $str = '';
                        $currentDate = date('Y-m-d', strtotime($year . '-' . $month . '-' . $list_day));

                        $res = $this->m_common->get_row_array('attendance', array('employeeId' => $emId, 'date' => date('Y-m-d', strtotime($year . '-' . $month . '-' . $list_day))), '*');
                        if(!empty($res)){
                           
                                $leave=array();
                                $lesql = "SELECT leaveDay as leaves,leaveType from v_leave where startDateLeave<='$currentDate' and endDateLeave>='$currentDate' and emId in (" . $emId . ")  and status='Approved'";
                                $leave = $this->m_common->customeQuery($lesql);
                                $holiday=array();
                                $hlql = "SELECT *  from holiday where startDate>='$currentDate' and endDate<='$currentDate' and company in (" . $comId . ")";
                                $holiday = $this->m_common->customeQuery($hlql);
                                    
                            
                                   $day = date("l", strtotime($year . '-' . $month . '-' . $list_day));
                            
                                   if ($res[0]['status'] == 'Absent'){
                                        $calendar.= '<div class="absent">A</div>';
                                        $intime.= '<div class="absent"></div>';
                                        $outtime.= '<div class="absent"></div>';
                                   } else if ($res[0]['status'] == 'Late') {
									   
                                            if ($day==$em_lday[0]['weekEnd']){ 
                                                         $calendar.= '<div class="weekend">W</div>';
                                                         $intime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';

                                                          $out_time =strtotime($res[0]['timeOut']);
                                                          $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);

                                                         if (!empty($res[0]['timeOut'])) {
                                                                 if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                                         if ($out_time < $end_time) {
                                                                                 $outtime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                         } else {
                                                                                 $outtime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                         }
                                                                 }else{
                                                                         $outtime.= '<div class="weekend">' . '  ' . '</div>'; 
                                                                 }     
                                                         } else {
                                                                 $outtime.= '<div class="weekend">' . '  ' . '</div>';
                                                         }  
                                            }else if(!empty($holiday)){ 
                                                $calendar.= '<div class="holiday">H</div>';
                                                $intime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';

                                                $out_time =strtotime($res[0]['timeOut']);
                                                $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);

                                                if (!empty($res[0]['timeOut'])) {
                                                        if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                                if ($out_time < $end_time) {
                                                                        $outtime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                } else {
                                                                        $outtime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                }
                                                        }else{
                                                                $outtime.= '<div class="holiday">' . '  ' . '</div>'; 
                                                        }     
                                                } else {
                                                        $outtime.= '<div class="holiday">' . '  ' . '</div>';
                                                }   
                                            }else{


                                                $in_time_check = strtotime($res[0]['timeIn']);
                                                $in_time_range = strtotime($res[0]['date']." ". $em_lday[0]['intimeRange']);
                                                if($in_time_check<=$in_time_range){
                                                   if(!empty($leave)){ 
                                                     $leave_types=array();
                                                     $leave_types=$this->m_common->get_row_array('leaveType','','*');
                                                     foreach($leave_types as $leave_type){
                                                            if($leave[0]['leaveType']==$leave_type['name']){
                                                                   $calendar.= '<div class="leave">'.$leave_type['short_name'].'</div>';

                                                            }
                                                     }  


                                                     //$calendar.= '<div class="late">LT</div>';
                                                   }else if(!empty($holiday)){ 
                                                     $calendar.= '<div class="holiday">H</div>';  
                                                   }else{
                                                     $calendar.= '<div class="late">LT</div>';  
                                                   }
                                                }else{
                                                   if(!empty($leave)){  
                                                     $leave_types=array();
                                                     $leave_types=$this->m_common->get_row_array('leaveType','','*');
                                                     foreach($leave_types as $leave_type){
                                                            if($leave[0]['leaveType']==$leave_type['name']){
                                                                   $calendar.= '<div class="leave">'.$leave_type['short_name'].'</div>';

                                                            }
                                                     }  
                                                   }else if(!empty($holiday)){ 
                                                     $calendar.= '<div class="absent">LT</div>';   
                                                   }else{
                                                      $calendar.= '<div class="absent">LT</div>';  
                                                   }
                                                }
                                                         $intime.= '<div class="late">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';

                                                          $out_time =strtotime($res[0]['timeOut']);
                                                          $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);

                                                         if (!empty($res[0]['timeOut'])) {
                                                                 if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                                         if ($out_time < $end_time) {
                                                                                 $outtime.= '<div class="late">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                         } else {
                                                                                 $outtime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                         }
                                                                 }else{
                                                                         $outtime.= '<div class="absent">' . '  ' . '</div>'; 
                                                                 }     
                                                         } else {
                                                                 $outtime.= '<div class="absent">' . '  ' . '</div>';
                                                         } 
                                            }
                                   }else if($res[0]['status'] == 'Present') {
                                      if($day==$em_lday[0]['weekEnd']){ 
                                            $in_time=strtotime($res[0]['timeIn']);
                                            $start_time=strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['startTime']);
                                            $out_time =strtotime($res[0]['timeOut']);
                                            $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);
                                            $calendar.= '<div class="weekend">W</div>';
                                            if (!empty($res[0]['timeIn'])) {
                                                    if($in_time <= $start_time){
                                                            $intime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                                    }else{
                                                            $intime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                                    }
                                            } else {
                                                    $intime.= '<div class="weekend">' . ' ' . '</div>';
                                            }
                                            if (!empty($res[0]['timeOut'])) {
                                                    if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                            if ($out_time < $end_time) {
                                                                    $outtime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                            } else {
                                                                    $outtime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                            }
                                                    }else{
                                                            $outtime.= '<div class="weekend">' . '  ' . '</div>'; 
                                                    }     
                                            } else {
                                                    $outtime.= '<div class="weekend">' . '  ' . '</div>';
                                            }
                                        }else if(!empty($holiday)){ 
                                                $calendar.= '<div class="holiday">H</div>';
                                                $intime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';

                                                $out_time =strtotime($res[0]['timeOut']);
                                                $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);

                                                if (!empty($res[0]['timeOut'])) {
                                                        if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                                if ($out_time < $end_time) {
                                                                        $outtime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                } else {
                                                                        $outtime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                }
                                                        }else{
                                                                $outtime.= '<div class="holiday">' . '  ' . '</div>'; 
                                                        }     
                                                } else {
                                                        $outtime.= '<div class="holiday">' . '  ' . '</div>';
                                                }   
                                        }else{
                                            $in_time=strtotime($res[0]['timeIn']);
                                            $start_time=strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['startTime']);
                                            $out_time =strtotime($res[0]['timeOut']);
                                            $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);
                                            $calendar.= '<div class="present">P</div>';
                                            if (!empty($res[0]['timeIn'])) {
                                                    if($in_time <= $start_time){
                                                            $intime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                                    }else{
                                                            $intime.= '<div class="late">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                                    }
                                            } else {
                                                    $intime.= '<div class="absent">' . ' ' . '</div>';
                                            }
                                            if (!empty($res[0]['timeOut'])) {
                                                    if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                            if ($out_time < $end_time) {
                                                                    $outtime.= '<div class="late">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                            } else {
                                                                    $outtime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                            }
                                                    }else{
                                                            $outtime.= '<div class="absent">' . '  ' . '</div>'; 
                                                    }     
                                            } else {
                                                    $outtime.= '<div class="absent">' . '  ' . '</div>';
                                            }
                                        }		
									  	
                                        //$outtime.= '<div class="present">' . date('h:i', strtotime($res[0]['timeOut'])) . '</div>';
                                   }else if ($res[0]['status'] == 'SL') {
                                        //$out_time = date('h:ia', strtotime($res[0]['timeOut']));
                                        //$end_time = date('h:ia', strtotime($em_lday[0]['endTime']));
                                        $in_time=strtotime($res[0]['timeIn']);
                                        $start_time=strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['startTime']);
                                        $out_time =strtotime($res[0]['timeOut']);
                                        $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);
                                        $calendar.= '<div class="leave">SL</div>';
                                        if (!empty($res[0]['timeIn'])) {
                                            if($in_time <= $start_time){
                                                $intime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                            }else{
                                                $intime.= '<div class="leave">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                            }
                                        } else {
                                            $intime.= '<div class="absent">' . ' ' . '</div>';
                                        }
                                        if (!empty($res[0]['timeOut'])) {
                                            if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                if ($out_time < $end_time) {
                                                    $outtime.= '<div class="leave">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                } else {
                                                    $outtime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                }
                                            }else{
                                                $outtime.= '<div class="absent">' . '  ' . '</div>'; 
                                            }     
                                        } else {
                                            $outtime.= '<div class="absent">' . '  ' . '</div>';
                                        }
                                   }else if ($res[0]['status'] == 'HDL') {
                                        //$out_time = date('h:ia', strtotime($res[0]['timeOut']));
                                        //$end_time = date('h:ia', strtotime($em_lday[0]['endTime']));
                                        $in_time=strtotime($res[0]['timeIn']);
                                        $start_time=strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['startTime']);
                                        $out_time =strtotime($res[0]['timeOut']);
                                        $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);
                                        $calendar.= '<div class="leave">HDL</div>';
                                        if (!empty($res[0]['timeIn'])) {
                                            if($in_time <= $start_time){
                                                $intime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                            }else{
                                                $intime.= '<div class="leave">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                            }
                                        } else {
                                            $intime.= '<div class="absent">' . ' ' . '</div>';
                                        }
                                        if (!empty($res[0]['timeOut'])) {
                                            if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                if ($out_time < $end_time) {
                                                    $outtime.= '<div class="leave">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                } else {
                                                    $outtime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                }
                                            }else{
                                                $outtime.= '<div class="absent">' . '  ' . '</div>'; 
                                            }     
                                        } else {
                                            $outtime.= '<div class="absent">' . '  ' . '</div>';
                                        }
                                   }else if ($res[0]['status'] == 'Early') {
                                        if($day==$em_lday[0]['weekEnd']){
                                            $in_time=strtotime($res[0]['timeIn']);
                                            $start_time=strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['startTime']);
                                            $out_time =strtotime($res[0]['timeOut']);
                                            $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);
                                            $calendar.= '<div class="weekend">W</div>';
                                            if (!empty($res[0]['timeIn'])) {
                                                    if($in_time <= $start_time){
                                                            $intime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                                    }else{
                                                            $intime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                                    }
                                            } else {
                                                    $intime.= '<div class="weekend">' . ' ' . '</div>';
                                            }
                                            if (!empty($res[0]['timeOut'])) {
                                                    if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                            if ($out_time < $end_time) {
                                                                    $outtime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                            } else {
                                                                    $outtime.= '<div class="weekend">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                            }
                                                    }else{
                                                            $outtime.= '<div class="weekend">' . '  ' . '</div>'; 
                                                    }     
                                            } else {
                                                    $outtime.= '<div class="weekend">' . '  ' . '</div>';
                                            } 
                                        }else if(!empty($holiday)){ 
                                                $calendar.= '<div class="holiday">H</div>';
                                                $intime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';

                                                $out_time =strtotime($res[0]['timeOut']);
                                                $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);

                                                if (!empty($res[0]['timeOut'])) {
                                                        if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                                if ($out_time < $end_time) {
                                                                        $outtime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                } else {
                                                                        $outtime.= '<div class="holiday">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                                }
                                                        }else{
                                                                $outtime.= '<div class="holiday">' . '  ' . '</div>'; 
                                                        }     
                                                } else {
                                                        $outtime.= '<div class="holiday">' . '  ' . '</div>';
                                                }   
                                        }else{
                                            
                                            $out_time_range = strtotime($res[0]['date']." ". $em_lday[0]['outtimeRange']);

                                            $in_time = strtotime($res[0]['timeIn']);
                                            $start_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['startTime']);
                                            $out_time = strtotime($res[0]['timeOut']);
                                            $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);
                                            if($out_time>=$out_time_range){
                                                if(!empty($leave)){ 
                                                $leave_types=array();
                                                $leave_types=$this->m_common->get_row_array('leaveType','','*');
                                                foreach($leave_types as $leave_type){
                                                       if($leave[0]['leaveType']==$leave_type['name']){
                                                              $calendar.= '<div class="leave">'.$leave_type['short_name'].'</div>';

                                                       }
                                                }  


                                                //$calendar.= '<div class="late">LT</div>';
                                              }else if(!empty($holiday)){ 
                                                $calendar.= '<div class="holiday">H</div>';  
                                              }else{
                                                $calendar.= '<div class="late">E</div>';  
                                              }
                                               // $calendar.= '<div class="late">E</div>';
                                            }else{

                                               if(!empty($leave)){ 
                                               $leave_types=array();
                                               $leave_types=$this->m_common->get_row_array('leaveType','','*');
                                                foreach($leave_types as $leave_type){
                                                       if($leave[0]['leaveType']==$leave_type['name']){
                                                              $calendar.= '<div class="leave">'.$leave_type['short_name'].'</div>';

                                                       }
                                                }  


                                                //$calendar.= '<div class="late">LT</div>';
                                              }else if(!empty($holiday)){ 
                                                $calendar.= '<div class="holiday">H</div>';  
                                              }else{
                                                $calendar.= '<div class="absent">E</div>';  
                                              } 


                                              //  $calendar.= '<div class="absent">E</div>';
                                            }
                                            if (!empty($res[0]['timeIn'])) {
                                                    if($in_time <= $start_time){
                                                            $intime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                                    }else{
                                                            $intime.= '<div class="late">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                                    }
                                            } else {
                                                    $intime.= '<div class="absent">' . ' ' . '</div>';
                                            }
                                            if (!empty($res[0]['timeOut'])) {
                                                    if($res[0]['timeOut']!=$res[0]['timeIn']){
                                                            if ($out_time < $end_time) {
                                                                    $outtime.= '<div class="late">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                            } else {
                                                                    $outtime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                                            }
                                                    }else{
                                                            $outtime.= '<div class="absent">' . '  ' . '</div>'; 
                                                    }     
                                            } else {
                                                    $outtime.= '<div class="absent">' . '  ' . '</div>';
                                            } 
                                      }	
										
										
                                   }else if($res[0]['status'] == 'Movement') {
                                        //$out_time = date('h:i ', strtotime($res[0]['timeOut']));
                                        //$end_time = date('h:i', strtotime($em_lday[0]['endTime']));
                                        $in_time=strtotime($res[0]['timeIn']);
                                        $start_time=strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['startTime']);
                                        $out_time =strtotime($res[0]['timeOut']);
                                        $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);
                                        $calendar.= '<div class="movement">M</div>';
                                        if (!empty($res[0]['timeIn'])) {
                                            //$intime.= '<div class="movement">' . date('h:i', strtotime($res[0]['timeIn'])) . '</div>';
                                            if($in_time <= $start_time){
                                                $intime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                            }else{
                                                $intime.= '<div class="movement">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                            }
                                        } else {
                                            $intime.= '<div class="movement">' . ' ' . '</div>';
                                        }
                                        if (!empty($res[0]['timeOut'])) {
                                            if ($out_time < $end_time) {
                                                $outtime.= '<div class="movement">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                            } else {
                                                $outtime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                            }
                                        } else {
                                            $outtime.= '<div class="movement">' . '  ' . '</div>';
                                        }
                                        //$outtime.= '<div class="present">' . date('h:i', strtotime($res[0]['timeOut'])) . '</div>';
                                   }else if($res[0]['status'] == 'WW') {
                                        //$out_time = date('h:i ', strtotime($res[0]['timeOut']));
                                        //$end_time = date('h:i', strtotime($em_lday[0]['endTime']));
                                        $in_time=strtotime($res[0]['timeIn']);
                                        $start_time=strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['startTime']);
                                        $out_time =strtotime($res[0]['timeOut']);
                                        $end_time = strtotime($year . '-' . $month . '-' . $list_day . ' ' . $em_lday[0]['endTime']);
                                        $calendar.= '<div class="present">WW</div>';
                                        if (!empty($res[0]['timeIn'])) {
                                            //$intime.= '<div class="movement">' . date('h:i', strtotime($res[0]['timeIn'])) . '</div>';
                                            if($in_time <= $start_time){
                                                $intime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                            }else{
                                                $intime.= '<div class="late">' . date('h:iA', strtotime($res[0]['timeIn'])) . '</div>';
                                            }
                                        } else {
                                            $intime.= '<div class="present">' . ' ' . '</div>';
                                        }
                                        if (!empty($res[0]['timeOut'])) {
                                            if ($out_time < $end_time) {
                                                $outtime.= '<div class="late">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                            } else {
                                                $outtime.= '<div class="present">' . date('h:iA', strtotime($res[0]['timeOut'])) . '</div>';
                                            }
                                        } else {
                                            $outtime.= '<div class="present">' . '  ' . '</div>';
                                        }
                                        //$outtime.= '<div class="present">' . date('h:i', strtotime($res[0]['timeOut'])) . '</div>';
                                   }
                                
                      
                        }else{
                                $lesql = "SELECT leaveDay as leaves,leaveType from v_leave where startDateLeave<='$currentDate' and endDateLeave>='$currentDate' and emId in (" . $emId . ")  and status='Approved'";
                                $leave = $this->m_common->customeQuery($lesql);
                                $hlql = "SELECT *  from holiday where startDate>='$currentDate' and endDate<='$currentDate' and company in (" . $comId . ")";
                                $holiday = $this->m_common->customeQuery($hlql);
                                $day = date("l", strtotime($year . '-' . $month . '-' . $list_day));
                                if ($day == $em_lday[0]['weekEnd']) {
                                    $calendar.= '<div class="weekend">W</div>';
                                    $intime.= '<div class="weekend"></div>';
                                    $outtime.= '<div class="weekend"></div>';
                                }else if(!empty($holiday)) {


                                        $calendar.= '<div class="holiday">H</div>';
                                        $intime.= '<div class="holiday"></div>';
                                        $outtime.= '<div class="holiday"></div>';


                                }else if(!empty($leave)){
                                     $leave_types=$this->m_common->get_row_array('leaveType','','*');
                                     foreach($leave_types as $leave_type){
                                            if($leave[0]['leaveType']==$leave_type['name']){
                                                   $calendar.= '<div class="leave">'.$leave_type['short_name'].'</div>';
                                                   $intime.= '<div class="leave"></div>';
                                                   $outtime.= '<div class="leave"></div>';
                                            }
                                        }
                               }else{
                                   $calendar.= '<div class="absent">A</div>';
                                   $intime.= '<div class="absent"></div>';
                                   $outtime.= '<div class="absent"></div>';
                               }     
                           }
                  }else{
                       $day = date("l", strtotime($year . '-' . $month . '-' . $list_day));
                        if ($day == $em_lday[0]['weekEnd']) {
                            $calendar.= '<div class="weekend">W</div>';
                            $intime.= '<div class="weekend"></div>';
                            $outtime.= '<div class="weekend"></div>';
                        }
                  }
             
                
                
                
                
                


                $calendar.= '</td>';
                $intime.= '</td>';
                $outtime.= '</td>';
            }


            /* final row */
            $calendar.= '</tr>';
            $intime.= '</tr>';
            $outtime.= '</tr>';
            $calendar .=$intime;
            $calendar .=$outtime;
        }
        /* end the table */
        $calendar.= '</table>';

        /* all done, return result */
        return $calendar;
    }