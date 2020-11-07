<header id="header" class="u-header u-header-left-aligned-nav">
  <div class="u-header__section">
      <!-- Topbar -->
    <div class="u-header-topbar py-2 d-none d-xl-block">
      <div class="container">
        <div class="d-flex align-items-center">
          <div class="topbar-left">
            <a href="#" class="text-gray-110 font-size-13 hover-on-dark">Azərbaycanın ən böyük onlayn satış
              saytına xoş gəlmisiniz</a>
          </div>
          <div class="topbar-right ml-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                <a href="../home/contact-v2.html" class="u-header-topbar__nav-link"><i class="ec ec-dollar mr-1"></i> Sila Express - də Sat</a>
              </li>
              <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                <a href="../shop/track-your-order.html" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Sifarişim hardadır?</a>
              </li>
              <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                <div class="d-flex align-items-center">
                  <!-- Language -->
                  <div class="position-relative">
                    <a id="languageDropdownInvoker" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" role="button" aria-controls="languageDropdown" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#languageDropdown" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                      <span class="d-inline-block d-sm-none">AZN</span>
                      <span class="d-none d-sm-inline-flex align-items-center"><span class="mr-1 font-weight-bold">₼</span> Manat (AZN)</span>
                    </a>

                    <div id="languageDropdown" class="dropdown-menu dropdown-unfold" aria-labelledby="languageDropdownInvoker">
                      <a class="dropdown-item active" href="#">Azərbaycan</a>
                      <a class="dropdown-item" href="#">İnglis</a>
                      <a class="dropdown-item" href="#">Rus</a>
                      <a class="dropdown-item" href="#">Türk</a>
                    </div>
                  </div>
                  <!-- End Language -->
                </div>
              </li>
              <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                <!-- Account Sidebar Toggle Button -->
                @guest
                <a id="sidebarNavToggler" href="javascript:;" role="button" class="u-header-topbar__nav-link" aria-controls="sidebarContent" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent" data-unfold-type="css-animation" data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight" data-unfold-duration="500">
                  <i class="ec ec-user mr-1"></i> Qeydiyyat <span class="text-gray-50">və ya</span>
                  Giriş Et
                </a>
                @endguest
                @auth
                  @if(auth()->user()->role == 'seller')
                  <a id="sidebarNavToggler" href="{{ route('seller.index') }}" role="button" class="u-header-topbar__nav-link">
                    <i class="ec ec-user mr-1"></i> Satıcı Paneli </a> <span style="font-size: 0.813rem" class="text-gray-50">və ya</span>
                  @else
                  <a id="sidebarNavToggler" href="{{ url('') }}" role="button" class="u-header-topbar__nav-link">
                    <i class="ec ec-user mr-1"></i> Mənim Hesabım </a> <span style="font-size: 0.813rem" class="text-gray-50">və ya</span>
                  @endif
                  <a style="cursor: pointer" role="button" class="u-header-topbar__nav-link" onclick="document.getElementById('formLogOut').submit()">Çıxış Et</a>

                <form style="display: none" id="formLogOut" action="{{ route('logout') }}" method="POST">
                  @csrf
                </form>
                @endauth

                <!-- End Account Sidebar Toggle Button -->
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Topbar -->

      <!-- Logo and Menu -->
      <div class="py-2 py-xl-4 bg-primary-down-lg">
          <div class="container my-0dot5 my-xl-0">
              <div class="row align-items-center">
                  <!-- Logo-offcanvas-menu -->
                  <div class="col-auto">
                      <!-- Nav -->
                      <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                          <!-- Logo -->
                          <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{ route('index') }}" aria-label="Electro">
                            <img src="{{ asset('storage/'. $setting->logo) }}" alt="Logo">
                          </a>
                          <!-- End Logo -->

                          <!-- Fullscreen Toggle Button -->
                          <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0"
                              aria-controls="sidebarHeader"
                              aria-haspopup="true"
                              aria-expanded="false"
                              data-unfold-event="click"
                              data-unfold-hide-on-scroll="false"
                              data-unfold-target="#sidebarHeader1"
                              data-unfold-type="css-animation"
                              data-unfold-animation-in="fadeInLeft"
                              data-unfold-animation-out="fadeOutLeft"
                              data-unfold-duration="500">
                              <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                  <span class="u-hamburger__inner"></span>
                              </span>
                          </button>
                          <!-- End Fullscreen Toggle Button -->
                      </nav>
                      <!-- End Nav -->

                      <!-- ========== HEADER SIDEBAR ========== -->
                      <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvoker">
                        <div class="u-sidebar__scroller">
                          <div class="u-sidebar__container">
                            <div class="u-header-sidebar__footer-offset">
                              <!-- Toggle Button -->
                              <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-4 bg-white">
                                <button type="button" class="close ml-auto" aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                                  <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                </button>
                              </div>
                              <!-- End Toggle Button -->
          
                              <!-- Content -->
                              <div class="js-scrollbar u-sidebar__body">
                                <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                  <!-- Logo -->
                                  <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center mb-3" href=" {{ route('index') }} " aria-label=" {{ $setting->title }} ">
                                    <img src=" {{ asset('storage/'.$setting->logo) }} " alt=" {{ $setting->title }} ">
                                  </a>
                                  <!-- End Logo -->
          
                                  <!-- List -->
                                  <ul id="headerSidebarList" class="u-header-collapse__nav">
                                    <!-- Value of the Day -->
                                    <li class="">
                                      <a class="u-header-collapse__nav-link font-weight-bold" href="#">Günün məhsulu</a>
                                    </li>
                                    <!-- End Value of the Day -->
          
                                    <!-- Top 100 Offers -->
                                    <li class="">
                                      <a class="u-header-collapse__nav-link font-weight-bold" href="#">Ən yaxşı 100 təklif</a>
                                    </li>
                                    <!-- End Top 100 Offers -->
          
                                    <!-- New Arrivals -->
                                    <li class="">
                                      <a class="u-header-collapse__nav-link font-weight-bold" href="#">Yeni gələnlər</a>
                                    </li>
                                    <!-- End New Arrivals -->
          
                                    <!-- Computers & Accessories -->
                                    <li class="u-has-submenu u-header-collapse__submenu">
                                      <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarComputersCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarComputersCollapse">
                                        Kateqoriya 1
                                      </a>
          
                                      <div id="headerSidebarComputersCollapse" class="collapse" data-parent="#headerSidebarContent">
                                        <ul class="u-header-collapse__nav-list">
                                          <li><span class="u-header-sidebar__sub-menu-title">Kateqoriya 1</span>
                                          </li>
                                          <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">All Computers & Accessories</a>
                                          </li>
                                          <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">Laptops, Desktops & Monitors</a>
                                          </li>
                                          <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">Printers & Ink</a></li>
                                          <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">Networking & Internet Devices</a>
                                          </li>
                                          <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">Computer Accessories</a></li>
                                          <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">Software</a></li>
                                          <li><span class="u-header-sidebar__sub-menu-title">Office & Stationery</span>
                                          </li>
                                          <li><a class="u-header-collapse__submenu-nav-link" href="#">All Office & Stationery</a></li>
                                          <li><a class="u-header-collapse__submenu-nav-link" href="#">All Electronics</a></li>
                                        </ul>
                                      </div>
                                    </li>
                                    <!-- End Computers & Accessories -->
          
                                  </ul>
                                  <!-- End List -->
                                </div>
                              </div>
                              <!-- End Content -->
                            </div>
                            <!-- Footer -->
                            <footer id="SVGwaveWithDots" class="svg-preloader u-header-sidebar__footer">
                              <ul class="list-inline mb-0">
                                <li class="list-inline-item pr-3">
                                  <a class="u-header-sidebar__footer-link text-gray-90" href="#">Məxfilik</a>
                                </li>
                                <li class="list-inline-item pr-3">
                                  <a class="u-header-sidebar__footer-link text-gray-90" href="#">Şərtlər</a>
                                </li>
                                <li class="list-inline-item">
                                  <a class="u-header-sidebar__footer-link text-gray-90" href="#">
                                    <i class="fas fa-info-circle"></i>
                                  </a>
                                </li>
                              </ul>
          
                              <!-- SVG Background Shape -->
                              <div class="position-absolute right-0 bottom-0 left-0 z-index-n1">
                                <img class="js-svg-injector" src="{{ asset('frontend/svg/components/wave-bottom-with-dots.svg') }}" alt="Image Description" data-parent="#SVGwaveWithDots">
                              </div>
                              <!-- End SVG Background Shape -->
                            </footer>
                            <!-- End Footer -->
                          </div>
                        </div>
                      </aside>
                      <!-- ========== END HEADER SIDEBAR ========== -->
                  </div>
                  <!-- End Logo-offcanvas-menu -->
                  <!-- Primary Menu -->
                  <div class="col d-none d-xl-block">
                      <!-- Nav -->
                      <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                          <!-- Navigation -->
                          <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                              <ul class="navbar-nav u-header__navbar-nav">
                                  <!-- Home -->
                                  <li class="nav-item hs-has-sub-menu u-header__nav-item"
                                      data-event="hover"
                                      data-animation-in="slideInUp"
                                      data-animation-out="fadeOut">
                                      <a class="nav-link u-header__nav-link" href="{{ route('index') }}" aria-haspopup="true" aria-expanded="false">Anasəhifə</a>

                                      <!-- Home - Submenu -->
                                      
                                      <!-- End Home - Submenu -->
                                  </li>
                                  <!-- End Home -->

                                  <!-- Blog -->
                                  
                                  <!-- End Blog -->

                                  <!-- About us -->
                                  <li class="nav-item u-header__nav-item">
                                      <a class="nav-link u-header__nav-link" href="">Haqqımızda</a>
                                  </li>
                                  <!-- End About us -->

                                  <!-- FAQs -->
                                  <li class="nav-item u-header__nav-item">
                                      <a class="nav-link u-header__nav-link" href="../home/faq.html">FAQs</a>
                                  </li>
                                  <!-- End FAQs -->

                                  <!-- Contact Us -->
                                  <li class="nav-item u-header__nav-item">
                                      <a class="nav-link u-header__nav-link" href="">Əlaqə</a>
                                  </li>
                                  <!-- End Contact Us -->
                              </ul>
                          </div>
                          <!-- End Navigation -->
                      </nav>
                      <!-- End Nav -->
                  </div>
                  <!-- End Primary Menu -->
                  <!-- Customer Care -->
                  <div class="d-none d-xl-block col-md-auto">
                      <div class="d-flex">
                          <i class="ec ec-support font-size-50 text-primary"></i>
                          <div class="ml-2">
                              <div class="phone">
                                  <strong>Dəstək</strong> <a href="tel:{{ str_replace(['(',')', '-'],'',$setting->number) }}" class="text-gray-90">+{{ $setting->number }}</a>
                              </div>
                              <div class="email">
                                  E-mail: <a href="mailto:{{ $setting->email }}?subject=Dəstək üçün" class="text-gray-90">{{ $setting->email }}</a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End Customer Care -->
                  <!-- Header Icons -->
                  <div class="d-xl-none col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                      <div class="d-inline-flex">
                          <ul class="d-flex list-unstyled mb-0 align-items-center">
                              <!-- Search -->
                              <li class="col d-xl-none px-2 px-sm-3 position-static">
                                  <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="Search"
                                      aria-controls="searchClassic"
                                      aria-haspopup="true"
                                      aria-expanded="false"
                                      data-unfold-target="#searchClassic"
                                      data-unfold-type="css-animation"
                                      data-unfold-duration="300"
                                      data-unfold-delay="300"
                                      data-unfold-hide-on-scroll="true"
                                      data-unfold-animation-in="slideInUp"
                                      data-unfold-animation-out="fadeOut">
                                      <span class="ec ec-search"></span>
                                  </a>

                                  <!-- Input -->
                                  <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                      <form class="js-focus-state input-group px-3">
                                          <input class="form-control" type="search" placeholder="Search Product">
                                          <div class="input-group-append">
                                              <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                          </div>
                                      </form>
                                  </div>
                                  <!-- End Input -->
                              </li>
                              <!-- End Search -->
                              <li class="col d-none d-xl-block"><a href="../shop/compare.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Compare"><i class="font-size-22 ec ec-compare"></i></a></li>
                              <li class="col d-none d-xl-block"><a href="../shop/wishlist.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li>
                              <li class="col d-xl-none px-2 px-sm-3"><a href="../shop/my-account.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="My Account"><i class="font-size-22 ec ec-user"></i></a></li>
                              <li class="col pr-xl-0 px-2 px-sm-3">
                                  <a href="../shop/cart.html" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                      <i class="font-size-22 ec ec-shopping-bag"></i>
                                      <span class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">2</span>
                                      <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">$1785.00</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <!-- End Header Icons -->
              </div>
          </div>
      </div>
      <!-- End Logo and Menu -->

      <!-- Vertical-and-Search-Bar -->
      <div class="d-none d-xl-block bg-primary">
          <div class="container">
              <div class="row align-items-stretch min-height-50">
                  <!-- Vertical Menu -->
                  <div class="col-md-auto d-none d-xl-flex align-items-end">
                      <div class="max-width-270 min-width-270">
                          <!-- Basics Accordion -->
                          <div id="basicsAccordion">
                              <!-- Card -->
                              <div class="card border-0 rounded-0">
                                  <div class="card-header bg-primary rounded-0 card-collapse border-0" id="basicsHeadingOne">
                                      <button type="button" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                          data-toggle="collapse"
                                          data-target="#basicsCollapseOne"
                                          aria-expanded="true"
                                          aria-controls="basicsCollapseOne">
                                          <span class="pl-1 text-gray-90">Bütün Kateqoriyalar</span>
                                          <span class="text-gray-90 ml-3">
                                              <span class="ec ec-arrow-down-search"></span>
                                          </span>
                                      </button>
                                  </div>
                                  <div id="basicsCollapseOne" class="collapse vertical-menu v1"
                                      aria-labelledby="basicsHeadingOne"
                                      data-parent="#basicsAccordion">
                                      <div class="card-body p-0">
                                          <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                              <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                  <ul class="navbar-nav u-header__navbar-nav border-primary border-top-0">
                                                      <li class="nav-item u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a href="#" class="nav-link u-header__nav-link font-weight-bold">Value of the Day</a>
                                                      </li>
                                                      <li class="nav-item u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a href="#" class="nav-link u-header__nav-link font-weight-bold">Top 100 Offers</a>
                                                      </li>
                                                      <li class="nav-item u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a href="#" class="nav-link u-header__nav-link font-weight-bold">New Arrivals</a>
                                                      </li>
                                                      <!-- Nav Item MegaMenu -->
                                                      <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                          data-event="hover"
                                                          data-animation-in="slideInUp"
                                                          data-animation-out="fadeOut"
                                                          data-position="left">
                                                          <a id="basicMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Computers & Accessories</a>

                                                          <!-- Nav Item - Mega Menu -->
                                                          <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu">
                                                              <div class="vmm-bg">
                                                                  <img class="img-fluid" src="../../assets/img/500X400/img1.png" alt="Image Description">
                                                              </div>
                                                              <div class="row u-header__mega-menu-wrapper">
                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Computers & Accessories</span>
                                                                      <ul class="u-header__sub-menu-nav-group mb-3">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Computers & Accessories</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Laptops, Desktops & Monitors</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Printers & Ink</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Networking & Internet Devices</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Computer Accessories</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Software</a></li>
                                                                          <li>
                                                                              <a class="nav-link u-header__sub-menu-nav-link u-nav-divider border-top pt-2 flex-column align-items-start" href="#">
                                                                                  <div class="">All Electronics</div>
                                                                                  <div class="u-nav-subtext font-size-11 text-gray-30">Discover more products</div>
                                                                              </a>
                                                                          </li>
                                                                      </ul>
                                                                  </div>

                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Office & Stationery</span>
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Office & Stationery</a></li>
                                                                      </ul>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Nav Item - Mega Menu -->
                                                      </li>
                                                      <!-- End Nav Item MegaMenu-->
                                                      <!-- Nav Item MegaMenu -->
                                                      <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a id="basicMegaMenu1" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Cameras, Audio & Video</a>

                                                          <!-- Nav Item - Mega Menu -->
                                                          <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu1">
                                                              <div class="vmm-bg">
                                                                  <img class="img-fluid" src="../../assets/img/500X400/img4.png" alt="Image Description">
                                                              </div>
                                                              <div class="row u-header__mega-menu-wrapper">
                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Cameras & Photography</span>
                                                                      <ul class="u-header__sub-menu-nav-group mb-3">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Lenses</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Camera Accessories</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Security & Surveillance</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Binoculars & Telescopes</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Camcorders</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Software</a></li>
                                                                          <li>
                                                                              <a class="nav-link u-header__sub-menu-nav-link u-nav-divider border-top pt-2 flex-column align-items-start" href="#">
                                                                                  <div class="">All Electronics</div>
                                                                                  <div class="u-nav-subtext font-size-11 text-gray-30">Discover more products</div>
                                                                              </a>
                                                                          </li>
                                                                      </ul>
                                                                  </div>

                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Audio & Video</span>
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Audio & Video</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Headphones & Speakers</a></li>
                                                                      </ul>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Nav Item - Mega Menu -->
                                                      </li>
                                                      <!-- End Nav Item MegaMenu-->
                                                      <!-- Nav Item MegaMenu -->
                                                      <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a id="basicMegaMenu2" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Mobiles & Tablets</a>

                                                          <!-- Nav Item - Mega Menu -->
                                                          <div class="hs-mega-menu vmm-tfw u-header__sub-menu vmm-bg-extended" aria-labelledby="basicMegaMenu2">
                                                              <div class="vmm-bg">
                                                                  <img class="img-fluid" src="../../assets/img/500X400/img3.png" alt="Image Description">
                                                              </div>
                                                              <div class="row u-header__mega-menu-wrapper">
                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Mobiles & Tablets</span>
                                                                      <ul class="u-header__sub-menu-nav-group mb-3">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Mobile Phones</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Smartphones</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Refurbished Mobiles</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link border-top pt-2" href="#">All Mobile Accessories</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Cases & Covers</a></li>
                                                                          <li>
                                                                              <a class="nav-link u-header__sub-menu-nav-link u-nav-divider border-top pt-2 flex-column align-items-start" href="#">
                                                                                  <div class="">All Electronics</div>
                                                                                  <div class="u-nav-subtext font-size-11 text-gray-30">Discover more products</div>
                                                                              </a>
                                                                          </li>
                                                                      </ul>
                                                                  </div>

                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Tablets</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Tablet Accessories</a></li>
                                                                      </ul>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Nav Item - Mega Menu -->
                                                      </li>
                                                      <!-- End Nav Item MegaMenu-->
                                                      <!-- Nav Item MegaMenu -->
                                                      <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a id="basicMegaMenu3" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Movies, Music & Video</a>

                                                          <!-- Nav Item - Mega Menu -->
                                                          <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu3">
                                                              <div class="vmm-bg">
                                                                  <img class="img-fluid" src="../../assets/img/500X400/img2.png" alt="Image Description">
                                                              </div>
                                                              <div class="row u-header__mega-menu-wrapper">
                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Movies & TV Shows</span>
                                                                      <ul class="u-header__sub-menu-nav-group mb-3">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Movies & TV Shows</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All English</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link border-bottom pb-3" href="#">All Hindi</a></li>
                                                                      </ul>
                                                                      <span class="u-header__sub-menu-title">Video Games</span>
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">PC Games</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Consoles</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Accessories</a></li>
                                                                      </ul>
                                                                  </div>

                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Music</span>
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Music</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Indian Classical</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Musical Instruments</a></li>
                                                                      </ul>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Nav Item - Mega Menu -->
                                                      </li>
                                                      <!-- End Nav Item MegaMenu-->
                                                      <!-- Nav Item MegaMenu -->
                                                      <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a id="basicMegaMenu4" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">TV & Audio</a>

                                                          <!-- Nav Item - Mega Menu -->
                                                          <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu4">
                                                              <div class="vmm-bg">
                                                                  <img class="img-fluid" src="../../assets/img/500X400/img5.png" alt="Image Description">
                                                              </div>
                                                              <div class="row u-header__mega-menu-wrapper">
                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Audio & Video</span>
                                                                      <ul class="u-header__sub-menu-nav-group mb-3">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Audio & Video</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Televisions</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Headphones</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Speakers</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Audio & Video Accessories</a></li>
                                                                          <li>
                                                                              <a class="nav-link u-header__sub-menu-nav-link u-nav-divider border-top pt-2 flex-column align-items-start" href="#">
                                                                                  <div class="">Electro Home Appliances</div>
                                                                                  <div class="u-nav-subtext font-size-11 text-gray-30">Available in select cities</div>
                                                                              </a>
                                                                          </li>
                                                                      </ul>
                                                                  </div>

                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Music</span>
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Televisions</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Headphones</a></li>
                                                                      </ul>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Nav Item - Mega Menu -->
                                                      </li>
                                                      <!-- End Nav Item MegaMenu-->
                                                      <!-- Nav Item MegaMenu -->
                                                      <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a id="basicMegaMenu5" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Watches & Eyewear</a>

                                                          <!-- Nav Item - Mega Menu -->
                                                          <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu5">
                                                              <div class="vmm-bg">
                                                                  <img class="img-fluid" src="../../assets/img/500X400/img6.png" alt="Image Description">
                                                              </div>
                                                              <div class="row u-header__mega-menu-wrapper">
                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Watches</span>
                                                                      <ul class="u-header__sub-menu-nav-group mb-3">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Watches</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Men's Watches</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Women's Watches</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Premium Watches</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Deals on Watches</a></li>
                                                                      </ul>
                                                                  </div>

                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Eyewear</span>
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Men's Sunglasses</a></li>
                                                                      </ul>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Nav Item - Mega Menu -->
                                                      </li>
                                                      <!-- End Nav Item MegaMenu-->
                                                      <!-- Nav Item MegaMenu -->
                                                      <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                          data-event="hover"
                                                          data-position="left">
                                                          <a id="basicMegaMenu3" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Car, Motorbike & Industrial</a>

                                                          <!-- Nav Item - Mega Menu -->
                                                          <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu3">
                                                              <div class="vmm-bg">
                                                                  <img class="img-fluid" src="../../assets/img/500X400/img7.png" alt="Image Description">
                                                              </div>
                                                              <div class="row u-header__mega-menu-wrapper">
                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Car & Motorbike</span>
                                                                      <ul class="u-header__sub-menu-nav-group mb-3">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Cars & Bikes</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Car & Bike Care</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link border-bottom pb-3" href="#">Lubricants</a></li>
                                                                      </ul>
                                                                      <span class="u-header__sub-menu-title">Shop for Bike</span>
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Helmets & Gloves</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Bike Parts</a></li>
                                                                      </ul>
                                                                  </div>

                                                                  <div class="col mb-3 mb-sm-0">
                                                                      <span class="u-header__sub-menu-title">Industrial Supplies</span>
                                                                      <ul class="u-header__sub-menu-nav-group">
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">All Industrial Supplies</a></li>
                                                                          <li><a class="nav-link u-header__sub-menu-nav-link" href="#">Lab & Scientific</a></li>
                                                                      </ul>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Nav Item - Mega Menu -->
                                                      </li>
                                                      <!-- End Nav Item MegaMenu-->
                                                      <!-- Nav Item -->
                                                      <li class="nav-item hs-has-sub-menu u-header__nav-item"
                                                          data-event="click"
                                                          data-animation-in="slideInUp"
                                                          data-animation-out="fadeOut"
                                                          data-position="left">
                                                          <a id="homeMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="homeSubMenu">Accessories</a>

                                                          <!-- Home - Submenu -->
                                                          <ul id="homeSubMenu" class="hs-sub-menu u-header__sub-menu animated hs-position-left fadeOut" aria-labelledby="homeMegaMenu" style="min-width: 230px; display: none;">
                                                              <!-- Home-v1 -->
                                                              <li class="hs-has-sub-menu">
                                                                  <a class="nav-link u-header__sub-menu-nav-link " href="index.html">Home-v1</a>
                                                              </li>
                                                              <!-- End Home-v1 -->

                                                              <!-- Home-v2 -->
                                                              <li class="hs-has-sub-menu">
                                                                  <a class="nav-link u-header__sub-menu-nav-link " href="home-v2.html">Home-v2</a>
                                                              </li>
                                                              <!-- End Home-v2 -->

                                                              <!-- Home-v3 -->
                                                              <li class="hs-has-sub-menu">
                                                                  <a class="nav-link u-header__sub-menu-nav-link " href="home-v3.html">Home-v3</a>
                                                              </li>
                                                              <!-- End Home-v3 -->

                                                              <!-- Home-v4 -->
                                                              <li class="hs-has-sub-menu">
                                                                  <a class="nav-link u-header__sub-menu-nav-link " href="home-v4.html">Home-v4</a>
                                                              </li>
                                                              <!-- End Home-v4 -->
                                                          </ul>
                                                          <!-- End Home - Submenu -->
                                                      </li>
                                                      <!-- End Nav Item -->
                                                  </ul>
                                              </div>
                                          </nav>
                                      </div>
                                  </div>
                              </div>
                              <!-- End Card -->
                          </div>
                          <!-- End Basics Accordion -->
                      </div>
                  </div>
                  <!-- End Vertical Menu -->
                  <!-- Search bar -->
                  <div class="col align-self-center">
                      <!-- Search-Form -->
                      <form class="js-focus-state">
                          <label class="sr-only" for="searchProduct">Axtar</label>
                          <div class="input-group">
                              <input type="email" class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill" name="email" id="searchProduct" placeholder="Məhsul axtar.." aria-label="Search for Products" aria-describedby="searchProduct1" required>
                              <div class="input-group-append">
                                  <!-- Select -->
                                  <select class="js-select selectpicker dropdown-select custom-search-categories-select"
                                      data-style="btn height-40 text-gray-60 font-weight-normal border-0 rounded-0 bg-white px-5 py-2">
                                      <option value="one" selected>Bütün Kateqoriyalar</option>
                                      <option value="two">Kateqoriya 1</option>
                                      <option value="three">Kateqoriya 2</option>
                                      <option value="four">Kateqoriya 3</option>
                                  </select>
                                  <!-- End Select -->
                                  <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="button" id="searchProduct1">
                                      <span class="ec ec-search font-size-24"></span>
                                  </button>
                              </div>
                          </div>
                      </form>
                      <!-- End Search-Form -->
                  </div>
                  <!-- End Search bar -->
                  <!-- Header Icons -->
                  <div class="col-md-auto align-self-center">
                      <div class="d-flex">
                          <ul class="d-flex list-unstyled mb-0">
                              <li class="col"><a href="../shop/compare.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Qarşılaşdır"><i class="font-size-22 ec ec-compare"></i></a></li>
                              <li class="col"><a href="../shop/wishlist.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="İstək siyahısı"><i class="font-size-22 ec ec-favorites"></i></a></li>
                              <li class="col pr-0">
                                  <a href="../shop/cart.html" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Səbət">
                                      <i class="font-size-22 ec ec-shopping-bag"></i>
                                      <span class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">2</span>
                                      <span class="font-weight-bold font-size-16 text-gray-90 ml-3">₼1785.00</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <!-- End Header Icons -->
              </div>
          </div>
      </div>
      <!-- End Vertical-and-secondary-menu -->
  </div>
</header>