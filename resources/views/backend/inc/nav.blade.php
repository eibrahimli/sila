<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <img class="admin-brand-logo" src="{{ asset('backend/img/logo.png') }}" width="40" alt="sila Logo">
        <span class="admin-brand-content font-secondary"><a href='{{ route('admin.index') }}'> Sila Express</a></span>
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
            <li class="menu-item">
                <a href="{{ route('admin.index') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Anasəhifə</span>

                    </span>
                    <span class="menu-icon">
{{--                           <span class="icon-badge badge-success badge badge-pill">4</span>--}}
                        <i class="icon-placeholder mdi mdi-shape-outline "></i>
                    </span>
                </a>              
            </li>
            <li class="menu-item">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">İstifadəçilər
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-account"></i>
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-item ">
                        <a href='{{ route('admin.user.index') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Bütün İstifadəçilər</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-account-box">
                                </i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Kateqoriyalar
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-format-list-bulleted"></i>
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-item ">
                        <a href='{{ route('admin.category.index') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Bütün Kateqoriyalar</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-format-list-checks">
                                </i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href='{{ route('admin.category.create') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Yeni Kateqoriya</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-plus-circle">
                                </i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>     
            <li class="menu-item">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Brendlər
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-format-list-bulleted"></i>
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-item ">
                        <a href='{{ route('admin.brand.index') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Bütün Brendlər</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-format-list-checks">
                                </i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href='{{ route('admin.brand.create') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Yeni Brend</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-plus-circle">
                                </i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>     
            <li class="menu-item">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Məhsullar
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-format-list-bulleted"></i>
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-item ">
                        <a href='{{ route('admin.product.activeIndex') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Bütün Aktiv Məhsullar</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-format-list-checks">
                                </i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href='{{ route('admin.product.NotActiveIndex') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Bütün Aktiv Olmayan Məhsullar</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-format-list">
                                </i>
                            </span>
                        </a>
                    </li>
                
                </ul>
            </li>
            <li class="menu-item">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Sifarişlər
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-format-list-bulleted"></i>
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-item ">
                        <a href='{{ route('admin.order.index') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Bütün Aktiv Sifarişlər</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-format-list-checks">
                                </i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href='{{ route('admin.order.notActiveIndex') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Bütün Aktiv Olmayan Sifarişlər</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-format-list">
                                </i>
                            </span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.page.edit',1) }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Haqqımızda
                            
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-information"></i>
                    </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Rənglər
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-format-list-bulleted"></i>
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-item ">
                        <a href='{{ route('admin.color.index') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Bütün Rənglər</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-format-list-checks">
                                </i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href='{{ route('admin.color.create') }}' class='menu-link'>
                            <span class="menu-label">
                                <span class="menu-name">Yeni Rəng</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-plus-circle">
                                </i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            

            <li class="menu-item">
                <a href="{{ route('admin.banner.index') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Bannerlər
                            
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-circle-outline"></i>
                    </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.edit') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Ayarlar
                            
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-settings"></i>
                    </span>
                </a>
            </li>
   
        </ul>
    </div>
</aside>
