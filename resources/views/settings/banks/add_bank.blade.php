@extends('layouts.app')

@section('content_header')
   <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Bank</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Bank</li>
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
            <h3 class="card-title">Add Bank</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="{{ route('bank_add_action') }}" onsubmit="return validateForm()">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Bank Name</label>
                <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Bank Name">
                <p id="nameError" class="text-danger"></p>
              </div>

              <div class="form-group">
                <label for="branch_name">Branch Name</label>
                <input type="text" autocomplete="off" class="form-control" id="branch_name" name="branch_name" placeholder="Enter branch Name">
                <p id="branch_nameError" class="text-danger"></p>
              </div>

              <div class="form-group">
                <label for="bank_type">Bank Type</label>
                <input type="text" autocomplete="off" class="form-control" id="bank_type" name="bank_type" placeholder="Enter Bank Type">
                <p id="bank_typeError" class="text-danger"></p>
              </div>

              <div class="form-group">
                <label for="company_id">Company</label>
                <input type="text" autocomplete="off" class="form-control" id="company_id" name="company_id" placeholder="Enter company id">
                <p id="company_idError" class="text-danger"></p>
              </div>

              <div class="form-group">
                <label for="company_account">Account</label>
                <input type="text" autocomplete="off" class="form-control" id="company_account" name="company_account" placeholder="Enter Account">
                <p id="company_accountError" class="text-danger"></p>
              </div>

              <div class="form-group">
                <label for="routing_number">Routing No.</label>
                <input type="text" autocomplete="off" class="form-control" id="routing_number" name="routing_number" placeholder="Enter routing number">
                <p id="routing_numberError" class="text-danger"></p>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('bank_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
        </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->

  <script>
function validateForm() {
  var fields = [
    { id: "name", name: "bank name" },
    { id: "branch_name", name: "branch name" },
    { id: "bank_type", name: "bank type" },
    { id: "company_id", name: "company's id" },
    { id: "company_account", name: "company account" },
    { id: "routing_number", name: "routing number" },
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
@endsection
