<!-- Start app top navbar -->
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars" style=""></i></a>
            </li>
        </ul>
    </form>
    @php
        function whereIgo($status){
            if($status=='service'){
                return route('admin.registered.client');
            }else{
                return route('admin.user');
            }
        }
    @endphp
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg @if (count(auth()->user()->unreadNotifications)!=0) beep @endif "><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                <div class="float-right">
                    <a href="#">Mark All As Read</a>
                </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    @forelse (auth()->user()->notifications()->take(4)->get() as $item)
                    <a href="{{ whereIgo($item->data['request']['status']) }}" class="dropdown-item @if ($item->read_at == null) dropdown-item-unread @endif ">
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
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg nav-link-user">
        {{-- <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> --}}
        <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div></a>
        
    </li>
    <li class="dropdown"><a  href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
         class="nav-link  nav-link-lg nav-link-user">
        {{-- <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> --}}
        <div class="d-sm-none d-lg-inline-block"><i class="fas fa-sign-out-alt text-danger"></i></div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>   
    </a>
   
    </li>
    </ul>
</nav>