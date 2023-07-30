
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">leave</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">leave</li>
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
                <h3 class="card-title">Edit Full leave Type</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('update_full_leave') }}"  onsubmit="return validateForm()">
                @csrf
                <div class="card-body">
            <div class="d-flex">
            <div class="form-group col-4">
              <label for="employeeId" class="form-label">Employee ID</label>
              <input type="hidden" class="form-control" id="id" name="id" value="{{ $leave_info->id }}">
              <select class="form-select form-control" id="employeeId" name="employeeId" required>
                @foreach ($leave_infos as $employee)
                  <option value="{{ $employee->id }}" {{ $leave_info->employeeId == $employee->id ? 'selected' : '' }}>
                    {{ $employee->name }}
                  </option>
                @endforeach
              </select>
              <p id="employeeIdError" class="text-danger"></p>
            </div>


            <div class="form-group col-4">
              <label for="leave_type">Leave types</label>
              <select class="form-select form-control" id="leave_type" name='leave_type' required>
                      @foreach ($leave_type as $type)
                    <option value="{{ $type->id }}"  {{ $leave_info->leave_type == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
                    </select>
                    <p id="leave_typeError" class="text-danger"></p>
            </div>
            <div class="form-group col-4">
              <label for="startDateLeave">startDateLeave</label>
              <input type="date" class="form-control" id="startDateLeave" name="startDateLeave" placeholder="Enter startDateLeave" value='{{ $leave_info->startDateLeave }}' onchange="calculateLeaveDays()">
              <p id="startDateLeaveError" class="text-danger"></p>
            </div>
            </div>

            <div class="d-flex">
            <div class="form-group col-4">
              <label for="endDateLeave">endDateLeave</label>
              <input type="date" class="form-control" id="endDateLeave" name="endDateLeave" placeholder="Enter endDateLeave" value='{{ $leave_info->endDateLeave }}' onchange="calculateLeaveDays()">
              <p id="endDateLeaveError" class="text-danger"></p>
            </div>
            <div class="form-group col-4">
              <label for="leaveDay">Leave Day</label>
              <input type="text" class="form-control" id="leaveDay" name="leaveDay" placeholder="Enter leaveDay" value='{{ $leave_info->leaveDay }}' >
              <p id="leaveDayError" class="text-danger"></p>
            </div>
            <div class="form-group col-4">
              <label for="status">status</label>
              <input type="text" class="form-control" id="status" name="status" placeholder="Enter status" value='{{ $leave_info->status }}' readonly>
              <!-- <p id="statusError" class="text-danger"></p> -->
            </div>

            </div>

            <div class="form-floating">
              <label for="leave_reason">Leave Reason</label>
              <textarea class="form-control" placeholder="Leave Reason" id="leave_reason" name="leave_reason" style="height: 100px" value=''>{{ $leave_info->leave_reason }}</textarea>
              <p id="leave_reasonError" class="text-danger"></p>
          </div>

            
            
          </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update</button>
                  <a href="{{ route('full_leave_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
                  
                </div>
              </form>
            </div>
            <!-- /.card -->

               

          </div>
          <!--/.col (left) -->
            </div>

       
        </div>
        <!-- /.row -->
       
        
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      <script>
          function validateForm() {
            var fields = [
              { id: "employeeId", name: "Employee ID" },
              { id: "leave_type", name: "Leave Types" },
              { id: "startDateLeave", name: "Start Date Leave" },
              { id: "endDateLeave", name: "End Date Leave" },
              { id: "leave_reason", name: "Leave Reason" },
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
    function calculateLeaveDays() {
        const startDate = new Date(document.getElementById('startDateLeave').value);
        const endDate = new Date(document.getElementById('endDateLeave').value);

        // Calculate the difference in days
        const oneDay = 24 * 60 * 60 * 1000; // milliseconds in one day
        const diffInDays = Math.round((endDate - startDate) / oneDay) + 1;

        // Update the leaveDay field value
        document.getElementById('leaveDay').value = diffInDays;
    }

    // Attach the function to the change event of the start and end date inputs
    document.getElementById('startDateLeave').addEventListener('change', calculateLeaveDays);
    document.getElementById('endDateLeave').addEventListener('change', calculateLeaveDays);
</script>

<script>
    function calculateLeaveDays() {
        var startDate =$('#startDateLeave').val();
        var endDate =$('#endDateLeave').val();

        var em_Id = $('#employeeId').val();
        var leave_types = $('#leave_type').val();
        

        // Calculate the difference in days
        var oneDay = 24 * 60 * 60 * 1000; // milliseconds in one day
        var diffInDays = Math.round((endDate - startDate) / oneDay) + 1;
       

        var data = {'startDateLeave': startDate, 'endDateLeave': endDate, 'emId': em_Id, 'leave_type': leave_types}
        
        $.ajax({
          headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            url: "{{ route('total_leave_working_days') }}",
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
               
                 if(msg.msg=='success'){
                    $('#leaveDay').val(msg.leaveDay);
                    
                   
                    //$('input[type="button"]').removeAttr('disabled');
                }else{
                    alert('You have already applied for this type of leave.Please select another leave type');
                    $('#startDateLeave').val('');
                    $('#endDateLeave').val('');
                    $('#leaveDay').val('');
                    
                    //$('#btn_submit').prop("disabled", true);
                }
            }
        })
    }
</script>


@endsection   