<!-- ===============>> Header section start here <<================= -->
<header class="header-section header-section--style3">
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{route('front.login')}}">
                        <img src="{{ asset($setting->logo) }}" alt="logo" width="250px">
                    </a>
                </div>
                <div class="header-content d-flex align-items-center">
                    <div class="menu-area">
                        <ul class="menu menu--style2">
                            @auth
                                <li> <a href="{{route('user.dashboard')}}">Dashboard </a> </li>
                            @endauth
                            <li> <a href="{{ route('front.plan') }}">Plan</a> </li>
                            <li>
                                <a href="#0">Finance</a>
                                <ul class="submenu">
                                   {{-- <li> <a href="{{ route('front.plan') }}">Plan</a> </li> --}}
                                   <li> <a href="{{ route('front.deposit') }}">Deposite</a> </li>
                                   <li> <a href="{{ route('front.withdraw.request') }}">Withdraw</a> </li>
                                   <li> <a href="{{ route('front.withdraw.request.history') }}">Withdrawal History</a> </li>
                                   <li> <a href="{{ route('front.transaction') }}">Transactions</a> </li>
                                   <li> <a href="{{ route('front.transaction') }}">User History</a> </li>
                                   <li> <a href="{{ route('front.transaction') }}">User Level Earning</a> </li>
                                </ul>
                            </li>
                            <li> <a href="{{ route('front.plan') }}">Referral</a> </li>
                            <li>
                                <a href="#0">Account Settings</a>
                                <ul class="submenu">
                                   <li> <a href="{{ route('front.editProfile') }}">Profile Setting</a> </li>
                                   <li> <a href="{{ route('front.change.password') }}">Change Password</a> </li>
                                   {{-- <li> <a href="{{ route('front.withdraw.request') }}">Change Password</a> </li> --}}
                                </ul>
                            </li>
                            <li> <a href="{{ route('front.contact') }}">Contact Us</a> </li>
                        </ul>

                    </div>
                    <div class="header-action">
                        <div class="menu-area">
                            <div class="header-btn">
                                @auth
                                    {{-- If user is logged in --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="trk-btn trk-btn--border trk-btn--primary">
                                            <i class="fas fa-sign-out-alt mr-2"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                @endauth

                                @guest
                                    {{-- If user is not logged in --}}
                                    <a href="{{ route('front.login') }}"
                                        class="trk-btn trk-btn--border trk-btn--primary">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        <span>Login</span>
                                    </a>
                                @endguest

                            </div>

                            <!-- toggle icons -->
                            <div class="header-bar d-lg-none header-bar--style2">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ===============>> Header section end here <<================= -->
