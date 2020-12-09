@extends('seller.layouts.app')

@section('content')
  <div class="bg-dark">
    <div class="container  m-b-30">
      <div class="row">
        <div class="col-12 text-white p-t-40 p-b-90">
          <h4>
          <span class="btn btn-white-translucent">
            <i class="mdi mdi-table "></i>
          </span> Mağazalarınız
          </h4>
          <p class="opacity-75 ">
            * Mağazalarınızı burdan sürətli şəkildə yeniləyə bilərsiniz. <br>
            * İstədiyiniz vaxt mağazanızı silib və ya redaktə edə bilərsiniz. <br>
            * Mağazınızın məhsullarınıda görüntülüyə bilərsiniz. <br>
            * Əgər 1 mağazasınız varsa yenisini təyin edə bilməyəcəksiniz. <br>
            * Gələcəkdə daha çox mağaza əlavə etmək hüququ sizə veriləcəkdir.
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="container pull-up">
    <div class="row">

      <div class="col-md-12">
        <div class="card m-b-30">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>Avatar</th>
                  <th>Adı</th>
                  <th>Adres</th>
                  <th>Nömrə</th>
                  <th>Açıqlama</th>
                  <th>Açar sözlər</th>
                  <th>Məhsullar</th>
                  <th>Ayarlar</th>
                </tr>
                </thead>
                <tbody>
                @foreach(auth()->user()->stores()->get() as $store)
                  <tr>
                    <td>
                      <div class="avatar avatar-sm ">
                        <img src="{{ asset('backend/img/users/user-1.jpg') }}"
                             class="avatar-img avatar-sm rounded-circle" alt="">
                      </div>
                    </td>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->address }}</td>
                    <td>{{ $store->number }}</td>
                    <td>{{ $store->desc }}</td>
                    <td>{{ $store->keyw }}</td>
                    <td class="center"><a href="{{ route('seller.product.index') }}"><i class="mdi mdi-eye"></i> Bütün
                        Məhsullar</a></td>
                    <td>
                      <div class="row col-md-12">
                        <a href="{{ route('seller.store.edit',$store->id) }}" class="text-center">
                          <i class="icon-placeholder mdi mdi-pencil-box mdi-18px"></i>
                        </a>
                        <a href="#" onclick="removeStore(event)" class="text-center remove-store"
                           data-id="{{ $store->id }}"> <i class="icon-placeholder mdi mdi-delete mdi-18px"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    function removeStore(event) {
      event.preventDefault()

      let id = event.target.parentNode.getAttribute('data-id')
      let form = new FormData()
      form.set('_method', 'DELETE')

      Swal.fire({
        title: 'Əminsiniz?'
        , text: "Bu işləm geri alına bilməz!"
        , icon: 'warning'
        , showCancelButton: true
        , cancelButtonText: "Ləğv Et"
        , confirmButtonColor: '#3085d6'
        , cancelButtonColor: '#d33'
        , confirmButtonText: 'Bəli sil!'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`${Laravel.base_url}/seller/store/${id}`, {
            method: "DELETE"
            , headers: {
              'X-CSRF-Token': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            }
            , body: form
          }).then(res => res.json()).then(data => showAlert(data)).catch(err => {
            Swal.fire({
              icon: 'error'
              , title: err.error
              ,
            })
          })

          function showAlert(data) {

            if (!data.error) {
              Swal.fire({
                position: "center"
                , icon: "success"
                , title: data.mes
                , showConfirmButton: false
                , timer: 1500
                ,
              });
            } else {
              Swal.fire({
                position: "center"
                , icon: "error"
                , title: data.error
                , showConfirmButton: false
                , timer: 2500
                ,
              });
            }

            //setTimeout(() => { window.location.href = '{{ route("seller.store.index") }}' }, 1500)
          }
        }
      })

    }

  </script>
@endsection
