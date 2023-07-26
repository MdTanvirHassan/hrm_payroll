@extends('layouts.app')

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Shift</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Shift</li>
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
          <h3 class="card-title">Add Shift</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('shift_add_action') }}" onsubmit="return validateForm()">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="shift">Shift</label>
              <input type="text" autocomplete="off" class="form-control" id="shift" name="shift" placeholder="Shift">
              <p id="shiftError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="shiftCode">Shift Code</label>
              <input type="text" autocomplete="off" class="form-control" id="shiftCode" name="shiftCode" placeholder="Enter Shift Code">
              <p id="shiftCodeError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="startTime">Start Time</label>
              <input type="time" autocomplete="off" class="form-control" id="startTime" name="startTime" placeholder="Enter Start Time">
              <p id="startTimeError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="endTime">End Time</label>
              <input type="time" autocomplete="off" class="form-control" id="endTime" name="endTime" placeholder="Enter End Time">
              <p id="endTimeError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="weekend">Weekend</label>
              <input type="text" autocomplete="off" class="form-control" id="weekend" name="weekend" placeholder="Enter Weekend">
              <p id="weekendError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="toShift">To Shift</label>
              <input type="text" autocomplete="off" class="form-control" id="toShift" name="toShift" placeholder="Enter To Shift">
              <p id="toShiftError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="intimeRange">In-time Range</label>
              <input type="time" autocomplete="off" class="form-control" id="intimeRange" name="intimeRange" placeholder="Enter In-time Range">
              <p id="intimeRangeError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="outtimeRange">Out-time Range</label>
              <input type="time" autocomplete="off" class="form-control" id="outtimeRange" name="outtimeRange" placeholder="Enter Out-time Range">
              <p id="outtimeRangeError" class="text-danger"></p>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('shift_list') }}" class="btn btn-danger">Go Back</a>
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
    { id: "shift", name: "Shift" },
    { id: "shiftCode", name: "Shift Code" },
    { id: "startTime", name: "Start Time" },
    { id: "endTime", name: "End Time" },
    { id: "weekend", name: "Weekend" },
    { id: "toShift", name: "To Shift" },
    { id: "intimeRange", name: "In-time Range" },
    { id: "outtimeRange", name: "Out-time Range" }
  ];

  var isValid = true;

  fields.forEach(function(field) {
    var value = document.getElementById(field.id).value;
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
