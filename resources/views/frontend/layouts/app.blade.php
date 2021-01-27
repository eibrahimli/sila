<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>
        @if(url()->current() == route('index'))
            {{ $setting->title }}
        @else
            {{ $setting->title }} | @yield('title')
        @endif
    </title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/favicon.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    @yield('styles')
    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="{{ asset('frontend/css/theme.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <script>
        window.Laravel = {
          csrfToken: "{{ csrf_token() }}"
          , base_url: "{{ url('') }}"
        }
    
      </script>
</head>
    <body>
        <div id="app">
            <!-- ========== HEADER ========== -->
        @if(url()->current() == route('index'))
            @include('frontend.inc.indexheader',['categories' => $categories])
        @else
            @include('frontend.inc.header')
        @endif
        <!-- ========== END HEADER ========== -->

            <!-- ========== MAIN CONTENT ========== -->
            <main id="content" role="main">
                @yield('content')
            </main>
            <!-- ========== END MAIN CONTENT ========== -->

            <!-- ========== FOOTER ========== -->
        @include('frontend.inc.footer')
        <!-- ========== END FOOTER ========== -->

            <!-- ========== SECONDARY CONTENTS ========== -->
            <!-- Account Sidebar Navigation -->
        @if(!auth()->check())
            @include('frontend.inc.accountSidebar')
        @endif
        <!-- End Account Sidebar Navigation -->
            <!-- ========== END SECONDARY CONTENTS ========== -->
            <!-- Sidebar Navigation -->
        @yield('navigationSidebar')
        <!-- End Sidebar Navigation -->

        </div>

            <!-- Go to Top -->
            <a class="js-go-to u-go-to" href="#"
               data-position='{"bottom": 15, "right": 15 }'
               data-type="fixed"
               data-offset-top="400"
               data-compensation="#header"
               data-show-effect="slideInUp"
               data-hide-effect="slideOutDown">
                <span class="fas fa-arrow-up u-go-to__inner"></span>
            </a>
            <!-- End Go to Top -->

            <!-- JS Global Compulsory -->
            <script src="{{ asset('frontend/vendor/jquery/dist/jquery.min.js') }}"></script>
            <script src="{{ asset('frontend/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
            <script src="{{ asset('frontend/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
            <script src="{{ asset('frontend/vendor/bootstrap/bootstrap.min.js') }}"></script>

            @yield('scripts')

            <script src="{{ asset('js/frontend.js') }}"></script>


    </body>
</html>
