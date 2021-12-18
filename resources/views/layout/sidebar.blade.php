 <!-- Start main left sidebar menu -->
 <div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">CSRMSS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">CS</a>
        </div>
       
        <ul class="sidebar-menu">
            
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('admin/dashboard')?'active':'' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
           
            <li class="menu-header">Management</li>
            <li class="{{ request()->is('admin/priest')?'active':'' }}"><a class="nav-link" href="{{ route('admin.priest') }}"><i class="fas fa-holly-berry"></i> <span>Priest</span></a></li>
            <li class="{{ request()->is('admin/schedule')?'active':'' }}"><a class="nav-link" href="{{ route('admin.schedule') }}"><i class="fas fa-calendar-check"></i> <span>Schedule</span></a></li>
            <li class="{{ request()->is('admin/user')?'active':'' }}"><a class="nav-link" href="{{ route('admin.user') }}"><i class="fas fa-users"></i> <span>Users</span></a></li>
            <li class="{{ request()->is('admin/registered/client')?'active':'' }}"><a class="nav-link" href="{{ route('admin.registered.client') }}"><i class="fas fa-registered"></i> <span>Client Request</span></a></li>
            <li class="{{ request()->is('admin/profile')?'active':'' }}"><a class="nav-link" href="{{ route('admin.profile') }}"><i class="fas fa-users"></i> <span>System Profile</span></a></li>
           
            <li class="menu-header">System Report</li>
            <li  class="{{ request()->is('admin/report/baptism') || request()->is('admin/report/baptism/create')?'active':'' }}"><a class="nav-link" href="{{ route('admin.baptism') }}"><i class="fas fa-baby"></i> <span>Baptism</span> </a></li>
            <li  class="{{ request()->is('admin/report/wedding') || request()->is('admin/report/wedding/create')?'active':'' }}"><a class="nav-link" href="{{ route('admin.wedding') }}"> <i class="fas fa-female"></i> <span>Wedding</span> </a></li>
            <li  class="{{ request()->is('admin/report/burial')  || request()->is('admin/report/burial/create')?'active':'' }}"><a class="nav-link" href="{{ route('admin.burial') }}"><i class="fas fa-cross"></i> <span>Burial</span> </a></li>
            <li  class="{{ request()->is('admin/report/mass')  || request()->is('admin/report/mass/create')?'active':'' }}"><a class="nav-link" href="{{ route('admin.mass') }}"><i class="fas fa-church"></i> <span>Mass</span> </a></li>
         
            {{-- <li class="{{ request()->is('admin/report')?'active':'' }}"><a class="nav-link" href="{{ route('admin.profile') }}"><i class="fas fa-file-word"></i> <span>Report</span></a></li>
            <li class="menu-header">Information</li> --}}
           
            <li><a class="nav-link text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
      
    </aside>
</div>