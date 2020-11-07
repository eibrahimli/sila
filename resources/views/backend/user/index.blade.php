@extends('backend.layouts.app')

@section('content')
<div class="bg-dark">
  <div class="container  m-b-30">
    <div class="row">
      <div class="col-12 text-white p-t-40 p-b-90">

        <h4>
          İstifadəçilər
        </h4>
        <p class="opacity-75 ">
          Saytadakı bütün istifadəçilər burdan idarə edə bilərsiniz.
        </p>

      </div>
    </div>
  </div>
</div>

<div class="container  pull-up">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
              <thead>
                <tr>
                  <th>Ad</th>
                  <th>Soyad</th>
                  <th>Email</th>
                  <th>Nömrə</th>
                  <th>Adress</th>
                  <th>Şəhər</th>
                  <th>Ayarlar</th>
                </tr>
              </thead>
              <tbody>                
                @if(count($users) > 0) 
                  @foreach($users as $user)
                    <tr>
                      <td>{{ $user->name ?? 'Boşdur' }}</td>
                      <td>{{ $user->surname ?? 'Boşdur' }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->number ?? 'Boşdur' }}</td>
                      <td>{{ $user->address ?? 'Boşdur' }}</td>
                      <td>{{ $user->city ?? 'Boşdur' }}</td>
                      <td>
                        <div class="row col-md-12">
                          <a href="{{ route('admin.user.edit',$user->id) }}" class="text-center"> <i class="icon-placeholder mdi mdi-account-edit mdi-18px mr-1"></i></a>
                          <a href="#" onclick="removeUser(event)" class="text-center remove-user" data-id="{{ $user->id }}"> <i class="icon-placeholder mdi mdi-delete mdi-18px"></i></a>                          
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
              <tfoot>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Email</th>
                <th>Nömrə</th>
                <th>Adress</th>
                <th>Şəhər</th>
                <th>Ayarlar</th>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/datatables.min.css') }}"/>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('backend/js/datatables.min.js') }}"></script>

<script>

  $(document).ready(function(){
    $('#example').DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
          "search" : "Axtar",
          "lengthMenu": "Hər səhifədə _MENU_ məlumat görsət",
          "zeroRecords": "Axtarışa uyğun məlumat tapılmadı",
          "info": "_PAGES_ səhifənin _PAGE_ görsədilir",
          "infoEmpty": "Məlumat tapılmadı",
          "infoFiltered": "(_MAX_ məlumatdan filtrləndi)",
          "paginate": {
              "first":      "İlk",
              "last":       "Son",
              "next":       "Növbəti",
              "previous":   "Əvvəlki"
          }
      },
    })
  })

  function removeUser(event) {
    event.preventDefault()

    let id = event.target.parentNode.getAttribute('data-id')
    let form = new FormData()
    form.set('_method', 'DELETE')

    Swal.fire({
      title: 'Əminsiniz?',
      text: "Bu işləm geri alına bilməz!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: "Ləğv Et",
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Bəli sil!'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`${Laravel.base_url}/admin/user/${id}`, {
          method: "DELETE",
          headers: {
            'X-CSRF-Token' : document.querySelector('meta[name=csrf-token]').getAttribute('content')
          },
          body: form
        }).then(res => res.json()).then(data => showAlert(data)).catch(err => {          
          Swal.fire({
            icon: 'error',
            title: err.error,
          })
        })

        function showAlert(data) {          
          Swal.fire({
            position: "center",
            icon: "success",
            title: data.mes,
            showConfirmButton: false,
            timer: 1500,
          });

          setTimeout(() => {window.location.href = '{{ route("admin.user.index") }}'},1500)
        }
      }
    })  
  }
</script>
@endsection
