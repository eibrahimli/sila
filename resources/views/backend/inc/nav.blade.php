<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <img class="admin-brand-logo" src="{{ asset('backend/img/logo.png') }}" width="40" alt="sila Logo">
        <span class="admin-brand-content font-secondary"><a href='{{ route('admin.index') }}'>  Sila Express</a></span>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">
            <li class="menu-item active ">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Dashboard
                                <span class="menu-arrow"></span>
                            </span>

                        </span>
                    <span class="menu-icon">
{{--                           <span class="icon-badge badge-success badge badge-pill">4</span>--}}
                           <i class="icon-placeholder mdi mdi-shape-outline "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">

                    <li class="menu-item ">
                        <a href='index.htm' class=' menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Dashboard 1</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-shape-circle-plus ">
                                </i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</aside>
