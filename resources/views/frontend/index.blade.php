@extends('frontend.layouts.app')

@section('title', $setting->title)

@section('content')
    <!-- Slider Section -->
    <div class="mb-5 container">
        <div class="bg-img-hero" style="background-image: url({{ asset('frontend/img/1920X422/img1.jpg') }});">
            <div class="container min-height-420 overflow-hidden">
                <div data-pause-hover="true" data-autoplay="true" class="js-slick-carousel u-slick" data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-4 offset-xl-3 pl-2 pb-1">
                    @foreach($sliderproducts as $sliderproduct)
                        <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                            <div class="row min-height-420 py-7 py-md-0">
                                <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                    <h1 class="font-size-64 text-lh-57 font-weight-light" style="word-break: break-word;" data-scs-animation-in="fadeInUp">
                                        {{ Str::substr($sliderproduct->title, 0, 30) }}
                                    </h1>
                                    <h6 class="font-size-15 font-weight-bold mb-3 animated fadeInUp" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200" style="animation-delay: 200ms; opacity: 1; visibility: hidden">UNDER FAVORABLE SMARTWATCHES
                                    </h6>
                                    <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                        <div class="font-size-50 font-weight-bold text-lh-45">
                                            <sup class="">₼</sup>{{ $sliderproduct->price }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="fadeInRight" data-scs-animation-delay="500">
                                    <img class="img-fluid" style="border-radius: 10px;" src="{{ $sliderproduct->img }}" alt="Image Description">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Section -->
    <div class="container">
        <!-- Banner -->

        <!-- End Banner -->
        <!-- Deals-and-tabs -->
        @include('frontend.partials.new_products')
        <!-- End Deals-and-tabs -->
    </div>
    <!-- Products-4-1-4 -->

    <!-- End Products-4-1-4 -->
    <div class="container">
        <!-- Prodcut-cards-carousel  -->
        <!-- Bura ən çox satan məhsullar gələcək -->
        <!-- End Prodcut-cards-carousel -->
        <!-- Full banner -->
        @if($middle) 
            <div class="mb-6">
                <a href="{{ $middle->link }}" class="d-block text-gray-90">
                    <div style="height: 206px;border-radius: 1rem;background-image: url('{{ asset('storage/'.$middle->photo) }}');">
                       
                    </div>
                </a>
            </div>
        @endif
        <!-- End Full banner -->
        <!-- Recently viewed -->
        <div class="mb-6">
            <div class="position-relative">
                <div class="border-bottom border-color-1 mb-2">
                    <h3 class="section-title mb-0 pb-2 font-size-22">Ən Çox Görüntülənənlər</h3>
                </div>
                <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1" data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0" data-slides-show="7" data-slides-scroll="1" data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10" data-arrow-left-classes="fa fa-angle-left right-1" data-arrow-right-classes="fa fa-angle-right right-0" data-responsive='[{
                              "breakpoint": 1400,
                              "settings": {
                                "slidesToShow": 6
                              }
                            }, {
                                "breakpoint": 1200,
                                "settings": {
                                  "slidesToShow": 4
                                }
                            }, {
                              "breakpoint": 992,
                              "settings": {
                                "slidesToShow": 3
                              }
                            }, {
                              "breakpoint": 768,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }, {
                              "breakpoint": 554,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }]' data-autoplay="true" data-infinite="true">
                    @isset($seenProducts)
                        @foreach($seenProducts as $seenProduct)
                            <div class="js-slide products-group">
                                <div class="product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2">
                                                    <a href="{{ isset($seenProduct->category) ? $seenProduct->category->url : '#' }}" class="font-size-12 text-gray-5">{{ isset($seenProduct->category) ? $seenProduct->category->name() : '' }}</a>
                                                </div>
                                                <h5 class="mb-1 product-item__title">
                                                    <a href={{ $seenProduct->path() }} class="text-blue font-weight-bold">{{ $seenProduct->title }}</a>
                                                </h5>
                                                <div class="mb-2">
                                                    <a href="{{ $seenProduct->path() }}" class="d-block text-center"><img class="img-fluid" src="{{ asset('storage/'.$seenProduct->photo) }}" alt="{{ $seenProduct->title }}"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">₼{{ $seenProduct->price }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
        <!-- End Recently viewed -->
        <!-- Brand Carousel -->
            @include('frontend.inc.brands_carousel')
        <!-- End Brand Carousel -->
    </div>
@endsection

@section('scripts')
    <!-- JS Implementing Plugins -->
    <script src="{{ asset('frontend/vendor/appear.js') }}"></script>
    <script src="{{ asset('frontend/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
    <script src="{{ asset('frontend/vendor/svg-injector/dist/svg-injector.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
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
    <script src="{{ asset('frontend/js/components/hs.validation.js') }}"></script>
    <script src="{{ asset('frontend/js/components/hs.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/js/components/hs.onscroll-animation.js') }}"></script>
    <script src="{{ asset('frontend/js/components/hs.slick-carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/components/hs.show-animation.js') }}"></script>
    <script src="{{ asset('frontend/js/components/hs.svg-injector.js') }}"></script>
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

            // initialization of svg injector module
            $.HSCore.components.HSSVGIngector.init('.js-svg-injector');
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

            // initialization of form validation
            // $.HSCore.components.HSValidation.init('.js-validate', {
            //     rules: {
            //         confirmPassword: {
            //             equalTo: '#signupPassword'
            //         }
            //     }
            // });

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
