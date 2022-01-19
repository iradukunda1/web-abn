<!-- Left Sidenav -->
<div class="left-sidenav">
    <ul class="metismenu left-sidenav-menu">



        <li>
            <a href="{{ route('manager.index') }} "
                class="{{  (Route::is('manager.index')) ? 'mm-active active' : '' }}"><i
                    class="ti-home"></i><span>Dashboard</span><span class="menu-arrow"></< /span></a>

        </li>





        <li>
            <a href="javascript: void(0);"><i class="ti-server"></i><span>Stock In</span><span class="menu-arrow"><i
                        class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item"><a class="nav-link" href="{{ route('manager.stockIn') }}"><i
                            class="ti-control-record"></i>Stock In</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('manager.stockInList') }}"><i
                            class="ti-control-record"></i>Stock In List</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);"><i class="ti-server"></i><span>Stock Out</span><span class="menu-arrow"><i
                        class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item"><a class="nav-link" href="{{ route('manager.stockOut') }}"><i
                            class="ti-control-record"></i>Stock Out</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('manager.stockOutList') }}"><i
                            class="ti-control-record"></i>Stock Out List</a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('manager.report') }}" class=""><i class="ti-book"></i><span>Report</span><span
                    class="menu-arrow"></< /span></a>

        </li>


    </ul>
</div>
<!-- end left-sidenav-->