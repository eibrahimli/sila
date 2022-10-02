@extends('frontend.layouts.app')


@section('content')
<div class="bg-gray-13 bg-md-transparent">
    <div class="container">
      <!-- breadcrumb -->
      <div class="my-md-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('index') }}">Anasəhifə</a></li>
            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><div class="font-weight-bold">{{ $store->name }} </div> &nbsp; mağazasına uyğun məhsullar</li>
          </ol>
        </nav>
      </div>
      <!-- End breadcrumb -->
    </div>
  </div>
  <!-- End breadcrumb -->

  <div class="container">
    <!-- Shop Body -->
    <!-- Tab Content -->
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
            <ul class="row list-unstyled products-group no-gutters">
                @if(count($store->products))
                    @foreach ($store->products as $item)
                    <li class="col-6 col-md-3 col-xl-2 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2">
                                        <a href="@if($item->category !== null) {{ $item->category->url }} @endif" class="font-size-12 text-gray-5">{{ $item->category !== null ? $item->category->name : null }}</a>
                                    </div>
                                    <h5 class="mb-1 product-item__title">
                                        <a href="{{ $item->url }}" class="text-blue font-weight-bold">{{ $item->title }}</a>
                                    </h5>
                                    <div class="mb-2">
                                        <a href="{{ $item->url }}" class="d-block text-center">
                                            <img class="img-fluid" src="{{ asset('storage/'.$item->photo) }}" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="flex-center-between mb-1">
                                        <div class="prodcut-price d-flex align-items-center position-relative">
                                            <div class="font-size-20 font-bodl">₼ {{ $item['price'] }}</div>
                                        </div>
                                        <div class="d-none d-xl-block prodcut-add-cart">
                                            <a href="{{ $item->url }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach

                @else
                    <div class="alert col-12 alert-warning" role="alert">
                        Mağazada məhsul tapılmadı...
                    </div>    
                @endif
            </ul>
        </div>
    </div>
    <!-- End Tab Content -->
    <!-- End Shop Body -->
    <!-- Shop Pagination -->
    {{-- <nav class="d-md-flex justify-content-between align-items-center border-top p-3" aria-label="Page navigation example">
        <div class="text-center text-md-left mb-3 mb-md-0">Showing 1–25 of 56 results</div>
        <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
            <li class="page-item"><a class="page-link current" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
        </ul>
    </nav> --}}
    <!-- End Shop Pagination -->
  </div>

@endsection

@section('scripts')
  <!-- JS Implementing Plugins -->
  <script src="{{ asset('frontend/vendor/appear.js ') }}"></script>
  <script src="{{ asset('frontend/vendor/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
  <script src="{{ asset('frontend/vendor/svg-injector/dist/svg-injector.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/typed.js/lib/typed.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/slick-carousel/slick/slick.js') }}"></script>
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
  <script src="{{ asset('frontend/js/components/hs.show-animation.js') }}"></script>
  <script src="{{ asset('frontend/js/components/hs.svg-injector.js') }}"></script>
  <script src="{{ asset('frontend/js/components/hs.scroll-nav.js') }}"></script>
  <script src="{{ asset('frontend/js/components/hs.go-to.js') }}"></script>
  <script src="{{ asset('frontend/js/components/hs.selectpicker.js') }}"></script>

  <!-- JS Plugins Init. -->
  <!-- JS Plugins Init. -->
  <script>
    $(window).on('load', function () {
      // initialization of HSMegaMenu component
      $('.js-mega-menu').HSMegaMenu({
        event: 'hover',
        direction: 'horizontal',
        pageContainer: $('.container'),
        breakpoint: 767.98,
        hideTimeOut: 0
      });
    });

    $(document).on('ready', function () {
      // initialization of header
      $.HSCore.components.HSHeader.init($('#header'));

      // initialization of animation
      $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

      // initialization of unfold component
      $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
        afterOpen: function () {
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
        yearsElSelector: '.js-cd-years',
        monthsElSelector: '.js-cd-months',
        daysElSelector: '.js-cd-days',
        hoursElSelector: '.js-cd-hours',
        minutesElSelector: '.js-cd-minutes',
        secondsElSelector: '.js-cd-seconds'
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
      
      setTimeout(() => {
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');
      }, 1000);

      // initialization of go to
      $.HSCore.components.HSGoTo.init('.js-go-to');

      // initialization of hamburgers
      $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

      // initialization of unfold component
      $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
        beforeClose: function () {
          $('#hamburgerTrigger').removeClass('is-active');
        },
        afterClose: function() {
          $('#headerSidebarList .collapse.show').collapse('hide');
        }
      });

      $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
        e.preventDefault();

        var target = $(this).data('target');

        if($(this).attr('aria-expanded') === "true") {
          $(target).collapse('hide');
        } else {
          $(target).collapse('show');
        }
      });

      // initialization of unfold component
      $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));
    });
  </script>
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