<aside class="main-sidebar elevation-4 main-sidebar elevation-4 sidebar-primary-primary">
    <!-- Sidebar -->
    @php
        use Illuminate\Support\Facades\Route;
    @endphp

    <div class="sidebar pt-0 mt-0">

        <div class="user-panel">
            <a href="{{ route('admin.dashboard') }}" class="name text-dark">
                <img src="{{ asset('assets/admin/img/MhowLogo.png') }}" alt="" width="200px">
            </a>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }} @if (request()->path() == 'admin/dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'admin.profile.edit' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.profile.edit') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.profile.edit' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{ __('Profile') }}
                        </p>
                    </a>
                </li>

                {{-- users --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.user.index' || Route::currentRouteName() == 'admin.user.pendingUsers' || Route::currentRouteName() == 'admin.user.approvedUsers' || Route::currentRouteName() == 'admin.user.blockedUsers' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('All Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.pendingUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user.pendingUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Pending Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.approvedUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user.approvedUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Approved Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.blockedUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user.blockedUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Blocked Users') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Enquiry --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.enquiry.index' || Route::currentRouteName() == 'admin.enquiry.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.enquiry.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            {{ __('Enquiry') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.enquiry.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.enquiry.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('All Enquiries') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.enquiry.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.enquiry.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add Enquiry') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Enquiry End --}}

                {{-- reward --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.reward.index' || Route::currentRouteName() == 'admin.reward.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.reward.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>
                            {{ __('Reward') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.reward.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.reward.index' ? 'active' : '' }}">
                                <i class="fas fa-trophy nav-icon"></i>
                                <p>{{ __('All Rewards') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.reward.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.reward.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add Reward') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Reward End --}}
                {{-- investment --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.investment.index' || Route::currentRouteName() == 'admin.investment.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.investment.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>
                            {{ __('Investment') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.investment.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.investment.index' ? 'active' : '' }}">
                                <i class="fas fa-trophy nav-icon"></i>
                                <p>{{ __('All Investment') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.investment.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.investment.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add Investment') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- investment End --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
