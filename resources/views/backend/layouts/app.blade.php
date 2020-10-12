<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta content="" name="Elvir Ibrahimli">
  <meta name="crsf-token" content="{{ csrf_token() }}">
  <script>
    window.Laravel = {
      csrfToken: "{{ csrf_token() }}"
      , base_url: "{{ url('') }}"
    }

  </script>
  <meta content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons" name="description">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="website">
  <meta property="og:title" content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons">
  <meta property="og:description" content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons">
  <meta property="og:image" content="https://cdn.dribbble.com/users/180706/screenshots/5424805/the_sceens_-_mobile_perspective_mockup_3_-_by_tranmautritam.jpg">
  <meta property="og:site_name" content="atlas ">
  <title>Atmos Admin Panel- Bootstrap 4 Based Admin Panel</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('backend/img/logo.png') }}">
  <link rel="icon" href="{{ asset('backend/img\logo.png') }}" type="image/png" sizes="16x16">
  <link rel='stylesheet' href='{{ asset("backend/vendor/pace/pace.css") }}'>
  <script src='{{ asset("backend/vendor/pace/pace.min.js") }}'></script>
  <!--vendors-->
  <link rel='stylesheet' type='text/css' href='{{ asset("backend/css/datepicker.css") }}'>

  <link rel='stylesheet' href='{{ asset("backend/css/style.css") }}'>

  <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
  <link rel='stylesheet' href='{{ asset("backend/fonts/jost/jost.css") }}'>
  <!--Material Icons-->
  <link rel='stylesheet' type='text/css' href='{{ asset("backend/fonts/materialdesignicons/materialdesignicons.min.css") }}'>
  <!--Bootstrap + atmos Admin CSS-->
  <link rel='stylesheet' type='text/css' href='{{ asset("backend/css/atmos.min.css") }}'>
  <!-- Additional library for page -->

</head>

<body class="sidebar-pinned page-home">
  @include('backend.inc.nav')
  <main class="admin-main" id="app">
    <!--site header begins-->
    <header class="admin-header">

      <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>

      <nav class=" mr-auto my-auto">
        <ul class="nav align-items-center">

          <li class="nav-item">
            <a class="nav-link" data-target="#siteSearchModal" data-toggle="modal" href="#">
              <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
            </a>
          </li>
        </ul>
      </nav>
      <nav class=" ml-auto">
        <ul class="nav align-items-center">
          <li class="nav-item">
            <div class="dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                <span class="notification-counter"></span>
              </a>

              <div class="dropdown-menu notification-container dropdown-menu-right">
                <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                  <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                  <span class="h5 m-0">Notifications</span>
                  <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                </div>
                <div class="notification-events bg-gray-300">
                  <div class="text-overline m-b-5">today</div>
                  <a href="#" class="d-block m-b-10">
                    <div class="card">
                      <div class="card-body"> <i class="mdi mdi-circle text-success"></i> All
                        systems operational.</div>
                    </div>
                  </a>
                  <a href="#" class="d-block m-b-10">
                    <div class="card">
                      <div class="card-body"> <i class="mdi mdi-upload-multiple "></i> File upload
                        successful.</div>
                    </div>
                  </a>
                  <a href="#" class="d-block m-b-10">
                    <div class="card">
                      <div class="card-body">
                        <i class="mdi mdi-cancel text-danger"></i> Your holiday has been denied
                      </div>
                    </div>
                  </a>


                </div>

              </div>
            </div>
          </li>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-sm avatar-online">
                <span class="avatar-title rounded-circle bg-dark">V</span>

              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right">
              <a class="dropdown-item" href="#"> Add Account</a>
              <a class="dropdown-item" href="#"> Reset Password</a>
              <a class="dropdown-item" href="#"> Help </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> Çıxış Et</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>

        </ul>

      </nav>
    </header>
    <!--site header ends -->
    <section class="admin-content">
      @yield('content')
    </section>
  </main>

  <div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body p-all-0" id="site-search">
          <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots">
            <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

            <div class="container-fluid">
              <div class="col-md-10 p-t-10 m-auto">
                <input type="search" placeholder="Search Something" class=" search form-control form-control-lg">
              </div>
            </div>
          </div>
          <div class="">
            <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
              results
            </div>
            <div class="list-group list  ">


              <div class="list-group-item d-flex  align-items-center">
                <div class="m-r-20">
                  <div class="avatar avatar-sm "><img class="avatar-img rounded-circle" src="assets\img\users\user-3.jpg" alt="user-image"></div>
                </div>
                <div class="">
                  <div class="name">Eric Chen</div>
                  <div class="text-muted">Developer</div>
                </div>


              </div>
              <div class="list-group-item d-flex  align-items-center">
                <div class="m-r-20">
                  <div class="avatar avatar-sm "><img class="avatar-img rounded-circle" src="assets\img\users\user-4.jpg" alt="user-image"></div>
                </div>
                <div class="">
                  <div class="name">Sean Valdez</div>
                  <div class="text-muted">Marketing</div>
                </div>


              </div>
              <div class="list-group-item d-flex  align-items-center">
                <div class="m-r-20">
                  <div class="avatar avatar-sm "><img class="avatar-img rounded-circle" src="assets\img\users\user-8.jpg" alt="user-image"></div>
                </div>
                <div class="">
                  <div class="name">Marie Arnold</div>
                  <div class="text-muted">Developer</div>
                </div>


              </div>
              <div class="list-group-item d-flex  align-items-center">
                <div class="m-r-20">
                  <div class="avatar avatar-sm ">
                    <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-pdf"></i>
                    </div>
                  </div>
                </div>
                <div class="">
                  <div class="name">SRS Document</div>
                  <div class="text-muted">25.5 Mb</div>
                </div>


              </div>
              <div class="list-group-item d-flex  align-items-center">
                <div class="m-r-20">
                  <div class="avatar avatar-sm ">
                    <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-document-box"></i></div>
                  </div>
                </div>
                <div class="">
                  <div class="name">Design Guide.pdf</div>
                  <div class="text-muted">9 Mb</div>
                </div>


              </div>
              <div class="list-group-item d-flex  align-items-center">
                <div class="m-r-20">
                  <div class="avatar avatar-sm ">
                    <div class="avatar avatar-sm  ">
                      <div class="avatar-title bg-primary rounded"><i class="mdi mdi-24px mdi-code-braces"></i></div>
                    </div>
                  </div>
                </div>
                <div class="">
                  <div class="name">response.json</div>
                  <div class="text-muted">15 Kb</div>
                </div>


              </div>
              <div class="list-group-item d-flex  align-items-center">
                <div class="m-r-20">
                  <div class="avatar avatar-sm ">
                    <div class="avatar avatar-sm ">
                      <div class="avatar-title bg-info rounded"><i class="mdi mdi-24px mdi-file-excel"></i></div>
                    </div>
                  </div>
                </div>
                <div class="">
                  <div class="name">June Accounts.xls</div>
                  <div class="text-muted">6 Mb</div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <script src='{{ asset("backend/js/script.js") }}'></script>
  <!--page specific scripts for demo-->

  <!--Additional Page includes-->
  <script src='{{ asset("backend/vendor/apexchart/apexcharts.min.js") }}'></script>
  <!--chart data for current dashboard-->
  <script src='{{ asset("backend/js/dashboard.js") }}'></script>
  @yield('js')
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
