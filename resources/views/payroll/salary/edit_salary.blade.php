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
        <div class="row">
            <!-- left column -->
            <div class="col-md-8 m-auto">
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
                                            {{ $employee->employeeId }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <p id="employeeIdError" class="text-danger"></p> -->
                                </div>

                                <div class="form-group col-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                    <!-- <p id="nameError" class="text-danger"></p> -->
                                </div>

                                <div class="form-group col-4">
                                    <label for="designation">Designation</label>
                                    <select class="form-select form-control" id="designation" name="designation" required>
                                        <option>Select Designation</option>
                                        @foreach ($salary_info as $salary)
                                        <option value="{{ $salary->id }}">{{ $salary->desig_name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="designationError" class="text-danger"></p>
                                </div>
                            </div>


            <h5 class="text-success">Benifit</h5>

            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="gross">Gross Salary</label>
                        <input type="number" class="form-control" id="gross" name="gross" placeholder="Enter gross salary" >
                        <p id="grossError" class="text-danger"></p>
                    </div>
                    <div class="form-group col-4">
                        <label for="others">Others Allowance</label>
                        <input type="number" class="form-control" id="others" name="others" placeholder="Enter Others Allowance" >
                        <p id="othersError" class="text-danger"></p>
                    </div>

                      <div class="form-group col-4">
                        <label for="net_gross">Net Gross Benefit</label>
                        <input type="number" class="form-control" id="net_gross" name="net_gross" placeholder="Enter net gross benifit" >
                        
                      </div>

            </div>

            <h5 class="text-warning">Deduction</h5>

            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="stamp">Stamp</label>
                        <input type="number" class="form-control" id="stamp" name="Stamp" placeholder="Enter stamp" >
                        <p id="stampError" class="text-danger"></p>
                    </div>
                    <div class="form-group col-4">
                        <label for="tax">Tax</label>
                        <input type="number" class="form-control" id="tax" name="Tax" placeholder="Enter Tax" >
                        <p id="othersError" class="text-danger"></p>
                    </div>

                      <div class="form-group col-4">
                        <label for="security_amount">Security Amount</label>
                        <input type="number" class="form-control" id="security_amount" name="security_amount" placeholder="Enter security amount" >
                        
                      </div>

            </div>

            <h5 class="text-primary">Salary Distribution</h5>

            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="distribution">Distribution Type</label>
                        <input type="number" class="form-control" id="distribution" name="distribution" placeholder="Enter distribution" >
                        <!-- <p id="stampError" class="text-danger"></p> -->
                    </div>
                    <div class="form-group col-4">
                        <label for="bank">Bank</label>
                        <input type="number" class="form-control" id="bank" name="bank" placeholder="Enter Bank" >
                        <!-- <p id="othersError" class="text-danger"></p> -->
                    </div>

                      <div class="form-group col-4">
                        <label for="cash">Cash</label>
                        <input type="number" class="form-control" id="cash" name="cash" placeholder="Enter Cash amount" >
                        
                      </div>

            </div>

            
            
          </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('bank_list') }}" class="btn btn-danger">Go Back</a>
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

        // Get the selected employeeId and the corresponding name from the data passed to the view
        var selectedEmployeeId = selectElement.value;
        var employees = @json($employee_info);

        // Find the employee with the selected ID and update the name input field
        var selectedEmployee = employees.find(function (employee) {
            return employee.id == selectedEmployeeId;
        });

        nameInput.value = selectedEmployee ? selectedEmployee.name : '';
    }

   
</script>
@endsection
