<aside class="main-sidebar elevation-4 main-sidebar elevation-4 sidebar-primary-primary">
    <!-- Sidebar -->
    @php
        use Illuminate\Support\Facades\Route;
    @endphp

    <div class="sidebar pt-0 mt-0">

        <div class="user-panel">
            <a href="{{ route('branchManager.dashboard') }}" class="name text-dark">
                <img src="{{ asset('assets/admin/img/MhowLogo.png') }}" alt="" width="200px">
            </a>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item {{ Route::currentRouteName() == 'branchManager.dashboard' ? 'menu-open' : '' }}">
                    <a href="{{ route('branchManager.dashboard') }}"
                        class="nav-link {{ Route::currentRouteName() == 'branchManager.dashboard' ? 'active' : '' }} @if (request()->path() == 'admin/dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'branchManager.profile.edit' ? 'menu-open' : '' }}">
                    <a href="{{ route('branchManager.profile.edit') }}"
                        class="nav-link {{ Route::currentRouteName() == 'branchManager.profile.edit' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{ __('Profile') }}
                        </p>
                    </a>
                </li>
                
                <li
                    class="nav-item {{ Route::currentRouteName() == 'branchManager.user.index' || Route::currentRouteName() == 'branchManager.user.pendingUsers' || Route::currentRouteName() == 'branchManager.user.approvedUsers' || Route::currentRouteName() == 'branchManager.user.blockedUsers' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('branchManager.user.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'branchManager.user.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('All Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('branchManager.user.pendingUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'branchManager.user.pendingUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Pending Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('branchManager.user.approvedUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'branchManager.user.approvedUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Approved Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('branchManager.user.blockedUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'branchManager.user.blockedUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Blocked Users') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                
                <li class="nav-item {{ request()->routeIs('branchManager.event.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('branchManager.event.index') }}"
                        class="nav-link {{ request()->routeIs('branchManager.event.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fas fa-calendar"></i>
                        <p>
                            {{ __('Events') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('branchManager.event.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'branchManager.event.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('List') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('branchManager.event.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'branchManager.event.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add') }}</p>
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
