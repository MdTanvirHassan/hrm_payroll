@extends('layouts.app')

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Add Salary</h1>
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
    <div class="col-md-12 m-auto">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add  Salary </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('salary_add_action') }}" onsubmit="return validateForm()">
          @csrf
          <div class="card-body">
            <div class="d-flex">

              <div class="form-group col-4">
                <label for="employeeId" class="form-label">Employee</label>
                <select class="form-select form-control" id="employeeId" name="employeeId"  onchange="updateName()">
                    <option value=''>Select Employee</option>
                    @foreach ($employee_info as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}({{$employee->employeeId}})</option>
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
                  <input type="text" class="form-control" id="desig_name" name="desig_name" placeholder="Enter designation" >
                  <!-- <p id="desig_nameError" class="text-danger"></p> -->
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
        <input type="number" class="form-control" id="gross" name="gross" placeholder="Enter gross salary" oninput="updateNetGross()">
        <p id="grossError" class="text-danger"></p>
    </div>
    <div class="form-group col-4">
        <label for="others">Others Allowance</label>
        <input type="number" class="form-control" id="others" name="others" placeholder="Enter Others Allowance" oninput="updateNetGross()">
        <!-- <p id="othersError" class="text-danger"></p> -->
    </div>
    <div class="form-group col-4">
        <label for="net_gross">Net Gross Benefit</label>
        <input type="number" class="form-control" id="net_gross" name="net_gross" placeholder="Enter net gross benefit" readonly>
    </div>
</div>





            <h5 class="text-warning">Deduction</h5>

            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="stamp">Stamp</label>
                        <input type="number" class="form-control" id="stamp" name="Stamp" placeholder="Enter stamp" >
                        <!-- <p id="stampError" class="text-danger"></p> -->
                    </div>
                    <div class="form-group col-4">
                        <label for="tax">Tax</label>
                        <input type="number" class="form-control" id="tax" name="Tax" placeholder="Enter Tax" >
                        <!-- <p id="othersError" class="text-danger"></p> -->
                    </div>

                      <div class="form-group col-4">
                        <label for="security_amount">Security Amount</label>
                        <input type="number" class="form-control" id="security_amount" name="security_amount" placeholder="Enter security amount" >
                        
                      </div>

            </div>

            <h5 class="text-primary">Salary Distribution</h5>

            <div class="d-flex">
              
                    <div class="form-group col-4">
                        <label for="distribution_type">Distribution Type</label>
                        <select class="form-select form-control" id="distribution_type" name='distribution_type' >
                            <option value=''>Select distribution type </option>
                           
                            <option value="fixed">Fixed</option>
                            <option value="percent">Percentage</option>
                          
                          </select>
                          <p id="distribution_typeError" class="text-danger"></p>
                          
                    </div>
                    <div class="form-group col-4">
                        <label for="bank_portion">Bank Amount</label>
                        <input type="number" class="form-control" id="bank_portion" name="bank_portion" placeholder="Enter Bank Amount" oninput='updatePayment()'>
                        <p id="bank_portionError" class="text-danger"></p>
                    </div>

                      <div class="form-group col-4">
                        <label for="cash_portion">Cash</label>
                        <input type="number" class="form-control" id="cash_portion" name="cash_portion" placeholder="Enter Cash amount"  oninput='updateCashPayment()'>
                        <p id="cash_portionError" class="text-danger"></p>
                        
                      </div>

            </div>

            <div class="d-flex">
              
            <div class="form-group col-4">
                <label for="bank_id">Bank</label>
                <select class="form-select form-control" id="bank_id" name='bank_id' >
                    <option>Select Bank</option>
                    @foreach ($bank_info as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                    @endforeach
                </select>
            </div>
                    <div class="form-group col-4">
                        <label for="bank_acct_no">Bank Account No.</label>
                        <input type="number" class="form-control" id="bank_acct_no" name="bank_acct_no" placeholder="Enter Bank" >
                        <!-- <p id="bank_acct_noError" class="text-danger"></p> -->
                    </div>

                      <div class="form-group col-4">
                        <label for="salary_held_up">Salary Held Up</label>
                        <select class="form-select form-control" id="salary_held_up" name='salary_held_up' >
                            <option value="">Select salary held up</option>
                            
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                        </select>
                        <p id="salary_held_upError" class="text-danger"></p>
                        
                      </div>

            </div>

            
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
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
    
    { id: "gross", name: "Gross Salary" },
    // { id: "distribution_type", name: "distribution type" },
    { id: "bank_portion", name: "bank portion" },
    { id: "cash_portion", name: "cash portion" },
    // { id: "salary_held_up", name: "salary held up" },
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

<script>
    function updateNetGross() {
          var grossInput = parseFloat(document.getElementById("gross").value);
          var othersInput = parseFloat(document.getElementById("others").value);
          var netGrossInput;

          if (!isNaN(othersInput)) {
              netGrossInput = grossInput + othersInput;
          } else {
              netGrossInput = grossInput;
          }

          document.getElementById("net_gross").value = netGrossInput;
      }


    function updatePayment() {
        var netGrossInput  = parseFloat(document.getElementById("net_gross").value);
        var bankInput = parseFloat(document.getElementById("bank_portion").value);
        
        var amount = netGrossInput - bankInput;
        

        document.getElementById("cash_portion").value = amount;

       
        
    }

    function updateCashPayment() {
        var netGrossInput  = parseFloat(document.getElementById("net_gross").value);
        
        var cashInput = parseFloat(document.getElementById("cash_portion").value);
        
        var bankAmount = netGrossInput - cashInput;

        

        document.getElementById("bank_portion").value = bankAmount;
        
    }
    
</script>


@endsection