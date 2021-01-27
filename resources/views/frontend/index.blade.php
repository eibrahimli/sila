@extends('frontend.layouts.app')

@section('title', $setting->title)

@section('content')
    <!-- Slider Section -->
    <div class="mb-5">
        <div class="bg-img-hero" style="background-image: url({{ asset('frontend/img/1920X422/img1.jpg') }});">
            <div class="container min-height-420 overflow-hidden">
                <div class="js-slick-carousel u-slick" data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-4 offset-xl-3 pl-2 pb-1">
                    <div class="js-slide bg-img-hero-center">
                        <div class="row min-height-420 py-7 py-md-0">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                    THE NEW <span class="d-block font-size-55">STANDARD</span>
                                </h1>
                                <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">UNDER FAVORABLE SMARTWATCHES
                                </h6>
                                <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    <span class="font-size-13">FROM</span>
                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                        <sup class="">$</sup>749<sup class="">99</sup>
                                    </div>
                                </div>
                                <a href="../shop/single-product-fullwidth.html" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                    Start Buying
                                </a>
                            </div>
                            <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="zoomIn" data-scs-animation-delay="500">
                                <img class="img-fluid" src="{{ asset('frontend/img/416X420/img1.png') }}" alt="Image Description">
                            </div>
                        </div>
                    </div>
                    <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                        <div class="row min-height-420 py-7 py-md-0">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                    THE NEW <span class="d-block font-size-55">STANDARD</span>
                                </h1>
                                <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">UNDER FAVORABLE SMARTWATCHES
                                </h6>
                                <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    <span class="font-size-13">FROM</span>
                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                        <sup class="">$</sup>749<sup class="">99</sup>
                                    </div>
                                </div>
                                <a href="../shop/single-product-fullwidth.html" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                    Start Buying
                                </a>
                            </div>
                            <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="fadeInUp" data-scs-animation-delay="500">
                                <img class="img-fluid" src="{{ asset('frontend/img/416X420/img2.png') }}" alt="Image Description">
                            </div>
                        </div>
                    </div>
                    <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                        <div class="row min-height-420 py-7 py-md-0">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                    THE NEW <span class="d-block font-size-55">STANDARD</span>
                                </h1>
                                <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">UNDER FAVORABLE SMARTWATCHES
                                </h6>
                                <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    <span class="font-size-13">FROM</span>
                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                        <sup class="">$</sup>749<sup class="">99</sup>
                                    </div>
                                </div>
                                <a href="../shop/single-product-fullwidth.html" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-15" data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                    Start Buying
                                </a>
                            </div>
                            <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="fadeInRight" data-scs-animation-delay="500">
                                <img class="img-fluid" src="{{ asset('frontend/img/416X420/img3.png') }}" alt="Image Description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Section -->
    <div class="container">
        <!-- Banner -->

        <!-- End Banner -->
        <!-- Deals-and-tabs -->
        <div class="mb-5">
            <div class="row">
                <!-- Deal -->

                <!-- End Deal -->
                <!-- Tab Prodcut -->
                <div class="col">
                    <!-- Features Section -->
                    <div class="">
                        <!-- Nav Classic -->
                        <div class="position-relative bg-white text-center z-index-2">
                            <ul class="nav nav-classic nav-tab justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active " id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            Yeni
                                        </div>
                                    </a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link " id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">--}}
{{--                                        <div class="d-md-flex justify-content-md-center align-items-md-center">--}}
{{--                                            Endirimli--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                        <!-- End Nav Classic -->

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
                                <ul class="row list-unstyled products-group no-gutters">
                                    @isset($products)
                                        @foreach($products as $product)
                                            <li class="col-6 col-wd-2 col-md-3 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2">
                                                                <a href="{{ $product->category->path() }}" class="font-size-12 text-gray-5">{{ $product->category->name() }}</a>
                                                            </div>
                                                            <h5 class="mb-1 product-item__title">
                                                                <a href="{{ $product->path() }}" class="text-blue font-weight-bold">{{ $product->title }}</a>
                                                            </h5>
                                                            <div class="mb-2">
                                                                <a href="{{ $product->path() }}" class="d-block text-center"><img class="img-fluid" src="{{ asset('storage/'.$product->photo) }}" alt="{{ $product->title }}"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">₼{{ $product->price }}</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__footer">
                                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                                <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Qarşılaşdır</a>
                                                                <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> İstək siyahısı</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endisset
                                </ul>
                            </div>
{{--                            <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">--}}
{{--                                <ul class="row list-unstyled products-group no-gutters">--}}
{{--                                    <li class="col-6 col-wd-3 col-md-4 product-item">--}}
{{--                                        <div class="product-item__outer h-100">--}}
{{--                                            <div class="product-item__inner px-xl-4 p-3">--}}
{{--                                                <div class="product-item__body pb-xl-2">--}}
{{--                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('frontend/img/212X200/img2.jpg') }}" alt="Image Description"></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-center-between mb-1">--}}
{{--                                                        <div class="prodcut-price">--}}
{{--                                                            <div class="text-gray-100">$685,00</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-6 col-wd-3 col-md-4 product-item">--}}
{{--                                        <div class="product-item__outer h-100">--}}
{{--                                            <div class="product-item__inner px-xl-4 p-3">--}}
{{--                                                <div class="product-item__body pb-xl-2">--}}
{{--                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Purple Solo 2 Wireless</a></h5>--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('frontend/img/212X200/img3.jpg') }}" alt="Image Description"></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-center-between mb-1">--}}
{{--                                                        <div class="prodcut-price">--}}
{{--                                                            <div class="text-gray-100">$685,00</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-xl">--}}
{{--                                        <div class="product-item__outer h-100">--}}
{{--                                            <div class="product-item__inner px-xl-4 p-3">--}}
{{--                                                <div class="product-item__body pb-xl-2">--}}
{{--                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Smartphone 6S 32GB LTE</a></h5>--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('frontend/img/212X200/img4.jpg') }}" alt="Image Description"></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-center-between mb-1">--}}
{{--                                                        <div class="prodcut-price">--}}
{{--                                                            <div class="text-gray-100">$685,00</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-wd">--}}
{{--                                        <div class="product-item__outer h-100">--}}
{{--                                            <div class="product-item__inner px-xl-4 p-3">--}}
{{--                                                <div class="product-item__body pb-xl-2">--}}
{{--                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Widescreen NX Mini F1 SMART NX</a></h5>--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('frontend/img/212X200/img5.jpg') }}" alt="Image Description"></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-center-between mb-1">--}}
{{--                                                        <div class="prodcut-price">--}}
{{--                                                            <div class="text-gray-100">$685,00</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-6 col-wd-3 col-md-4 product-item">--}}
{{--                                        <div class="product-item__outer h-100">--}}
{{--                                            <div class="product-item__inner px-xl-4 p-3">--}}
{{--                                                <div class="product-item__body pb-xl-2">--}}
{{--                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('frontend/img/212X200/img1.jpg') }}" alt="Image Description"></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-center-between mb-1">--}}
{{--                                                        <div class="prodcut-price">--}}
{{--                                                            <div class="text-gray-100">$685,00</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-xl">--}}
{{--                                        <div class="product-item__outer h-100">--}}
{{--                                            <div class="product-item__inner px-xl-4 p-3">--}}
{{--                                                <div class="product-item__body pb-xl-2">--}}
{{--                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('frontend/img/212X200/img7.jpg') }}" alt="Image Description"></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-center-between mb-1">--}}
{{--                                                        <div class="prodcut-price">--}}
{{--                                                            <div class="text-gray-100">$685,00</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-xl">--}}
{{--                                        <div class="product-item__outer h-100">--}}
{{--                                            <div class="product-item__inner px-xl-4 p-3">--}}
{{--                                                <div class="product-item__body pb-xl-2">--}}
{{--                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Camera C430W 4k Waterproof</a></h5>--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('frontend/img/212X200/img8.jpg') }}" alt="Image Description"></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-center-between mb-1">--}}
{{--                                                        <div class="prodcut-price">--}}
{{--                                                            <div class="text-gray-100">$685,00</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-wd">--}}
{{--                                        <div class="product-item__outer h-100">--}}
{{--                                            <div class="product-item__inner px-xl-4 p-3">--}}
{{--                                                <div class="product-item__body pb-xl-2">--}}
{{--                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Full Color LaserJet Pro M452dn</a></h5>--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('frontend/img/212X200/img6.jpg') }}" alt="Image Description"></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-center-between mb-1">--}}
{{--                                                        <div class="prodcut-price">--}}
{{--                                                            <div class="text-gray-100">$685,00</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                        <!-- End Tab Content -->
                    </div>
                    <!-- End Features Section -->
                </div>
                <!-- End Tab Prodcut -->
            </div>
        </div>
        <!-- End Deals-and-tabs -->
    </div>
    <!-- Products-4-1-4 -->

    <!-- End Products-4-1-4 -->
    <div class="container">
        <!-- Prodcut-cards-carousel -->
        <div class="space-top-2">
            <div class=" d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                <h3 class="section-title mb-0 pb-2 font-size-22">Ən Çox Satanlar</h3>
                <ul class="nav nav-pills mb-2 pt-3 pt-md-0 mb-0 border-top border-color-1 border-md-top-0 align-items-center font-size-15 font-size-15-md flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                    <li class="nav-item flex-shrink-0 flex-md-shrink-1">
                        <a class="text-gray-90 btn btn-outline-primary border-width-2 rounded-pill py-1 px-4 font-size-15 text-lh-19 font-size-15-md" href="#">Top 20</a>
                    </li>
                </ul>
            </div>
            <div class="js-slick-carousel u-slick u-slick--gutters-2 overflow-hidden u-slick-overflow-visble pt-3 pb-6" data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
                <div class="js-slide">
                    <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                        @isset($soldedProducts)
                            @foreach($soldedProducts as $soldedProduct)
                                <li class="col-wd-3 col-md-4 product-item product-item__card d-wd-block pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0 remove-divider-wd">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner p-md-3 row no-gutters">
                                            <div class="col col-lg-auto product-media-left">
                                                <a href="{{ $soldedProduct->path() }}" class="max-width-150 d-block">
                                                    <img class="img-fluid" src="{{ asset('storage/'.$soldedProduct->photo) }}" alt="{{ $soldedProduct->title }}">
                                                </a>
                                            </div>
                                            <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                                <div class="mb-4">
                                                    <div class="mb-2">
                                                        <a href="{{ $soldedProduct->category->path() }}" class="font-size-12 text-gray-5">{{ $soldedProduct->category->name() }}</a>
                                                    </div>
                                                    <h5 class="product-item__title">
                                                        <a href="{{ $soldedProduct->path() }}" class="text-blue font-weight-bold">{{ $soldedProduct->title }}</a>
                                                    </h5>
                                                </div>
                                                <div class="flex-center-between mb-3">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">₼{{ $soldedProduct->price }}</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Qarşılaşdır</a>
                                                        <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> İstək siyahısı</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endisset
                    </ul>
                </div>

            </div>
        </div>
        <!-- End Prodcut-cards-carousel -->
        <!-- Full banner -->
        <div class="mb-6">
            <a href="#" class="d-block text-gray-90">
                <div class="" style="background-image: url({{ asset('frontend/img/1400X206/img1.jpg') }});">
                    <div class="space-top-2-md p-4 pt-6 pt-md-8 pt-lg-6 pt-xl-8 pb-lg-4 px-xl-8 px-lg-6">
                        <div class="flex-horizontal-center mt-lg-3 mt-xl-0 overflow-auto overflow-md-visble">
                            <h1 class="text-lh-38 font-size-32 font-weight-light mb-0 flex-shrink-0 flex-md-shrink-1">Alış Veriş Et Və <strong>Kompanyadan</strong> Faydalan</h1>
                            <div class="ml-5 flex-content-center flex-shrink-0">
                                <div class="bg-primary rounded-lg px-6 py-2">
                                    <em class="font-size-14 font-weight-light">Başlayır</em>
                                    <div class="font-size-30 font-weight-bold text-lh-1">
                                        <sup class="">₼</sup>79<sup class="">99</sup>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
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
                            }]'>
                    @isset($seenProducts)
                        @foreach($seenProducts as $seenProduct)
                            <div class="js-slide products-group">
                                <div class="product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2">
                                                    <a href="{{ $seenProduct->category->path() }}" class="font-size-12 text-gray-5">{{ $seenProduct->category->name() }}</a>
                                                </div>
                                                <h5 class="mb-1 product-item__title">
                                                    <a href={{ $seenProduct->path() }} class="text-blue font-weight-bold">{{ $seenProduct->title }}</a>
                                                </h5>
                                                <div class="mb-2">
                                                    <a href="{{ $seenProduct->path() }}" class="d-block text-center"><img class="img-fluid" src="{{ asset('storage/'.$seenProduct->photo) }}" alt="{{ $seenProduct->title }}"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">₼{{ $product->price }}</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Qarşılaşdır</a>
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> İstək siyahısı</a>
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
