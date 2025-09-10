<aside class="main-sidebar sidebar-dark-primary elevation-4 border-0">

    @php
        use Illuminate\Support\Facades\Route;
    @endphp

    <div class="sidebar pt-0 mt-0">

        <div class="user-panel">
            <a href="{{ route('admin.dashboard') }}" class="name text-dark">
                <img src="{{ asset($setting->logo) }}" style="padding-top: 13px; width: 200px !important;">
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

                <li class="nav-item {{ Route::currentRouteName() == 'admin.investment.index' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.investment.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.investment.index' ? 'active' : '' }} @if (request()->path() == 'admin/dashboard') active @endif">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            {{ __('Investment') }}
                        </p>
                    </a>
                </li>

                 {{-- Withdrawal Request --}}

                 <li class="nav-item {{ Route::currentRouteName() == 'admin.withdrawal-request.index' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.withdrawal-request.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.withdrawal-request.index' ? 'active' : '' }} @if (request()->path() == 'admin/dashboard') active @endif">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            {{ __('Withdraw Requests') }}
                        </p>
                    </a>
                </li>

               
                {{-- Withdrawal Request End --}}

                <li class="nav-item {{ Route::currentRouteName() == 'admin.transaction.index' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.transaction.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.transaction.index' ? 'active' : '' }} @if (request()->path() == 'admin/dashboard') active @endif">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            {{ __('Transactions') }}
                        </p>
                    </a>
                </li>

                     {{-- investment --}}
                {{-- <li
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
                    </ul>
                </li> --}}
                {{-- investment End --}}

               

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

                <li class="nav-item {{ request()->routeIs('admin.email-templates.*') ? 'menu-open' : '' }}">
                    <a href=""
                        class="nav-link {{ request()->routeIs('admin.email-templates.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope-at-fill mx-1"></i>
                        <p>
                            {{ __('Emails') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.email-templates.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.email-templates.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Email Templates') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Announcement --}}

                <li class="nav-item {{ Route::currentRouteName() == 'admin.announcement.index' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.announcement.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            {{ __('Announcement') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.announcement.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.announcement.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Announcement') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Announcement End --}}

                {{-- Admin Bank --}}
                <li class="nav-item {{ Route::currentRouteName() == 'admin.admin_banks.index' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.admin_banks.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-university"></i> {{-- Bank icon --}}
                        <p>
                            {{ __('Admin Bank') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.admin_banks.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.admin_banks.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Admin Bank') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Admin Bank End --}}

                {{-- User Bank --}}
                <li class="nav-item {{ Route::currentRouteName() == 'admin.user-banks.index' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.user-banks.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-landmark"></i>
                        <p>
                            {{ __('User Bank') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user-banks.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user-banks.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('User Bank') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- User Bank End --}}


               

                {{-- Salary Rule --}}

                <li class="nav-item {{ Route::currentRouteName() == 'admin.salary-rules.index' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.salary-rules.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i></i>
                        <p>
                            {{ __('Salary Rule') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.salary-rules.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.salary-rules.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Salary Rule') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Salary Rule End --}}


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
                    class="nav-item {{ Route::currentRouteName() == 'admin.reward.index' || Route::currentRouteName() == 'admin.reward.add' || Route::currentRouteName() == 'admin.reward.calculated'? 'menu-open' : '' }}">
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
                        <li class="nav-item">
                            <a href="{{ route('admin.reward.calculated') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.reward.calculated' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Reward History') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Reward End --}}
           
                {{-- user return start --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.user_returns.index' || Route::currentRouteName() == 'admin.user_returns.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.user_returns.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>
                            {{ __('UserReturns') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.user_returns.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user_returns.index' ? 'active' : '' }}">
                                <i class="fas fa-trophy nav-icon"></i>
                                <p>{{ __('All UserReturn') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user_returns.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user_returns.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add UserReturn') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- user return End --}}

                
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.index' || Route::currentRouteName() == 'admin.pendingAdmins' || Route::currentRouteName() == 'admin.approvedAdmins' || Route::currentRouteName() == 'admin.blockedAdmins' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Admins') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('All Admins') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pendingAdmins') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.pendingAdmins' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Pending Admins') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.approvedAdmins') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.approvedAdmins' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Approved Admins') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blockedAdmins') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.blockedAdmins' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Blocked Admins') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- BusinessRule --}}

                <li class="nav-item">
                    <a href="{{ route('admin.business.rules.edit') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.business.rules.edit' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            {{ __('BusinessRule') }}
                        </p>
                    </a>
                </li>

                {{-- BusinessRule End --}}



                {{-- Settings --}}

                <li class="nav-item">
                    <a href="{{ route('admin.setting.edit') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.setting.edit' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            {{ __('Settings') }}
                        </p>
                    </a>
                </li>

                {{-- Settings End --}}

                {{-- Trash --}}

                <li class="nav-item {{ request()->routeIs('admin.announcement.restore.*') ? 'menu-open' : '' }}">
                    <a href=""
                        class="nav-link {{ request()->routeIs('admin.announcement.restore.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trash"></i>

                        <p>
                            {{ __('Trash') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.announcement.restore.page') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.announcement.restore.page' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Announcement') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.reward.restore.page') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.reward.restore.page' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Rewards ') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user_returns.restore.page') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user_returns.restore.page' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('User Returns') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- Trash End --}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
