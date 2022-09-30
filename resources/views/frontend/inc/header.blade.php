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
              @guest
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
              @endguest
              {{-- <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                <a href="#" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Sifarişim hardadır?</a>
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
                  <a id="sidebarNavToggler" href="{{ route('user.dashboard', auth()->id()) }}" role="button" class="u-header-topbar__nav-link">
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
                                  </li>
                                  <!-- End Home -->

                                  <!-- About us -->
                                  <li class="nav-item u-header__nav-item">
                                      <a class="nav-link u-header__nav-link" href="#">Haqqımızda</a>
                                  </li>
                                  <!-- End About us -->

                                  <!-- Contact Us -->
                                  <li class="nav-item u-header__nav-item">
                                      <a class="nav-link u-header__nav-link" href="#">Əlaqə</a>
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
                                      <form class="js-focus-state input-group px-3" method="POST" action="{{ route('search') }}">
                                          @csrf
                                          <input class="form-control" type="search" placeholder="Search Product">
                                          <div class="input-group-append">
                                              <button class="btn btn-primary px-3" type="submit"><i class="font-size-18 ec ec-search"></i></button>
                                          </div>
                                      </form>
                                  </div>
                                  <!-- End Input -->
                              </li>
                              <!-- End Search -->
                              <li class="col d-xl-none px-2 px-sm-3">
                                <a href="#" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Mənim hesabım"><i class="font-size-22 ec ec-user"></i></a>
                              </li>
                              <li class="col pr-xl-0 px-2 px-sm-3">
                                  <a href="{{ route('cart.index') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Səbət">
                                      <i class="font-size-22 ec ec-shopping-bag"></i>
                                      <span class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">{{ count($cart) }}</span>
                                      <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">₼{{ $total }}</span>
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
                                                  @foreach($categories as $category)
                                                    @if(count($category->categories) > 0)
                                                      <!-- Nav Item MegaMenu -->
                                                        <li class="nav-item hs-has-mega-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut" data-position="left">
                                                          <a id="basicMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="{{ $category->path() }}" aria-haspopup="true" aria-expanded="false">{{ $category->name }}</a>
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
                  <!-- Search bar -->
                  <div class="col align-self-center">
                      <!-- Search-Form -->
                      <form method="POST" action="{{ route('search') }}">
                        @csrf
                          <label class="sr-only" for="searchProduct">Axtar</label>
                          <div class="input-group">
                              <input type="text" class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill" name="query" id="searchProduct" placeholder="Məhsul axtar.." aria-label="Search for Products" aria-describedby="searchProduct1" required>
                              <div class="input-group-append">
                                  <!-- Select -->
                                  <select name="category_id" class="js-select selectpicker dropdown-select custom-search-categories-select"
                                      data-style="btn height-40 text-gray-60 font-weight-normal border-0 rounded-0 bg-white px-5 py-2">
                                      <option value="all" selected>Bütün Kateqoriyalar</option>
                                      @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{$category->name}}</option>
                                      @endforeach
                                  </select>
                                  <!-- End Select -->
                                  <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="submit">
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
                              <cart ref="cart" cart="{{ route('cart.index') }}"></cart>
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
