    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 ">Approval Salary Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active"> Approval Salary Report</li>
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
                <h3 class="card-title"> Approval Salary Report</h3>
              </div>
              <div class="card-body">
              <form method="post" action="{{ route('approval_salary_report') }}" onsubmit="return validateForm()">
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
                        <input type="date" class="form-control" id="startDateLeave" name="startDateLeave" placeholder="Enter startDateLeave" value="{{ $start_date }}" >
                       
                    </div>
                    <div class="form-group col-2">
                        <label for="endDateLeave">end Date</label>
                        <input type="date" class="form-control" id="endDateLeave" name="endDateLeave" placeholder="Enter endDateLeave" value="{{ $end_date }}">
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
              <h6 class="fw-bold my-3">Approval Salary Report</h6>
              
                <table id="example2" class="table table-bordered table-hover table-responsive" style='overflow-x: scroll !important;'>
                
                     
                  <thead style='' class=' bg-light'>
                      <tr class='text-center'>
                          <th rowspan="2">SL</th>
                          <th rowspan="2">Name of the Employee</th>
                          <th rowspan="2">Department</th>
                          <th rowspan="2" class='text-center'>Designation</th>
                          <th rowspan="2">j. Date</th>
                          <th rowspan="2">T.Days</th>
                          <th rowspan="2">P.Days</th>
                          <th rowspan="2">G.Salary</th>
                          <th rowspan="2">Cash</th>
                          <th rowspan="2">Bank</th>
                          <th rowspan="2">Absent Amount</th>
                          <th rowspan="2">Total Payable</th>
                          <th colspan="10">Deduction</th>
                          <th rowspan="2">Arrear</th>
                          <th  rowspan="2">Net Payable</th>
                          
                      </tr>
                      <tr >
                          <th>Stamp</th>
                          <th>TDS</th>
                          <th>Gen. Loan</th>
                          <th>Sal. Adv. </th>
                          <th>Car Loan</th>
                          <th>meal</th>
                          <th>Mobile</th>
                          <th>Security</th>
                          <th>Other Deduction</th>
                          <th>Total Deduction</th>
                      </tr>
                    </thead>
                      <tbody>
                      
                    @if(!empty($generate_info))
                    @foreach($generate_info as $generate)
                      <tr>
                          <td>{{ $generate->id }}</td>
                          <td>{{ $generate->em_name }}</td>
                          <td>{{ $generate->dept_short_name }}</td>
                          <td>{{ $generate->desig_name }}</td>
                          <td>{{ $generate->joinDate }}</td>

                          <td>{{ $generate->working_days }}</td>
                          <td>{{ $generate->payable_days }}</td>
                          <td>{{ $generate->gross }}</td>
                          <td>{{ $generate->cash_amount }}</td>
                          <td>{{ $generate->bank_amount }}</td>
                          <td>{{ $generate->absent_amount }}</td>
                          
                          <td>{{ $generate->net_payable }}</td>
                          <td>{{ $generate->Stamp }}</td>
                          <td>{{ $generate->TDS }}</td>
                          <td>{{ $generate->general_loan }}</td>
                          <td>{{ $generate->salary_advance }}</td>
                          <td>{{ $generate->car_loan }}</td>
                          <td>{{ $generate->meal }}</td>
                          <td>{{ $generate->mobile_deduction }}</td>
                          <td>{{ $generate->security_amount }}</td>
                          <td>{{ $generate->other_deduction }}</td>
                          <td>{{ $generate->total_deduction }}</td>
                          <td>{{ $generate->arrear }}</td>

                          <td>{{ $generate->net_payable }}</td>
                      </tr>
                     @endforeach
                     @endif   
                  
                  </tfoot>
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