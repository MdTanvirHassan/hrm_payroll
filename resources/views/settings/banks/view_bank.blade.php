
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">banks</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">banks</li>
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
                <h3 class="card-title">View Banks</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('update_bank') }}" >
                @csrf
                <div class="card-body">

                <div class="form-group">
                    <label for="name">bank name</label>
                    <input type="hidden"  class="form-control" id="id" name="id"  value="{{ $bank_info->id }}" >
                    <input type="text" autocomplete="off" class="form-control" id="dept_name" name="name" placeholder="bank Name" value="{{ $bank_info->name }}" readonly>
                  </div>  

                  <div class="form-group">
                  <label for="branch_name">Branch Name</label>
                    <input type="text" autocomplete="off" class="form-control" id="branch_name" name="branch_name" placeholder="Enter branch Name" value="{{ $bank_info->branch_name }}"  readonly>
                  </div>  

                  <div class="form-group">
                    <label for="bank_type">Bank Type</label>
                    <input type="text" autocomplete="off" class="form-control" id="bank_type" name="bank_type" placeholder="Enter Bank Type" value="{{ $bank_info->bank_type }}"  readonly>
                  </div>  

                  <div class="form-group">
                    <label for="company_id">Company</label>
                    <input type="text" autocomplete="off" class="form-control" id="company_id" name="company_id" placeholder="Enter company id" value="{{ $bank_info->company_id }}"  readonly>
                  </div>
                  <div class="form-group">
                    <label for="company_account">Account</label>
                    <input type="text" autocomplete="off" class="form-control" id="company_account" name="company_account" placeholder="Enter Account" value="{{ $bank_info->company_account }}"  readonly>
                  </div>
                  <div class="form-group">
                    <label for="routing_number">Routing No.</label>
                    <input type="text" autocomplete="off" class="form-control" id="routing_number" name="routing_number" placeholder="Enter routing number" value="{{ $bank_info->routing_number }}"  readonly>
                  </div> 

                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 
                  <a href="{{ route('bank_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
                  
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