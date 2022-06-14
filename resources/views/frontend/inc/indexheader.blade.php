<header id="header" class="u-header u-header-left-aligned-nav">
  <div class="u-header__section">
    <!-- Topbar -->
    <div class="u-header-topbar py-2 d-none d-xl-block">
      <div class="container">
        <div class="d-flex align-items-center">
          <div class="topbar-left">
            <a href="{{ route('index') }}" class="text-gray-110 font-size-13 hover-on-dark">Azərbaycanın ən böyük onlayn satış
              saytına xoş gəlmisiniz</a>
          </div>
          <div class="topbar-right ml-auto">
            <ul class="list-inline mb-0">
              {{-- @guest
                <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                  <div class="position-relative">
                    <a id="sellerDropdownInvoker" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" role="button" aria-controls="sellerDropdown" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#sellerDropdown" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">                  
                      <span class="d-none d-sm-inline-flex align-items-center"><span class="mr-1 font-weight-bold">₼</span> Sila Express - də Sat</span>
                    </a>
                    <div id="sellerDropdown" class="dropdown-menu dropdown-unfold" aria-placeholder="Sila Express - də Sat" aria-labelledby="sellerDropdownInvoker">
                      <a href="{{ route('seller.login') }}" class="dropdown-item active">Satıcı Girişi</a>
                      <a href="{{ route('seller.register') }}" class="dropdown-item active">Satıcı Qeydiyyatı</a>
                    </div>
                  </div>
                </li>
              @endguest --}}
              {{-- <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                <a href="#" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Sifarişim hardadır?</a>
              </li> --}}
              {{-- <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
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
              </li> --}}
              <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                <!-- Account Sidebar Toggle Button -->
                @guest
                <a id="sidebarNavToggler" href="javascript:;" role="button" class="u-header-topbar__nav-link" aria-controls="sidebarContent" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent" data-unfold-type="css-animation" data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight" data-unfold-duration="500">
                  <i class="ec ec-user mr-1"></i> Qeydiyyat <span class="text-gray-50">və ya</span>
                  Giriş
                </a>
                @endguest
                @auth
                  @if(auth()->user()->role == 'seller')
                  <a id="sidebarNavToggler" href="{{ route('seller.index') }}" role="button" class="u-header-topbar__nav-link">
                    <i class="ec ec-user mr-1"></i> Satıcı Paneli </a> <span style="font-size: 0.813rem" class="text-gray-50">və ya</span>
                  @else
                  <a id="sidebarNavToggler" href="{{ url('') }}" role="button" class="u-header-topbar__nav-link">
                    <i class="ec ec-user mr-1"></i> {{ auth()->user()->email }} </a> <span style="font-size: 0.813rem" class="text-gray-50">və ya</span>
                  @endif
                  <a style="cursor: pointer" role="button" class="u-header-topbar__nav-link" onclick="document.getElementById('formLogOut').submit()">Çıxış</a>

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

    <!-- Logo-Search-header-icons -->
    <div class="py-2 py-xl-5 bg-primary-down-lg">
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
              <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0" aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
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
                          @foreach($categories as $category)
                            @if(count($category->categories) > 0)
                              <li class="u-has-submenu u-header-collapse__submenu">
                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarComputersCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarComputersCollapse">
                                  {{ $category->name }}
                                </a>

                                <div id="headerSidebarComputersCollapse" class="collapse" data-parent="#headerSidebarContent">
                                  <ul class="u-header-collapse__nav-list">
                                    <li><span class="u-header-sidebar__sub-menu-title">{{ $category->name }}</span>
                                    </li>
                                    @foreach($category->categories as $cat)
                                      <li class="">
                                        <a class="u-header-collapse__submenu-nav-link" href="{{ $cat->path() }}">{{ $cat->name }}</a>
                                      </li>
                                    @endforeach
                                  </ul>
                                </div>
                              </li>
                            @else
                              <li class="">
                                <a class="u-header-collapse__nav-link" href="{{ $category->path() }}">{{ $category->name }}</a>
                              </li>
                            @endif
                          @endforeach
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
                        <a class="u-header-sidebar__footer-link text-gray-90" href="#">Alıcı Razılaşması</a>
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
          <!-- Search Bar -->
          <div class="col d-none d-xl-block">
            <form class="js-focus-state" method="POST" action="{{ route("search") }}">
              @csrf
              <label class="sr-only" for="searchproduct">Axtar</label>
              <div class="input-group">
                <input type="text" class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-primary" name="query" id="searchproduct-item" placeholder="Məhsul Axtar" aria-label="Məhsul axtar" aria-describedby="searchProduct1" required>
                <div class="input-group-append">
                  <!-- Select -->
                  <select name="category_id" class="js-select selectpicker dropdown-select custom-search-categories-select" data-style="btn height-40 text-gray-60 font-weight-normal border-top border-bottom border-left-0 rounded-0 border-primary border-width-2 pl-0 pr-5 py-2">
                    <option value="all" selected>Bütün Kateqoriyalar</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{$category->name}}</option>
                    @endforeach
                  </select>
                  <!-- End Select -->
                  <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill" type="submit" id="searchProduct1">
                    <span class="ec ec-search font-size-24"></span>
                  </button>
                </div>
              </div>
            </form>
          </div>
          <!-- End Search Bar -->
          <!-- Header Icons -->
          <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
            <div class="d-inline-flex">
              <ul class="d-flex list-unstyled mb-0 align-items-center">
                <!-- Search -->
                <li class="col d-xl-none px-2 px-sm-3 position-static">
                  <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button" data-toggle="tooltip" data-placement="top" title="Axtar" aria-controls="searchClassic" aria-haspopup="true" aria-expanded="false" data-unfold-target="#searchClassic" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                    <span class="ec ec-search"></span>
                  </a>

                  <!-- Input -->
                  <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                    <form class="js-focus-state input-group px-3">
                      <input class="form-control" type="search" placeholder="Məhsul Axtar">
                      <div class="input-group-append">
                        <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                      </div>
                    </form>
                  </div>
                  <!-- End Input -->
                </li>
                <!-- End Search -->
                <li class="col d-xl-none px-2 px-sm-3">
                  @guest
                    <a href="{{ route('user.loginregister') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Mənim Hesabım">
                      <i class="font-size-22 ec ec-user"></i>
                    </a>
                  @endguest
                  @auth
                    @if(auth()->user()->role == 'seller')
                      <a href="{{ route('seller.index') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Satıcı Paneli">
                        <i class="font-size-22 ec ec-user"></i>
                      </a>
                    @else
                      <a href="{{ '#' }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Mənim Hesabım">
                        <i class="font-size-22 ec ec-user"></i>
                      </a>
                    @endif
                  @endauth
                </li>
                <!--Responsive Cart -->

                <li class="col pr-xl-0 px-2 px-sm-3 d-xl-none">
                  <a href="{{ route('cart.index') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Səbət">
                    <i class="font-size-22 ec ec-shopping-bag"></i>
                    <span class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12">{{ count($cart) ?? 0 }}</span>
                    <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">₼ {{ $total}}</span>
                  </a>
                </li>
                <!-- End of Responsive Cart -->
                <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">


                    <div id="basicDropdownHoverInvoker" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Səbət" aria-controls="basicDropdownHover" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#basicDropdownHover" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                      <i class="font-size-22 ec ec-shopping-bag"></i>
                      <span class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12">{{ count($cart) ?? 0 }}</span>
                      <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">₼{{ $total == 0 ? '0' : $total }}</span>
                    </div>
                    @if(count($cart) > 0)
                    <div id="basicDropdownHover" class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-3 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0" aria-labelledby="basicDropdownHoverInvoker">
                      <ul class="list-unstyled px-3 pt-3">
                        @foreach($cart as $sebet)
                          <li class="border-bottom pb-3 mb-3">
                            <div class="">
                              <ul class="list-unstyled row mx-n2">
                                <li class="px-2 col-auto">
                                  <img class="img-fluid" src="{{ $sebet->model->img }}" height="75" width="75" alt="Image Description">
                                </li>
                                <li class="px-2 col">
                                  <h5 class="text-blue font-size-14 font-weight-bold">{{ $sebet->title }}</h5>
                                  <span class="font-size-14">{{ $sebet->qty }} × ₼ {{ $sebet->subtotal }}</span>
                                </li>
                                <li class="px-2 col-auto">
                                  <a href="#" class="text-gray-90"><i class="ec ec-close-remove"></i></a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        @endforeach
                      </ul>
                      <div class="flex-center-between px-4 pt-2">
                        <a href="{{ route('cart.index') }}" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">Səbət</a>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5">Ödəmə</a>
                      </div>
                    </div>
                  @endif

                </li>
              </ul>
            </div>
          </div>
          <!-- End Header Icons -->
        </div>
      </div>
    </div>
    <!-- End Logo-Search-header-icons -->

    <!-- Vertical-and-secondary-menu -->
    <div class="d-none d-xl-block container">
      <div class="row">
        <!-- Vertical Menu -->
        <div class="col-md-auto d-none d-xl-block">
          <div class="max-width-270 min-width-270">
            <!-- Basics Accordion -->
            <div id="basicsAccordion">
              <!-- Card -->
              <div class="card border-0">
                <div class="card-header card-collapse border-0" id="basicsHeadingOne">
                  <button type="button" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90" data-toggle="collapse" data-target="#basicsCollapseOne" aria-expanded="true" aria-controls="basicsCollapseOne">
                    <span class="ml-0 text-gray-90 mr-2">
                      <span class="fa fa-list-ul"></span>
                    </span>
                    <span class="pl-1 text-gray-90">Bütün Kateqoriyalar</span>
                  </button>
                </div>
                <div id="basicsCollapseOne" class="collapse show vertical-menu" aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion">
                  <div class="card-body p-0">
                    <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                      <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                        <ul class="navbar-nav u-header__navbar-nav">
                          @foreach($categories as $category)
                              @if(count($category->categories) > 0)
                                <!-- Nav Item MegaMenu -->
                                  <li class="nav-item hs-has-mega-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut" data-position="left">
                                    <a id="basicMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">{{ $category->name }}</a>
                                    <!-- Nav Item - Mega Menu -->
                                    <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu">
                                      <div class="row u-header__mega-menu-wrapper">
                                        @foreach($category->categories->chunk(ceil(count($category->categories)/2)) as $chunk)
                                          <div class="col mb-3 mb-sm-0">
                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                              @foreach($chunk as $subcategory)
                                                <li>
                                                  <a class="nav-link u-header__sub-menu-nav-link" href="{{ $subcategory->path() }}">{{ $subcategory->name }}</a>
                                                </li>
                                              @endforeach
                                            </ul>
                                          </div>
                                        @endforeach
                                      </div>
                                    </div>
                                    <!-- End Nav Item - Mega Menu -->
                                  </li>
                                <!-- End Nav Item MegaMenu-->
                              @else
                                <li class="nav-item u-header__nav-item" data-event="hover" data-position="left">
                                  <a href="{{ $category->path() }}" class="nav-link u-header__nav-link">{{ $category->name }}</a>
                                </li>
                              @endif
                          @endforeach
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
        <!-- Secondary Menu -->
        <div class="col">
          <!-- Nav -->
          <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
            <!-- Navigation -->
            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
              <ul class="navbar-nav u-header__navbar-nav">

                <!-- Button -->
                <li class="nav-item u-header__nav-last-item">
                  <a class="text-gray-90" href="{{ route('index') }}">
                    ₼1000+ Sifarişdən sonra pulsuz çatdırılma...
                  </a>
                </li>
                <!-- End Button -->
              </ul>
            </div>
            <!-- End Navigation -->
          </nav>
          <!-- End Nav -->
        </div>
        <!-- End Secondary Menu -->
      </div>
    </div>
    <!-- End Vertical-and-secondary-menu -->
  </div>
</header>

