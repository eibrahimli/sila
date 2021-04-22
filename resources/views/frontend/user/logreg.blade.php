@extends('frontend.layouts.app')

@section('title', 'Sila Express | Giriş və qeydiyyat hissəsi')

@section('content')
<!-- breadcrumb -->
<div class="bg-gray-13 bg-md-transparent">
  <div class="container">
    <!-- breadcrumb -->
    <div class="my-md-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
          <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('index') }}">Anasəhifə</a></li>
          <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><span>Mənim Hesabım</span></li>
        </ol>
      </nav>
    </div>
    <!-- End breadcrumb -->
  </div>
</div>
<!-- End breadcrumb -->

<div class="container">
  <div class="mb-4">
    <h1 class="text-center">Mənim Hesabım</h1>
  </div>
  <div class="my-4 my-xl-8">
    <div class="row">
      <!-- Login vue component -->
        <login resetpath='{{ route('user.password.request') }}'></login>      
      <!-- End Login vue component -->
      <div class="col-md-1 d-none d-md-block">
        <div class="flex-content-center h-100">
          <div class="width-1 bg-1 h-100"></div>
          <div class="width-50 height-50 border border-color-1 rounded-circle flex-content-center font-italic bg-white position-absolute">və ya</div>
        </div>
      </div>
      <!-- Register vue component -->
        <register></register>
      <!-- End Register vue component -->
    </div>
  </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/vendor/font-awesome/css/fontawesome-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/font-electro.css') }}">

<link rel="stylesheet" href="{{ asset('frontend/vendor/animate.css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/hs-megamenu/src/hs.megamenu.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/fancybox/jquery.fancybox.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/slick-carousel/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">

@endsection

@section('scripts')
<!-- JS Implementing Plugins -->
<script src="{{ asset('frontend/vendor/appear.js') }}"></script>
<script src="{{ asset('frontend/vendor/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
<script src="{{ asset('frontend/vendor/svg-injector/dist/svg-injector.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/typed.js/lib/typed.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/slick-carousel/slick/slick.js') }}"></script>
<script src="{{ asset('frontend/vendor/appear.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

<!-- JS Electro -->
<script src="{{ asset('frontend/js/hs.core.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.countdown.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.header.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.hamburgers.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.unfold.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.focus-state.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.malihu-scrollbar.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.fancybox.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.onscroll-animation.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.slick-carousel.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.quantity-counter.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.range-slider.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.show-animation.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.svg-injector.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.scroll-nav.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.go-to.js') }}"></script>
<script src="{{ asset('frontend/js/components/hs.selectpicker.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
  $(window).on('load', function() {
    // initialization of HSMegaMenu component
    $('.js-mega-menu').HSMegaMenu({
      event: 'hover'
      , direction: 'horizontal'
      , pageContainer: $('.container')
      , breakpoint: 767.98
      , hideTimeOut: 0
    });
  });

  $(document).on('ready', function() {
    // initialization of header
    $.HSCore.components.HSHeader.init($('#header'));

    // initialization of animation
    $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

    // initialization of unfold component
    $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
      afterOpen: function() {
        $(this).find('input[type="search"]').focus();
      }
    });

    // initialization of HSScrollNav component
    $.HSCore.components.HSScrollNav.init($('.js-scroll-nav'), {
      duration: 700
    });

    // initialization of quantity counter
    $.HSCore.components.HSQantityCounter.init('.js-quantity');

    // initialization of popups
    $.HSCore.components.HSFancyBox.init('.js-fancybox');

    // initialization of countdowns
    var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
      yearsElSelector: '.js-cd-years'
      , monthsElSelector: '.js-cd-months'
      , daysElSelector: '.js-cd-days'
      , hoursElSelector: '.js-cd-hours'
      , minutesElSelector: '.js-cd-minutes'
      , secondsElSelector: '.js-cd-seconds'
    });

    // initialization of malihu scrollbar
    $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

    // initialization of forms
    $.HSCore.components.HSFocusState.init();

    // initialization of show animations
    $.HSCore.components.HSShowAnimation.init('.js-animation-link');

    // initialization of fancybox
    $.HSCore.components.HSFancyBox.init('.js-fancybox');

    // initialization of slick carousel
    $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

    // initialization of go to
    $.HSCore.components.HSGoTo.init('.js-go-to');

    // initialization of hamburgers
    $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

    // initialization of unfold component
    $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
      beforeClose: function() {
        $('#hamburgerTrigger').removeClass('is-active');
      }
      , afterClose: function() {
        $('#headerSidebarList .collapse.show').collapse('hide');
      }
    });

    $('#headerSidebarList [data-toggle="collapse"]').on('click', function(e) {
      e.preventDefault();

      var target = $(this).data('target');

      if ($(this).attr('aria-expanded') === "true") {
        $(target).collapse('hide');
      } else {
        $(target).collapse('show');
      }
    });

    // initialization of unfold component
    $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

    // initialization of select picker
    $.HSCore.components.HSSelectPicker.init('.js-select');
  });

</script>
@endsection
