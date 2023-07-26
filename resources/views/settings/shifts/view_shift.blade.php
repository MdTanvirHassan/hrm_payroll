
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Departments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Departments</li>
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
                <h3 class="card-title">View Departments</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('update_department') }}" >
                @csrf
                <div class="card-body">

                <div class="form-group">
                    <label for="dept_name">Department name</label>
                    <input type="hidden"  class="form-control" id="id" name="id"  value="{{ $department_info->id }}" >
                    <input type="text" autocomplete="off" class="form-control" id="dept_name" name="dept_name" placeholder="department name" value="{{ $department_info->dept_name }}" readonly>
                  </div>  

                  <div class="form-group">
                    <label for="dept_description">dept_description</label>
                    <input type="text" autocomplete="off" class="form-control" id="dept_description" name="dep_description" placeholder="Enter description" value="{{ $department_info->dep_description }}" readonly>
                  </div>  

                <div class="form-group">
                    <label for="dept_short_name">dept_short_name</label>
                    <input type="text" autocomplete="off" class="form-control" id="dept_short_name" name="dept_short_name" placeholder="Enter short name" value="{{ $department_info->dept_short_name }}" readonly>
                  </div>  

                  <!-- <div class="form-group">
                    <label for="dept_rank">dept_rank</label>
                    <input type="dept_rank" autocomplete="off" class="form-control" id="dept_rank" name="dept_rank" placeholder="Enter dept_rank" value="{{ $department_info->dept_rank }}">
                  </div> -->

                  
            <!--
                  <div class="form-group">
                    <label for="exampleInputFile">department Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
            -->      
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  
                  <a href="{{ route('department_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
                  
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