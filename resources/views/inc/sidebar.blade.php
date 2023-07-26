<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(190deg, rgba(3,15,62,1) 0%, rgba(20,56,98,1) 35%, rgba(14,92,135,1) 48%, rgba(30,136,140,1) 68%)!important;">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ static_asset('assets/dist/img/AdminLTELogo.png') }}"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HRM PAYROLL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ static_asset('assets/dist/img/user2-160x160.jpg') }}"  class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">4axiz-Tanvir</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Employee
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('designation_list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-info"></i>
                  <p>Designation</p>
                </a>
              </li>

               <!-- <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>bank</p>
                </a>
              </li> -->

              <li class="nav-item">
                <a href="{{route('employee_list')}}"  class="nav-link" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee</p>
                </a>
              </li>
              
            </ul>
          </li>


        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('company_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Company</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('department_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Departments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('bank_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-info"></i>
                  <p>Banks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('shift_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shifts</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Holiday Calendar</p>
                </a>
              </li>

              
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Leave
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('leave_list')}}"  class="nav-link" >
                  <i class="far fa-circle nav-icon text-white"></i>
                  <p>Leave Types</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('full_leave_list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"  ></i>
                  <p>Full Leaves</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon text-info"></i>
                  <p>Half Leaves</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Short Leaves</p>
                </a>
              </li>

             
              
            </ul>
          </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>