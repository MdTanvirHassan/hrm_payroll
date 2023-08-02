
@extends('layouts.app')  

@section('content_header')
   <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">salary arrear Info</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">salary arrear</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection  
  
@section('main_content')

  <div class="col-md-3">
      <a style="" href="{{ route('salary_arrear_add') }}"><button type="button" class="btn btn-block btn-info">Add salary arrear</button></a>
  </div> 
  <h6 class="text-center text-success ">{{session('message')}}</h6>
  <br />
   <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">salary arrear List</h3>
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
                <th>Payable Days</th>
                <th>Arrear Amount</th>
                <th>Status</th>
                
                
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                if(!empty($salary_arrear)){
                foreach($salary_arrear as $salary_arrear){  ?>
                    <tr>
                    <td>{{ $salary_arrear->id }}</td>
                      <td>{{ $salary_arrear->em_name}}</td>
                      <td>{{ $salary_arrear->desig_name}}</td>
                      <td>{{ $salary_arrear->dept_short_name }}</td>
                      <td>{{ date('F Y', strtotime($salary_arrear->adjust_month)) }}</td>
                      <td>{{ $salary_arrear->payable_days }}</td>
                      <td>{{ $salary_arrear->amount }}</td>
                      
                      <td>{{ $salary_arrear->status }}</td>
                      
                      <td>
                        <a href="{{route('view_salary_arrear', $salary_arrear->id)}}"><button type="button" class="btn  btn-sm btn-primary">View</button></a>
                        <a href="{{route('edit_salary_arrear', $salary_arrear->id)}}"><button type="button" class="btn  btn-sm btn-success">Edit</button></a>
                        <a href="{{route('salary_arrear_delete', $salary_arrear->id)}} " onclick="return confirm('Are you sure!')"><button type="button" class="btn  btn-sm btn-danger">Delete</button></a>
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