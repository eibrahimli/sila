<aside class="admin-sidebar">
  <div class="admin-sidebar-brand">
    <!-- begin sidebar branding-->
    <img class="admin-brand-logo" src="{{ asset('backend/img/logo.png') }}" width="40" alt="sila Logo">
    <span class="admin-brand-content font-secondary"><a href='{{ route('index') }}'> Sila Express</a></span>
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
        <a href="{{ route('seller.index') }}" class="menu-link">
          <span class="menu-label">
            <span class="menu-name">Anasəhifə</span>

          </span>
          <span class="menu-icon">
            {{-- <span class="icon-badge badge-success badge badge-pill">4</span>--}}
            <i class="icon-placeholder mdi mdi-shape-outline "></i>
          </span>
        </a>
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
            <a href='{{ route('seller.product.index') }}' class='menu-link'>
              <span class="menu-label">
                <span class="menu-name">Aktiv Olan Məhsullar</span>
              </span>
              <span class="menu-icon">
                <i class="icon-placeholder mdi mdi-format-list-checks">
                </i>
              </span>
            </a>
          </li>
          <li class="menu-item ">
            <a href='{{ route('seller.product.notActiveIndex') }}' class='menu-link'>
              <span class="menu-label">
                <span class="menu-name">Aktiv Olmayan Məhsullar</span>
              </span>
              <span class="menu-icon">
                <i class="icon-placeholder mdi mdi-format-list-bulleted">
                </i>
              </span>
            </a>
          </li>
          <li class="menu-item ">
            <a href='{{ route('seller.product.create') }}' class='menu-link'>
              <span class="menu-label">
                <span class="menu-name">Yeni Məhsul</span>
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
        <a href="{{ route('seller.edit',auth()->id()) }}" class="menu-link">
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
