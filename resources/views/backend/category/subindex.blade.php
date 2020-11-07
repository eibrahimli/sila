@extends('backend.layouts.app')

@section('content')
<div class="bg-dark">
  <div class="container m-b-30">
    <div class="row">
      <div class="col-12 text-white p-t-40 p-b-90">        
        <h4>
          {{ Str::ucfirst($category->name) }}
        </h4>
        
        <p class="opacity-75 ">
          <span class="font-weight-bold text-primary">{{ Str::ucfirst($category->name) }}</span> kateqoriyasının alt kateqoriyalarını burdan idarə edə bilərsiniz.
        </p>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">AnaSəhifə</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Bütün Kateqoriyalar</a></li>
              @if($category->parent) 
                <li class="breadcrumb-item">
                  <a href="{{ route('admin.category.subcategories',$category->parent->id) }}">{{ $category->parent->name }}</a>
                </li>
              @endif
              <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}
              </li>
          </ol>
        </nav>
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
                  <th>Açıqlama</th>
                  <th>A.Sözlər</th>
                  <th>Şəkİl</th>
                  <th>Dil</th>
                  <th>Alt Kat</th>
                  <th>Ayarlar</th>
                </tr>
              </thead>
              <tbody>
                @if(count($category->categories) > 0)
                @foreach($category->categories as $subCategory)
                <tr>
                  <td>{{ $subCategory->name ?? 'Boşdur' }}</td>
                  <td>{{ $subCategory->desc() ?? 'Boşdur' }}</td>
                  <td>{{ $subCategory->keyw() ?? 'Boşdur' }}</td>
                  <td>                    
                    {{ $subCategory->photo ? '<img src="'.asset('storage/'.$subCategory->photo).'">' : 'Yüklənməyib' }}
                  </td>
                  <td>{{ $subCategory->lang ?? 'Boşdur' }}</td>
                  <td>                   
                    @if(count($subCategory->categories))
                      <a href="{{ route('admin.category.subcategories',$subCategory->id) }}" class="text-center">
                        <i class="icon-placeholder mdi mdi-eye"></i>
                      </a>
                    @else 
                      Yoxdur
                    @endif
                  </td>
                  <td>
                    <div class="row col-md-12">
                      <a href="{{ route('admin.category.edit',$subCategory->id) }}" class="text-center"> <i class="icon-placeholder mdi mdi-pencil-box mdi-18px mr-1"></i></a>
                      <a href="#" onclick="removeCategory(event)" class="text-center remove-category" data-id="{{ $category->id }}"> <i class="icon-placeholder mdi mdi-delete mdi-18px"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
              <tfoot>
                  <th>Ad</th>
                  <th>Açıqlama</th>
                  <th>A.Sözlər</th>
                  <th>Şəkİl</th>
                  <th>Dil</th>
                  <th>Alt Kat</th>
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

  function removeCategory(event) {
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
        fetch(`${Laravel.base_url}/admin/category/${id}`, {
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

          setTimeout(() => {window.location.href = '{{ route("admin.category.index") }}'},1500)
        }
      }
    })  
  }
</script>
@endsection
