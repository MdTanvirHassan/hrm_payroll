@extends('layouts.app')

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Department</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Department</li>
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
          <h3 class="card-title">Add Department</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('department_add_action') }}" onsubmit="return validateForm()">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="dept_name">Department Name</label>
              <input type="text" autocomplete="off" class="form-control" id="dept_name" name="dept_name" placeholder="Department Name">
              <p id="dept_nameError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="dep_description">Department Description</label>
              <input type="text" autocomplete="off" class="form-control" id="dep_description" name="dep_description" placeholder="Enter department description">
              <p id="dep_descriptionError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="dept_short_name">Department Short Name</label>
              <input type="text" autocomplete="off" class="form-control" id="dept_short_name" name="dept_short_name" placeholder="Enter Department Short Name">
              <p id="dept_short_nameError" class="text-danger"></p>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('department_list') }}" class="btn btn-danger">Go Back</a>
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
    { id: "dept_name", name: "Department Name" },
    { id: "dep_description", name: "Department Description" },
    { id: "dept_short_name", name: "Department Short Name" }
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
