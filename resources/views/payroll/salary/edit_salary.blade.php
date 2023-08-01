@extends('layouts.app')

@section('content_header')
   <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Salary</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Salary</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('main_content')
   <div class="container-fluid">
   <input type="hidden" class="form-control" id="id" name="id" value="{{ $salary_info->id }}">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 m-auto">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Salary</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('update_salary') }}" onsubmit="return validateForm()">
                        @csrf
                        <div class="card-body">
                        <div class="d-flex">
                                <div class="form-group col-4">
                                    <label for="employeeId" class="form-label">Employee</label>
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{ $salary_info->id }}">
                                    <select class="form-select form-control" id="employeeId" name="employeeId" required onchange="updateName()">
                                        <option>Select Employee</option>
                                        @foreach ($employee_info as $employee)
                                        <option value="{{ $employee->id }}" {{ $salary_info->employeeId == $employee->employeeId ? 'selected' : '' }}>
                                        {{ $employee->name }} ({{ $employee->employeeId }})
                                        </option>
                                        @endforeach
                                    </select>
                                    <p id="employeeIdError" class="text-danger"></p>
                                </div>
                                

                                <div class="form-group col-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" >
                                    <!-- <p id="nameError" class="text-danger"></p> -->
                                </div>

                                



                                <div class="form-group col-4">
                                    <label for="desig_name">Designation</label>
                                    <select class="form-select form-control" id="desig_name" name="desig_name" required onchange="updateName()" disabled>
                                        <option>Select Designation</option>
                                        @foreach ($employee_info as $employee)
                                        <option value="{{ $employee->id }}" {{ $salary_info->employeeId == $employee->employeeId ? 'selected' : '' }}>
                                        {{ $employee->desig_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p id="desig_nameError" class="text-danger"></p>
                                </div>
                            </div>


            <h5 class="text-success">Benifit</h5>

            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="basic_percent">Basic Percent %</label>
                        <input type="number" class="form-control" id="basic_percent" name="basic_percent" placeholder="Enter basic percent" value='60' readonly>
                        <!-- <p id="grossError" class="text-danger"></p> -->
                    </div>
                    <div class="form-group col-4">
                        <label for="house_rent_percent">House rent percent %</label>
                        <input type="number" class="form-control" id="house_rent_percent" name="house_rent_percent" placeholder="Enter house_rent_percent" value='50' readonly>
                        <!-- <p id="othersError" class="text-danger"></p> -->
                    </div>

                      <div class="form-group col-4">
                        <label for="medical_percent">medical percent %</label>
                        <input type="number" class="form-control" id="medical_percent" name="medical_percent" placeholder="Enter medical percent" value="10" readonly>
                        
                      </div>

            </div>
            
            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="gross">Gross Salary</label>
                        <input type="number" class="form-control" id="gross" name="gross" placeholder="Enter gross salary" value="{{ $salary_info->gross }}">
                        <p id="grossError" class="text-danger"></p>
                    </div>
                    <div class="form-group col-4">
                        <label for="others">Others Allowance</label>
                        <input type="number" class="form-control" id="others" name="others" placeholder="Enter Others Allowance" value="{{ $salary_info->Others }}">
                        <p id="othersError" class="text-danger"></p>
                    </div>

                      <div class="form-group col-4">
                        <label for="net_gross">Net Gross Benefit</label>
                        <input type="number" class="form-control" id="net_gross" name="net_gross" placeholder="Enter net gross benifit" value="{{ $salary_info->net_gross }}">
                        
                      </div>

            </div>

            <h5 class="text-warning">Deduction</h5>

            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="stamp">Stamp</label>
                        <input type="number" class="form-control" id="stamp" name="Stamp" placeholder="Enter stamp" value="{{ $salary_info->Stamp }}">
                        <p id="stampError" class="text-danger"></p>
                    </div>
                    <div class="form-group col-4">
                        <label for="tax">Tax</label>
                        <input type="number" class="form-control" id="tax" name="Tax" placeholder="Enter Tax" value="{{ $salary_info->Tax }}">
                        <p id="othersError" class="text-danger"></p>
                    </div>

                      <div class="form-group col-4">
                        <label for="security_amount">Security Amount</label>
                        <input type="number" class="form-control" id="security_amount" name="security_amount" placeholder="Enter security amount" value="{{ $salary_info->security_amount }}">
                        
                      </div>

            </div>

            <h5 class="text-primary">Salary Distribution</h5>

          
            <input type="hidden" class="form-control" id="id" name="id" value="{{ $salary_info->id }}">

            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="distribution_type">Distribution Type</label>
                        <select class="form-select form-control" id="distribution_type" name='distribution_type' required>
                            <option >Select distribution type </option>
                            <option {{ $employee_bank_info->distribution_type === "fixed" ? "selected" : "" }} value="fixed">Fixed</option>
                            <option {{ $employee_bank_info->distribution_type === "percent" ? "selected" : "" }} value="percent">Percentage</option>
                          
                          </select>
                          
                    </div>
                    
                    <div class="form-group col-4">
                        <label for="bank_portion">Bank Amount</label>
                        <input type="number" class="form-control" id="bank_portion" name="bank_portion" placeholder="Enter Bank Amount" value="{{ $employee_bank_info->bank_portion	 }}">
                        <!-- <p id="othersError" class="text-danger"></p> -->
                    </div>

                      <div class="form-group col-4">
                        <label for="cash_portion">Cash</label>
                        <input type="number" class="form-control" id="cash_portion" name="cash_portion" placeholder="Enter Cash amount" value="{{ $employee_bank_info->cash_portion }}">
                        
                      </div>

            </div>

            <div class="d-flex">
              
           
                  <div class="form-group col-4">
                      <label for="bank_id">Bank</label>
                      <select class="form-select form-control" id="bank_id" name="bank_id" required>
                          <option value="">Select Bank</option>
                          @foreach ($bank_info as $bank)
                              <option value="{{ $bank->id }}" {{ $employee_bank_info->bank_id == $bank->id ? 'selected' : '' }}>
                                  {{ $bank->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                    <div class="form-group col-4">
                        <label for="bank_acct_no">Bank Account No.</label>
                        <input type="number" class="form-control" id="bank_acct_no" name="bank_acct_no" placeholder="Enter Bank" value="{{ $employee_bank_info->bank_acct_no }}">
                        <!-- <p id="bank_acct_noError" class="text-danger"></p> -->
                    </div>

                      <div class="form-group col-4">
                        <label for="salary_held_up">Salary Held Up</label>
                        <select class="form-select form-control" id="salary_held_up" name='salary_held_up' required>
                            <option value="">Select salary held up</option>
                            <option {{ $employee_bank_info->salary_held_up === 'yes' ? 'selected' : '' }} value="yes">Yes</option>
                            <option {{ $employee_bank_info->salary_held_up === 'no' ? 'selected' : '' }} value="no">No</option>
                        </select>
                        
                      </div>

            </div>

          
            
          </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('salary_list') }}" class="btn btn-danger">Go Back</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
    </div>
    <!-- /.container-fluid -->

    <script>
function validateForm() {
  var fields = [
    { id: "employeeId", name: "Employee ID" },
    { id: "name", name: "Employee Name" },
    { id: "designation", name: "designation" },
    { id: "gross", name: "Gross Salary" },
    { id: "others", name: "Others Allowance" },
    // { id: "status", name: "Status" }
  ];

  var isValid = true;

  fields.forEach(function(field) {
    var value = document.getElementById(field.id).value.trim();
    var errorElement = document.getElementById(field.id + "Error");

    errorElement.innerText = "";

    if (value === "") {
      errorElement.innerText = "* Please enter the " + field.name;
      isValid = false;
      document.getElementById(field.id).classList.add("is-invalid");
    } else {
      document.getElementById(field.id).classList.remove("is-invalid");
    }
  });

  return isValid;
}
</script>

<script>
    function updateName() {
        var selectElement = document.getElementById('employeeId');
        var nameInput = document.getElementById('name');
        var designationInput = document.getElementById('desig_name');

        // Get the selected employeeId and the corresponding name from the data passed to the view
        var selectedEmployeeId = selectElement.value;
        var employees = @json($employee_info);

        // Find the employee with the selected ID and update the name input field
        var selectedEmployee = employees.find(function (employee) {
            return employee.id == selectedEmployeeId;
        });

        nameInput.value = selectedEmployee ? selectedEmployee.name : '';
        designationInput.value = selectedEmployee ? selectedEmployee.desig_name : '';
    }

   
</script>
@endsection
