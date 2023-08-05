
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Half Leave Report List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Half Leave Report List</li>
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
                <h3 class="card-title">Half Leave Report List</h3>
              </div>
              <div class="card-body">
              <form method="post" action="{{ route('daily_half_leave_report_list') }}" onsubmit="return validateForm()">
              @csrf
            <div class="d-flex">

              <div class="form-group col-3">
                <label for="employeeId" class="form-label">Employee</label>
                <select class="form-select form-control" id="emId" name="emId" >
                    <option value="">Select Employee</option>
                    @foreach ($employee_info as $employee)
                        <option value="{{ $employee->id }}"  {{ $employee->id == $employeeId ? 'selected' : '' }}>{{ $employee->name }}({{$employee->employeeId}})</option>
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
                        <label for="startDateLeave">Search by Date</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Enter date" value="{{ $date }}" >
                       
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
              <div class="card-body">
                <h5 class='my-3'>Half Leave Report List</h5>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>EmployeeID</th>
                    <th>Employee</th>
                    <th>Designation</th>
                    
                    <th>Start Date Leave</th>
                    <th>EndDateLeave</th>
                     <th>leave Date</th>
                     <th>Reason</th>
                     <th>Status</th>
                     
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($leave)){
                    foreach($leave as $leave){  ?>
                        <tr>
                          <td>{{ $leave->id }}</td>
                          <td>{{ $leave->em_name }}</td>
                          <td>{{ $leave->desig_name }}</td>
                          
                          <td>{{ $leave->startTime }}</td>
                          <td>{{ $leave->endTime }}</td>
                          <td>{{ $leave->date }}</td>
                          <td>{{ $leave->reason}}</td>
                          <td>{{ $leave->Status }}</td>
                          
                        </tr>
                    <?php 
                      }
                    } ?>    
                  
                  </tfoot>
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
@endsection   