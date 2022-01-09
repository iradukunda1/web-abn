<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu pb-4">
            <ul class="pcoded-item pcoded-left-item">
                <li>
                    <a class="waves-effect waves-dark" href="/products">
                        <span class="pcoded-micon">
                        <i class="feather icon-watch"></i>
                        </span>
                        <span class="pcoded-mtext">{{auth()->user()->user()->first()->district}} District Panel</span>
                    </a>
                </li>
            </ul>
            <div class="pcoded-navigation-label">Report Management</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu">
                    <a class="waves-effect waves-dark" href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">User</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li>
                            <a class="waves-effect waves-dark" href="{{ route('district.agent') }}">
                                <span class="pcoded-micon">
                                <i class="feather icon-list"></i>
                                </span>
                                <span class="pcoded-mtext">Agent</span>
                            </a>
                        </li>
                         <li>
                            <a class="waves-effect waves-dark" href="{{ route('district.merchent') }}">
                                <span class="pcoded-micon">
                                <i class="feather icon-list"></i>
                                </span>
                                <span class="pcoded-mtext">Merchants</span>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
            <div class="pcoded-navigation-label">All Requests</div>
           <ul class="pcoded-item pcoded-left-item">
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('district.request') }}">
                        <span class="pcoded-micon">
                        <i class="feather icon-book"></i>
                        </span>
                        <span class="pcoded-mtext">Requests</span>
                    </a>
                </li>

            </ul>
            <div class="pcoded-navigation-label">Settings</div>
            <ul class="pcoded-item pcoded-left-item">
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('district.profile') }}">
                        <span class="pcoded-micon">
                        <i class="feather icon-user"></i>
                        </span>
                        <span class="pcoded-mtext">Profile</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="/logout">
                        <span class="pcoded-micon">
                        <i class="feather icon-log-out"></i>
                        </span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
