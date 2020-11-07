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
  <title>Sila Express | Email adresinizi təsdiq edin</title>
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
                <h3 class="text-center">Emailinizi təsdiq edin</h3>
                @if(session('status'))
                <div class="alert alert-border-success alert-dismissible fade show" role="alert">
                  <div class="d-flex">
                    <div class="icon">
                      <i class="icon mdi mdi-check-circle-outline"></i>
                    </div>
                    <div class="content">
                      <strong>Uğurlu!</strong> {{session('status')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  </div>
                </div>
                @elseif(session('statusOk'))
                  <div class="alert alert-border-success alert-dismissible fade show" role="alert">
                    <div class="d-flex">
                      <div class="icon">
                        <i class="icon mdi mdi-check-circle-outline"></i>
                      </div>
                      <div class="content">
                        <strong>Uğurlu!</strong> {{session('statusOk')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                    </div>
                  </div>
                @elseif($mes)
                  <div class="alert alert-border-warning alert-dismissible fade show" role="alert">
                    <div class="d-flex">
                      <div class="icon">
                        <i class="icon mdi mdi-check-circle-outline"></i>
                      </div>
                      <div class="content">
                        <strong>Xəta!</strong> {{$mes}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                    </div>
                  </div>
                @endif
                <form action="{{ route('verification.send') }}" method="post">
                  @csrf
                  <div class="form-group">
                    <button type="submit" class="btn btn-block  btn-primary">
                      Yenidən göndər
                    </button>
                  </div>
                </form>
                <p class="text-center">
                  <a href='{{ route("index") }}' class='text-underline'>Anasəhifə</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src='{{ asset("backend/js/script.js") }}'></script>
  <!--page specific scripts for demo-->
</body>

</html>
