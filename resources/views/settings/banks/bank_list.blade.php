
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bank</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Bank</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    @endsection  
      
    @section('main_content')

      <div class="col-md-3">
          <a style="" href="{{ route('bank_add') }}"><button type="button" class="btn btn-block btn-info">Add Bank</button></a>
      </div> 
      <h6 class="text-center text-success ">{{session('message')}}</h6>
      <br />
       <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bank List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Bank ID</th>
                    <th>Bank Name</th>
                    <th>Branch Name</th>
                    <th>Bank Type</th>
                    <th>Company</th>
                    <th>Company Acc.</th>
                    <th>Routing No.</th>
                    
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($bank)){
                    foreach($bank as $bank){  ?>
                        <tr>
                        <td>{{ $bank->id }}</td>
                          <td>{{ $bank->name }}</td>
                          <td>{{ $bank->branch_name}}</td>
                          <td>{{ $bank->bank_type }}</td>
                          <td>{{ $bank->company_id }}</td>
                          <td>{{ $bank->company_account }}</td>
                          <td>{{ $bank->routing_number }}</td>
                          
                          <td>
                            <a href="{{route('view_bank', $bank->id)}}"><button type="button" class="btn  btn-sm btn-primary">View</button></a>
                            <a href="{{route('edit_bank', $bank->id)}}"><button type="button" class="btn  btn-sm btn-success">Edit</button></a>
                            <a href="{{route('bank_delete', $bank->id)}}"><button type="button" class="btn  btn-sm btn-danger">Delete</button></a>
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