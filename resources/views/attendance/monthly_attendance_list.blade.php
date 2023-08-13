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

        <div class="form-group col-3">
            <label for="department" class="form-label">Department</label>
            <select class="form-select form-control" id="department" name="department">
                <option value="">Select Department</option>
                @foreach ($department_info as $department)
                    <option value="{{ $department->id }}" {{ $department->id == $departmentId ? 'selected' : '' }}>{{ $department->dept_short_name }}</option>
                @endforeach
            </select>
            <p id="employeeIdError" class="text-danger"></p>
        </div>

            <div class="form-group col-3">
                    <label for="startDateLeave">Start Date</label>
                    <input type="month" class="form-control" id="startDateLeave" name="startDateLeave" placeholder="Enter startDateLeave" value="{{ $month }}" >
                   
                </div>
                <!-- <div class="form-group col-2">
                    <label for="endDateLeave">end Date</label>
                    <input type="date" class="form-control" id="endDateLeave" name="endDateLeave" placeholder="Enter endDateLeave" value="{{ $year }}">
                    
                </div> -->
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
          
          <!-- //todo attendance -->

       


         <table class="table table-bordered table-hover table-responsive">
    <thead>
        <tr class="text-center">
            <th rowspan="2">Name</th>
            <th rowspan="2">Designation</th>
            <th rowspan="2">Time</th>
            @for ($day = 1; $day <= $days_in_month; $day++)
                <th rowspan="1" class='{{ $day == 4 ? "bg-secondary" : "" }}'>{{ $day }}</th>
            @endfor
            <th rowspan="1">Total</th>
        </tr>
        <tr>
            @for ($day = 1; $day <= $days_in_month; $day++)
                <th class='{{ $day == 4 ? "bg-secondary" : "" }}'>{{ \Carbon\Carbon::createFromDate($year, $month, $day)->shortDayName }}</th>
            @endfor
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $prev_em_id = null; $status_cells = []; $in_cells = []; $out_cells = []; @endphp

        @foreach ($attendance_info as $attendance)
            @if ($attendance->employeeId !== $prev_em_id && $prev_em_id !== null)
                <tr>
                    <td rowspan="3">{{ $prev_em_name }} ({{ $prev_em_id }})</td>
                    <td rowspan="3">{{ $prev_desig_name }}</td>
                    <td>Status</td>
                    <!-- @foreach ($status_cells as $status_cell)
                        <td>{{ $status_cell }}</td>
                    @endforeach -->

                    @for ($day = 1; $day <= $days_in_month; $day++)
                           

                           @if ($attendance_date == $day)
                           @foreach ($status_cells as $status_cell)
                                 <td class="{{$status_cell === 'Present' ? 'bg-green' : ($status_cell === 'Late' ? 'bg-warning' : ($status_cell === 'Absent' ? 'bg-danger' : '')) }}">
                                 {{ $status_cell }}
                                 </td>
                                 @endforeach
                                 
                           @else
                                 <td>
                                    {{-- Display some default value --}}
                                 </td>
                           @endif
                        @endfor
                    
                </tr>
                <tr>
                  
                    <td>IN</td>
                    <!-- @foreach ($in_cells as $in_cell)
                        <td>{{ $in_cell }}</td>
                    @endforeach -->

                    @for ($day = 1; $day <= $days_in_month; $day++)
                           

                           @if ($attendance_date == $day)
                           @foreach ($in_cells as $in_cell)
                           <td class="{{ strtotime($in_cell) <= strtotime('10:30:00') ? 'bg-green' : (strtotime($in_cell) <= strtotime('11:00:00') ? 'bg-warning' : 'bg-danger') }}">
                              {!! $in_cell !!}
                           </td>

                                 @endforeach
                           @else
                                 <td>
                                    {{-- Display some default value --}}
                                 </td>
                           @endif
                        @endfor
                   
                </tr>
                <tr>
                    <td>OUT</td>
                    <!-- @foreach ($out_cells as $out_cell)
                        <td>{{ $out_cell }}</td>
                    @endforeach -->

                    @for ($day = 1; $day <= $days_in_month; $day++)
                          

                           @if ($attendance_date == $day)
                           @foreach ($out_cells as $out_cell)
                                 <td class="{{ strtotime($attendance->timeOut) >= strtotime('18:30:00') && strtotime($attendance->timeOut) <= strtotime('19:50:00') ? 'bg-green' : 'bg-info' }}">
                                 {!! $out_cell !!}
                                 </td>
                                 @endforeach
                           @else
                                 <td>
                                    {{-- Display some default value --}}
                                 </td>
                           @endif
                        @endfor
                    
                </tr>

                @php $status_cells = []; $in_cells = []; $out_cells = []; @endphp
            @endif

            @php
                $attendance_date = \Carbon\Carbon::createFromFormat('Y-m-d', $attendance->date)->format('j');
                $status_cells[] = $attendance->status;

                $in_cells[] = strtotime($attendance->timeIn) <= strtotime('10:30:30') ? ' <span class="bg-green">' . date('h:i A', strtotime($attendance->timeIn)) . '</span>' : ' <span class="bg-danger">' . date('h:i A', strtotime($attendance->timeIn)) . '</span>';

                $out_cells[] = (strtotime($attendance->timeOut) >= strtotime('18:30:00') && strtotime($attendance->timeOut) <= strtotime('19:50:00')) ? ' <span class="bg-green">' . date('h:i A', strtotime($attendance->timeOut)) . '</span>' : ' <span class="bg-info">' . date('h:i A', strtotime($attendance->timeOut)) . '</span>';

                $prev_em_id = $attendance->em_id;
                $prev_em_name = $attendance->em_name;
                $prev_desig_name = $attendance->desig_name;
            @endphp
        @endforeach

        <!-- Final row for the last employee -->
        <tr>
            <td rowspan="3">{{ $prev_em_name }} ({{ $prev_em_id }})</td>
            <td rowspan="3">{{ $prev_desig_name }}</td>
            <td>Status</td>
            <!-- @foreach ($status_cells as $status_cell)
                <td>{{ $status_cell }}</td>
            @endforeach -->
            @for ($day = 1; $day <= $days_in_month; $day++)
                           

                           @if ($attendance_date == $day)
                           @foreach ($status_cells as $status_cell)
                                 <td class="{{$status_cell === 'Present' ? 'bg-green' : ($status_cell === 'Late' ? 'bg-warning' : ($status_cell === 'Absent' ? 'bg-danger' : '')) }}">
                                    {{ $status_cell  }}
                                 </td>
                                 @endforeach
                                 
                           @else
                                 <td>
                                    {{-- Display some default value --}}
                                 </td>
                           @endif
                        @endfor
            
        </tr>
        <tr>
            <td>IN</td>
            <!-- @foreach ($in_cells as $in_cell)
                <td>{!! $in_cell !!}</td>
            @endforeach -->

            @for ($day = 1; $day <= $days_in_month; $day++)
                           

                           @if ($attendance_date == $day)
                           @foreach ($in_cells as $in_cell)
                           <td class="{{ strtotime($in_cell) <= strtotime('10:30:00') ? 'bg-green' : (strtotime($in_cell) <= strtotime('11:00:00') ? 'bg-warning' : 'bg-danger') }}">
                              {!! $in_cell !!}
                           </td>

                                 @endforeach
                           @else
                                 <td>
                                    {{-- Display some default value --}}
                                 </td>
                           @endif
                        @endfor
            
        </tr>
        <tr>
            <td>OUT</td>
            <!-- @foreach ($out_cells as $out_cell)
                <td>{!! $out_cell !!}</td>
            @endforeach -->

            @for ($day = 1; $day <= $days_in_month; $day++)
                          

                           @if ($attendance_date == $day)
                           @foreach ($out_cells as $out_cell)
                                 <td class="{{ strtotime($attendance->timeOut) >= strtotime('18:30:00') && strtotime($attendance->timeOut) <= strtotime('19:50:00') ? 'bg-green' : 'bg-info' }}">
                                 {!! $out_cell !!}
                                 </td>
                                 @endforeach
                           @else
                                 <td>
                                    {{-- Display some default value --}}
                                 </td>
                           @endif
                        @endfor
           
        </tr>
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