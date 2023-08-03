
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">daily_short_leave_report_list</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">daily_short_leave_report_list</li>
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
                <h3 class="card-title">daily_short_leave_report_list</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>EmployeeID</th>
                    <th>Employee</th>
                    <th>Designation</th>
                    <th>Leave Type</th>
                    <th>Star Time</th>
                    <th>End Time</th>
                     <th>leave Time</th>
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
                          <td>{{ $leave->leave_type_name}}</td>
                          <td>{{ $leave->startTime }}</td>
                          <td>{{ $leave->endTime }}</td>
                          <td>{{ $leave->leaveDay }}</td>
                          <td>{{ $leave->status }}</td>
                          
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