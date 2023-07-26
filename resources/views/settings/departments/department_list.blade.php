
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

      <div class="col-md-3">
          <a style="" href="{{ route('department_add') }}"><button type="button" class="btn btn-block btn-info">Add Department</button></a>
      </div> 
      <h6 class="text-center text-success ">{{session('message')}}</h6>
      <br />
       <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Department List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Department Description</th>
                    <th>Department Short Name</th>
                    
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($department)){
                    foreach($department as $dept){  ?>
                        <tr>
                        <td>{{ $dept->id }}</td>
                          <td>{{ $dept->dept_name }}</td>
                          <td>{{ $dept->dep_description }}</td>
                          <td>{{ $dept->dept_short_name }}</td>
                          
                          <td>
                            <a href="{{route('view_department', $dept->id)}}"><button type="button" class="btn  btn-sm btn-primary">View</button></a>
                            <a href="{{route('edit_department', $dept->id)}}"><button type="button" class="btn  btn-sm btn-success">Edit</button></a>
                            <a href="{{route('department_delete', $dept->id)}}"><button type="button" class="btn  btn-sm btn-danger">Delete</button></a>
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