<nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">
        <a href="index-2.html" class="navbar-brand sidebar-gone-hide">CSRMSS</a>
        {{-- <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a> --}}
        <div class="nav-collapse">
            <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#"><i class="fas fa-ellipsis-v"></i></a>
            <ul class="navbar-nav">
                <li class="nav-item {{ request()->is('client')?'active':'' }}"><a href="{{ route('client.home') }}" class="nav-link">Services</a></li>
                <li class="nav-item {{ request()->is('client/request')?'active':'' }}"><a href="{{ route('client.requestClient') }}" class="nav-link">Request Status</a></li>
            </ul>
        </div>
     
        <ul class="navbar-nav navbar-right mb-1"> 
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg 
                @if (count(auth()->user()->unreadNotifications)!=0)
                beep
                @endif
                "><i class="far fa-bell"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        @forelse (auth()->user()->notifications()->take(4)->get() as $item)
                        <a href="@if ( true)  {{ route('client.requestList') }} @endif" class="dropdown-item @if ($item->read_at == null) dropdown-item-unread @endif ">
                            <div class="dropdown-item-icon bg-primary text-white">
                              <i class="fas {{ $item->data['request']['icon'] }}"></i>
                            </div>
                            <div class="dropdown-item-desc">
                             {{ $item->data['request']['bodyMessage'] }}
                              <div class="time text-primary">{{ $item->created_at->diffForHumans() }}</div>
                            </div>
                          </a>
                        @empty
                        <p class="text-center">No notifications</p>
                        @endforelse
                
                    </div>
                    <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                </li>

            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link  nav-link-user">
                    Hi, {{ ucwords(auth()->user()->fullname) }}
                </a>
            </li>
            <li class="dropdown">
                <a  href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>   
            </li>
        </ul>
    </div>
</nav>