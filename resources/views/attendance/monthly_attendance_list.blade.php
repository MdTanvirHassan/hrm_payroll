@extends('layouts.app')  

@section('content_header')
   <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 ">Monthly Attendance List</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active"> Monthly Attendance List</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection  
  
@section('main_content')

  
  <h6 class="text-center text-success ">{{session('message')}}</h6>
  <br />
   <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Monthly Attendance List</h3>
          </div>
          <div class="card-body">
          <form method="post" action="{{ route('monthly_attendance') }}" onsubmit="return validateForm()">
          @csrf
        <div class="d-flex">

          <div class="form-group col-3">
            <label for="employeeId" class="form-label">Employee</label>
            <select class="form-select form-control" id="emId" name="emId" >
                <option value="">Select Employee</option>
                @foreach ($employee_info as $employee)
                    <option value="{{ $employee->id }}"  {{ $employee->id == $employeeId ? 'selected' : '' }}>{{ $employee->name }}({{$employee->id}})</option>
                @endforeach
            </select>
            <!-- <p id="employeeIdError" class="text-danger"></p> -->
        </div>

        <div class="form-group col-3">
            <label for="designation" class="form-label">Designation</label>
            <select class="form-select form-control" id="designation" name="designation" >
                <option value="">Select Designation</option>
                @foreach ($designation_info as $designation)
                    <option value="{{ $designation->id }}" {{ $designation->id == $designationId ? 'selected' : '' }}>{{ $designation->desig_name }}</option>
                @endforeach
            </select>
            
        </div>

        <div class="form-group col-2">
            <label for="department" class="form-label">Department</label>
            <select class="form-select form-control" id="department" name="department">
                <option value="">Select Department</option>
                @foreach ($department_info as $department)
                    <option value="{{ $department->id }}" {{ $department->id == $departmentId ? 'selected' : '' }}>{{ $department->dept_short_name }}</option>
                @endforeach
            </select>
            <p id="employeeIdError" class="text-danger"></p>
        </div>

            <div class="form-group col-2">
                    <label for="startDateLeave">Start Date</label>
                    <input type="date" class="form-control" id="startDateLeave" name="startDateLeave" placeholder="Enter startDateLeave" value="{{ $month }}" >
                   
                </div>
                <div class="form-group col-2">
                    <label for="endDateLeave">end Date</label>
                    <input type="date" class="form-control" id="endDateLeave" name="endDateLeave" placeholder="Enter endDateLeave" value="{{ $year }}">
                    <!-- <p id="grossError" class="text-danger"></p> -->
                </div>
          </div>

          <div class="d-flex justify-content-center text-center">    
                <div class="form-group col-4">
                  <button type="submit" class='btn btn-success'  id="searchButton" >Search</button> 
                  <button type="button" class='btn btn-warning text-white' onclick="printContent()">Print</button>  
                </div>    

        </div>
</form>

        </div>
          <!-- /.card-header -->
          <div class="card-body print-content">
          <h6 class="fw-bold my-3">Monthly Attendance List</h6>
          
          

        <table class="table table-bordered table-hover table-responsive">
                        <thead>
                           <tr class="text-center">
                           <th rowspan="2">Name</th>
                            <th rowspan="2">Designation</th>
                            <th rowspan="2">Time</th>
                            @for ($day = 1; $day <= $days_in_month; $day++)
                                <th rowspan="1" class='{{ $day == "4" ? "bg-secondary ":""}}'>{{ $day }}</th>
                            @endfor
                            <th rowspan="1">Total</th>
                           </tr>
                           <tr>
                           @for ($day = 1; $day <= $days_in_month; $day++)
                              <th  class='{{ $day == "4" ? "bg-secondary ":""}}'>{{ \Carbon\Carbon::createFromDate($year, $month, $day)->shortDayName }}</th>
                          @endfor
                          <th>Total</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($attendance_info as $attendance)
                              <tr>
                                 <td rowspan="3">{{ $attendance->em_name }} ({{ $attendance->em_id }})</td>
                                 <td rowspan="3">{{ $attendance->desig_name }}</td>
                                 <td>Status</td>
                                 <td class="{{ $attendance->status === 'Present' ? 'bg-green' : ($attendance->status === 'Late' ? 'bg-warning' : ($attendance->status === 'Absent' ? 'bg-danger' : '')) }}">{{ $attendance->status }}</td>

                                    {{ $attendance->status }}
                                 </td>
                                 <!-- Add table cells for each day's attendance -->
                                 @for ($day = 1; $day <= $days_in_month; $day++)
                                    <td>
                                       {{ $attendance->status }}
                                    </td>
                                 @endfor
                              </tr>
                              <tr>
                                 <td>IN</td>
                                 <td class="{{ strtotime($attendance->timeIn) <= strtotime('10:30:30') ? 'bg-green' : 'bg-danger' }}">{{ date('h:i A', strtotime($attendance->timeIn)) }}</td>

                                 <!-- Add table cells for each day's attendance -->
                                 @for ($day = 1; $day <= $days_in_month; $day++)
                                    <td>
                                       <!-- You can populate the attendance data here -->
                                    </td>
                                 @endfor
                              </tr>
                              <tr>
                                 <td>OUT</td>
                                 <td class="{{ strtotime($attendance->timeOut) >= strtotime('06:30:00') && strtotime($attendance->timeOut) <= strtotime('07:45:00') ? 'bg-green' : ( strtotime($attendance->timeOut) >= strtotime('7:46:00') ? 'bg-info' : 'bg-warning' ) }}">
                                    {{ date('h:i A', strtotime($attendance->timeOut)) }}
                                 </td>
                                 <!-- Add table cells for each day's attendance -->
                                 @for ($day = 1; $day <= $days_in_month; $day++)
                                    <td>
                                       <!-- You can populate the attendance data here -->
                                    </td>
                                 @endfor
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

       
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->

  

<script>
function printContent() {
var printContent = document.querySelector('.print-content').innerHTML;
var originalContent = document.body.innerHTML;

// Replace the entire body content with the print content
document.body.innerHTML = printContent;

// Print the modified body content
window.print();

// Restore the original body content
document.body.innerHTML = originalContent;
}

// Call the printContent function when a button or link is clicked
var printButton = document.querySelector('#printButton');
printButton.addEventListener('click', printContent);
</script>



@endsection   