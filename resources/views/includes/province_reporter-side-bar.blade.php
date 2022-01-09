<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu pb-4">
            <ul class="pcoded-item pcoded-left-item">
                <li>
                    <a class="waves-effect waves-dark" href="/products">
                        <span class="pcoded-micon">
                        <i class="feather icon-watch"></i>
                        </span>
                        <span class="pcoded-mtext">{{auth()->user()->user()->first()->province}} Province Panel</span>
                    </a>
                </li>
            </ul>
            <div class="pcoded-navigation-label">Report Management</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu">
                    <a class="waves-effect waves-dark" href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">User Management</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li>
                            <a class="waves-effect waves-dark" href="{{ route('province.mechents') }}">
                                <span class="pcoded-micon">
                                <i class="feather icon-list"></i>
                                </span>
                                <span class="pcoded-mtext">Merchants</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="/province/agents">
                                <span class="pcoded-micon">
                                <i class="feather icon-list"></i>
                                </span>
                                <span class="pcoded-mtext">Agents</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="/province/districts-managers">
                                <span class="pcoded-micon">
                                <i class="feather icon-list"></i>
                                </span>
                                <span class="pcoded-mtext">Districts Managers</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
           <div class="pcoded-navigation-label">All Requests</div>
           <ul class="pcoded-item pcoded-left-item">
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('province.all_request') }}">
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
                    <a class="waves-effect waves-dark" href="{{ route('province.profile') }}">
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
