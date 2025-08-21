  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">You have 0 unread Notifications</span>
                {{-- @foreach (Auth()->user()->unreadNotifications->take(5) as $notification)
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="far fa-bell mr-2"></i>{{ $notification->data['message'] }}
                        <span
                            class="float-right text-muted text-sm">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                    </a>
                @endforeach --}}
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All
                    Notifications</a>
            </div>
        </li>
        <li class="nav-item mx-3">
            <a class="mr-2 mt-1 btn btn-primary btn-sm" href="{{ url('/') }}" class="" nav-link pt-0 pr-3"
                target="_blank">
                View Site
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link pt-0 pr-3 " data-toggle="dropdown" href="#">
                @if (isset(Auth()->user()->icon) && Auth()->user()->icon != null)
                    <img class="user-image w-40 img-circle shadow"
                        src="{{ asset('admin/user/profile/' . Auth()->user()->icon) }}" alt="User Image">
                @else
                    <img class="user-image w-40 img-circle shadow" src="{{ asset('assets/uploads/core/logo.png') }}"
                        alt="User Image">
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-none">
                <div class="card card-widget widget-user-2 mb-0 shadow-none">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-primary">
                        <div class="widget-user-image bg-white">
                            @if (isset(Auth()->user()->icon) && Auth()->user()->icon != null)
                                <img class="img-circle elevation-2  bg-white"
                                    src="{{ asset('admin/user/profile/' . auth()->user()->icon) }}" alt="User Avatar">
                            @else
                                <img class="user-image w-40 img-circle shadow"
                                    src="{{ asset('assets/uploads/core/logo.png') }}" alt="User Image">
                            @endif
                        </div>
                        <!-- /.widget-user-image -->
                        <h6 class="widget-user-username mt-2">{{ auth()->user()->name }}</h6>
                        <h6 class="widget-user-desc">{{ auth()->user()->email }}</h6>
                    </div>
                    <div class="card-footer p-0 bg-white">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.profile.edit') }}" class="nav-link">
                                    <i class="fas fa-edit mr-1"></i> {{ __('Edit Profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.profile.edit') }}" class="nav-link">
                                    <i class="fas fa-unlock-alt mr-1"></i> {{ __('Change Password') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-arrow-left-square-fill"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
