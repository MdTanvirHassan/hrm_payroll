
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shift</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Shift</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    @endsection  
      
    @section('main_content')

      <div class="col-md-3">
          <a style="" href="{{ route('shift_add') }}"><button type="button" class="btn btn-block btn-info">Add Shift</button></a>
      </div> 
      <h6 class="text-center text-success ">{{session('message')}}</h6>
      <br />
       <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Shift List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Shift Id</th>
      <th>Shift</th>
      <th>Shift Code</th>
      <th>startTime</th>
      <th>endTime</th>
      <th>weekend</th>
      <th>toShift</th>
      <th>intimeRange</th>
      <th>outtimeRange</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    if (!empty($shift)) {
      foreach ($shift as $shift) {
        ?>
        <tr>
          <td>{{ $shift->id }}</td>
          <td>{{ $shift->shift }}</td>
          <td>{{ $shift->shiftCode }}</td>
          <td>{{ date('h:i A', strtotime($shift->startTime)) }}</td>
          <td>{{ date('h:i A', strtotime($shift->endTime)) }}</td>
          <td>{{ $shift->weekend }}</td>
          <td>{{ $shift->toShift }}</td>
          <td>{{ date('h:i A', strtotime($shift->intimeRange)) }}</td>
          <td>{{ date('h:i A', strtotime($shift->outtimeRange)) }}</td>
          <td>
            <a href="{{ route('view_shift', $shift->id) }}"><button type="button" class="btn  btn-sm btn-primary">View</button></a>
            <a href="{{ route('edit_shift', $shift->id) }}"><button type="button" class="btn  btn-sm btn-success">Edit</button></a>
            <a href="{{ route('shift_delete', $shift->id) }}"><button type="button" class="btn  btn-sm btn-danger">Delete</button></a>
          </td>
        </tr>
        <?php 
      }
    } ?>    
  </tbody>
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