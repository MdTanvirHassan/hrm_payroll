
@extends('layouts.app')  

@section('content_header')
   <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Absent Payments Info</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Absent Payments</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection  
  
@section('main_content')

  <div class="col-md-3">
      <a style="" href="{{ route('absent_payments_add') }}"><button type="button" class="btn btn-block btn-info">Add Absent Payments</button></a>
  </div> 
  <h6 class="text-center text-success ">{{session('message')}}</h6>
  <br />
   <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Absent Payments List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
              <th>Employee ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Adjust Month</th>
                <th>Payment Days</th>
                <th>Absent Payments Amount</th>
                <th>Status</th>
                
                
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                if(!empty($absent_payments)){
                foreach($absent_payments as $absent_payments){  ?>
                    <tr>
                    <td>{{ $absent_payments->id }}</td>
                      <td>{{ $absent_payments->em_name}}</td>
                      <td>{{ $absent_payments->desig_name}}</td>
                      <td>{{ $absent_payments->dept_short_name }}</td>
                      <td>{{ date('F Y', strtotime($absent_payments->adjust_month)) }}</td>
                      <td>{{ $absent_payments->payment_days }}</td>
                      <td>{{ $absent_payments->amount }}</td>
                      
                      <td>{{ $absent_payments->status }}</td>
                      
                      <td>
                        <a href="{{route('view_absent_payments', $absent_payments->id)}}"><button type="button" class="btn  btn-sm btn-primary">View</button></a>
                        <a href="{{route('edit_absent_payments', $absent_payments->id)}}"><button type="button" class="btn  btn-sm btn-success">Edit</button></a>
                        <a href="{{route('absent_payments_delete', $absent_payments->id)}} " onclick="return confirm('Are you sure!')"><button type="button" class="btn  btn-sm btn-danger">Delete</button></a>
                      </td>
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