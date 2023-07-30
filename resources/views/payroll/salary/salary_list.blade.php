
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Salary</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    @endsection  
      
    @section('main_content')

      <div class="col-md-3">
          <a style="" href="{{ route('salary_add') }}"><button type="button" class="btn btn-block btn-info">Add salary</button></a>
      </div> 
      <h6 class="text-center text-success ">{{session('message')}}</h6>
      <br />
       <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Salary List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Employee ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Net Gross Benefit</th>
                    <th>Gross Salary</th>
                    <th>Basic</th>
                    <th>H.R.</th>
                    <th>Medical</th>
                    <th>Transports</th>
                    <th>Others</th>
                    <th>Stamps</th>
                    <th>Tax</th>
                    
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($salary)){
                    foreach($salary as $salary){  ?>
                        <tr>
                        <td>{{ $salary->id }}</td>
                          <td>{{ $salary->em_name}}</td>
                          <td>{{ $salary->desig_name}}</td>
                          <td>{{ $salary->net_gross }}</td>
                          <td>{{ $salary->gross }}</td>
                          <td>{{ $salary->Basic }}</td>
                          <td>{{ $salary->routing_number }}</td>
                          <td>{{ $salary->Medical }}</td>
                          <td>{{ $salary->Transport }}</td>
                          <td>{{ $salary->Others }}</td>
                          <td>{{ $salary->Stamp }}</td>
                          <td>{{ $salary->Tax }}</td>
                          
                          <td>
                            <a href="{{route('view_salary', $salary->id)}}"><button type="button" class="btn  btn-sm btn-primary">View</button></a>
                            <a href="{{route('edit_salary', $salary->id)}}"><button type="button" class="btn  btn-sm btn-success">Edit</button></a>
                            <a href="{{route('salary_delete', $salary->id)}} "onclick="return confirm('Are you sure!')"><button type="button" class="btn  btn-sm btn-danger">Delete</button></a>
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