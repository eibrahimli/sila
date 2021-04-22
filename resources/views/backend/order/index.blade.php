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
              <h1>Sifarişlər </h1>
              <p class="opacity-75">
                Bütün aktiv sifarişləri burdan görüntülüyə bilərsiniz.
              </p>
            </div>
          </div>

        </div>
        <div class="col-md-5 text-center m-b-30 ml-auto">
          <div class="rounded text-white bg-white-translucent">
            <div class="p-all-15">
              <div class="row">
                <div class="col-md-6 my-2 m-md-0">
                  <div class="text-overline    opacity-75">ƏldƏ Edİldİ</div>
                  <h3 class="m-0 text-success">₼42,560</h3>
                </div>
                <div class="col-md-6 my-2 m-md-0">
                  <div class="text-overline    opacity-75">Ödəmə GözlƏnİlİr</div>
                  <h3 class="m-0 text-danger">₼1,520</h3>
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
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row m-b-20">
                <div class="col-md-6 my-auto">
                  <h4 class="m-0">Nəticələr</h4>
                </div>
                <div class="col-md-6 text-right my-auto">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-white shadow-none js-datepicker"><i class="mdi mdi-calendar"></i> Vaxt Seç
                    </button>

                    <button type="button" class="btn btn-white shadow-none">Bütün</button>
                    <button type="button" class="btn btn-white shadow-none">Kargo</button>
                    <button type="button" class="btn btn-white shadow-none">Təslim</button>
                  </div>

                </div>
              </div>
              <div class="row ">
                <div class="col-md-12 p-0">

                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                      <tr>
                        <th scope="col">Vaxt</th>
                        <th scope="col">İnvoys Nömrəsi</th>
                        <th scope="col">Əladə Edən</th>
                        <th scope="col">Vəziyyət</th>
                        <th scope="col">Məbləğ</th>
                        <th scope="col">Ədəd</th>
                        <th scope="col">Ayarlar</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($orders as $order)
                        <tr>
                        <td class="align-middle">{{\Carbon\Carbon::parse($order->created_at)->format('d M Y')}}</td>
                        <td class="align-middle">#{{ $order->id }}</td>
                        <td class="align-middle">{{ $order->email }}</td>
                        <td class="align-middle"><span class=" text-success">
                            <i class="mdi mdi-check-circle "></i> Paid</span>
                        </td>
                        <td class="align-middle"><h6 class=" m-0">₼{{ $order->total_price }}</h6></td>
                        <td class="align-middle">{{ $order->total_quantity }}</td>
                        <td class="align-middle">
                          <div class="input-group ">
                            <div class="input-group-prepend">
                              <a href='#' class='btn btn-white'>Görüntülə</a>
                            </div>

                          </div>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
                <div class="col-auto ml-auto">
                  <div>
                    <nav class="">
                      <ul class="pagination">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="{{ $orders['path'].'/page?='.$orders['currentPage'] }}">{{ $orders['currentPage'] }}</a>
                        </li>
                        <li class="page-item ">
                          <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">Next</a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection