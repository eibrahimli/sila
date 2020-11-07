<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta content="" name="author">
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
  <link rel='stylesheet' type='text/css' href='{{ asset("backend/assets/css/datepicker.css") }}'>

  <link rel='stylesheet' href='{{ asset("backend/css/style.css") }}'>

  <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
  <link rel='stylesheet' href='{{ asset("backend/fonts/jost/jost.css") }}'>
  <!--Material Icons-->
  <link rel='stylesheet' type='text/css' href='{{ asset("backend/fonts/materialdesignicons/materialdesignicons.min.css") }}'>
  <!--Bootstrap + atmos Admin CSS-->
  <link rel='stylesheet' type='text/css' href='{{ asset("backend/css/atmos.min.css") }}'>
  <!-- Additional library for page -->


</head>

<body class="jumbo-page">

  <main class="admin-main  bg-pattern">
    <div class="container">
      <div class="row m-h-100 ">
        <div class="col-md-8 col-lg-4  m-auto">
          <div class="card shadow-lg ">
            <div class="card-body ">
              <div class=" padding-box-2 ">
                <div class="text-center p-b-20 pull-up-sm">

                  <div class="avatar avatar-lg">
                    <span class="avatar-title rounded-circle bg-pink"> <i class="mdi mdi-key-change"></i> </span>
                  </div>

                </div>
                <h3 class="text-center">Şifrənizi sıfırlayın</h3>
                @if(session('status'))
                <div class="alert alert-border-success  alert-dismissible fade show" role="alert">
                  <div class="d-flex">
                    <div class="icon">
                      <i class="icon mdi mdi-check-circle-outline"></i>
                    </div>
                    <div class="content">
                      <strong>Uğurlu!</strong> {{ session('status') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  </div>
                </div>
                @endif
                <form action="{{ route('admin.password.email') }}" method="post">
                  @csrf
                  <div class="form-group">
                    <label>Email</label>

                    <div class="input-group input-group-flush mb-3">
                      <input type="email" name="email" class="form-control form-control-prepended @error('email') is-invalid @enderror" placeholder="sizinmail@nümunə.com">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <span class="mdi mdi-email"></span>
                        </div>
                      </div>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <p class="small">
                      Saytımızda qeydiyyatda olan e-poçt ünvanınıza şifrənizi sıfırlamaq üçün
                      e-poçt göndərəciyik
                    </p>
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn text-uppercase btn-block  btn-primary">
                      Sıfırla
                    </button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
</body>

</html>
