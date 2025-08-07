<div class="sidebar" data-image="{{ asset('assets/img/sidebar-5.jpg') }}">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">Admin KPK Jhoang</a>
        </div>
        <ul class="nav">
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('menus.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('menus.index') }}">
                <i class="nc-icon nc-grid-45"></i>
                <p>Menu</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="nc-icon nc-bullet-list-67"></i>
                <p>Kategori</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Pesanan</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('orders.history') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('orders.history') }}">
                <i class="nc-icon nc-chart-bar-32"></i>
                <p>Riwayat Pesanan</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('untukuser.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('untukuser.index') }}">
                <i class="nc-icon nc-single-02"></i>
                <p>Untuk User</p>
                </a>
            </li>
        </ul>

        </div>
    </div>
     <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>

        <ul class="dropdown-menu">
			<li class="header-title"> Sidebar Style</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Background Image</p>
                    <label class="switch">
                        <input type="checkbox" data-toggle="switch" checked="" data-on-color="primary" data-off-color="primary"><span class="toggle"></span>
                    </label>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <p>Filters</p>
                    <div class="pull-right">
                        <span class="badge filter badge-black" data-color="black"></span>
                        <span class="badge filter badge-azure" data-color="azure"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-purple active" data-color="purple"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Sidebar Images</li>

            <li class="active">
    <a class="img-holder switch-trigger" href="javascript:void(0)">
        <img src="{{ asset('assets/img/sidebar-1.jpg') }}" alt="" />
    </a>
</li>
<li>
    <a class="img-holder switch-trigger" href="javascript:void(0)">
        <img src="{{ asset('assets/img/sidebar-3.jpg') }}" alt="" />
    </a>
</li>
<li>
    <a class="img-holder switch-trigger" href="javascript:void(0)">
        <img src="{{ asset('assets/img/sidebar-4.jpg') }}" alt="" />
    </a>
</li>
<li>
    <a class="img-holder switch-trigger" href="javascript:void(0)">
        <img src="{{ asset('assets/img/sidebar-5.jpg') }}" alt="" />
    </a>
</li>

        </ul>
    </div>
</div>
 
</body>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>

<!--  Plugin for Switches -->
<script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>

<!--  Google Maps Plugin (jika digunakan) -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!--  Chartist Plugin  -->
<script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>

<!--  Notifications Plugin  -->
<script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>

<!-- Light Bootstrap Dashboard Core Script -->
<script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>

<!-- Light Bootstrap Dashboard DEMO Script (optional, hanya untuk demo) -->
<script src="{{ asset('assets/js/demo.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>

</html>
    
 
             