
@extends('layouts.app')  

@section('content_header')
   <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Employee</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection  
  
@section('main_content')


  
   <div class="container-fluid">
   
        <div class="row  d-flex  justify-content-center m-auto">
            <!-- left column -->
      <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Add Employee</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="{{ route('employee_add_action') }}" >
            @csrf
            <div class="card-body">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Employee Name">
              </div>  

              <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" autocomplete="off" class="form-control" id="designation" name="designation" placeholder="Enter Designation">
              </div>  

            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" autocomplete="off" class="form-control" id="department" name="department" placeholder="Enter department">
              </div>  

              <!-- <div class="form-group">
                <label for="mobile">Mobile No.</label>
                <input type="email" autocomplete="off" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile No">
              </div> -->

              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
              </div>     

         
             
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-success">Submit</button>
               <a href="{{ route('employee_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
              
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