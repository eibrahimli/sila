@extends('backend.layouts.app')

@section('content')
  <div class="bg-dark m-b-30">
    <div class="container">
      <div class="row p-b-60 p-t-60">

        <div class="col-md-6 text-white p-b-30">
          <div class="media">
            <div class="avatar avatar mr-3">
              <div class="avatar-title bg-success rounded-circle mdi mdi-currency-usd">

              </div>
            </div>
            <div class="media-body">
              <h1>Aktiv olmayan Sifarişlər </h1>
              <p class="opacity-75">
                Bütün aktiv olmayan sifarişləri burdan görüntülüyə bilərsiniz.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-5 text-center m-b-30 ml-auto">
          <div class="rounded text-white bg-white-translucent">
            <div class="p-all-15">
              <div class="row">
                <div class="col-md-6 my-2 m-md-0">
                  <div class="text-overline opacity-75">ƏldƏ Edİldİ</div>
                  <h3 class="m-0 text-success">{{ $total_prices }} AZN</h3>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pull-up">
    <div class="container">
      <not-active-orders get_not_active_orders="{{ route('admin.order.getNotActiveOrders') }}"></not-active-orders>
    </div>

  </div>
@endsection