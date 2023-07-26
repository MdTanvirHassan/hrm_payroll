
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">leaves</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">leaves</li>
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
                <h3 class="card-title">View full leaves</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="get" action="" >
                @csrf
                <div class="card-body">
            <div class="d-flex">
            <div class="form-group col-4">
              <label for="employeeId" class="form-label">Employee ID</label>
              <input type="hidden" class="form-control" id="id" name="id" value="{{ $leave_info->id }}">
              <select class="form-select form-control" id="employeeId" name="employeeId" disabled required>
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
              <select class="form-select form-control" id="leave_type" name='leave_type' disabled required>
                      @foreach ($leave_type as $type)
                    <option value="{{ $type->id }}"  {{ $leave_info->leave_type == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
                    </select>
                    <p id="leave_typeError" class="text-danger"></p>
            </div>
            <div class="form-group col-4">
              <label for="startDateLeave">startDateLeave</label>
              <input type="date" class="form-control" id="startDateLeave" name="startDateLeave" placeholder="Enter startDateLeave" value='{{ $leave_info->startDateLeave }}' readonly>
              <p id="startDateLeaveError" class="text-danger"></p>
            </div>
            </div>

            <div class="d-flex">
            <div class="form-group col-4">
              <label for="endDateLeave">endDateLeave</label>
              <input type="date" class="form-control" id="endDateLeave" name="endDateLeave" placeholder="Enter endDateLeave" value='{{ $leave_info->endDateLeave }}' readonly>
              <p id="endDateLeaveError" class="text-danger"></p>
            </div>
            <div class="form-group col-4">
              <label for="leaveDay">Leave Day</label>
              <input type="text" class="form-control" id="leaveDay" name="leaveDay" placeholder="Enter leaveDay" value='{{ $leave_info->leaveDay }}' readonly>
              <p id="leaveDayError" class="text-danger"></p>
            </div>
            <div class="form-group col-4">
              <label for="status">status</label>
              <input type="text" class="form-control" id="status" name="status" placeholder="Enter status" value='{{ $leave_info->status }}' readonly>
              <p id="statusError" class="text-danger"></p>
            </div>

            </div>

            <div class="form-floating">
              <label for="leave_reason">Leave Reason</label>
              <textarea class="form-control" placeholder="Leave Reason" id="leave_reason" name="leave_reason" style="height: 100px" value='' readonly>{{ $leave_info->leave_reason }}</textarea>
              <p id="leave_reasonError" class="text-danger"></p>
          </div>

            
            
          </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 
                  <a href="{{ route('leave_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
                  
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
@endsection   