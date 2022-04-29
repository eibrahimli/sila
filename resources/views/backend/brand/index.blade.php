@extends('backend.layouts.app')

@section('content')
<div class="bg-dark">
  <div class="container m-b-30">
    <div class="row">
      <div class="col-8 text-white p-t-40 p-b-90">
        <h4>
          Bütün Brendlər
        </h4>
        <p class="opacity-75 ">
          Saytadakı bütün brendləri burdan idarə edə bilərsiniz.
        </p>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">AnaSəhifə</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bütün brendlər
            </li>
          </ol>
        </nav>
      </div>
      <div class="col-md-4 m-auto text-white p-b-30">
        <div class="text-md-right">
          <a href="{{ route('admin.brand.create') }}" class="btn btn-success"><i class="mdi mdi-plus"></i>Yeni brend</a>
        </div>
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
                  <th>Nömrə</th>
                  <th>Ad</th>            
                  <th>Şəkİl</th>
                  <th>Dİl</th>            
                  <th>Ayarlar</th>
                </tr>
              </thead>
              <tbody>
                @if(count($brands) > 0)
                @foreach($brands as $brand)
                <tr>
                  <td>{{ $brand->id }}</td>
                  <td>{{ $brand->name }}</td>                
                  <td>                    
                    @if($brand->photo) <img width="166" height="59" src="{{ asset('storage/'.$brand->photo) }}"> @else {{ 'Yüklənməyib' }} @endif
                  </td>
                  <td>{{ $brand->lang ?? 'Boşdur' }}</td>                
                  <td>
                    <div class="row col-md-12">
                      <a href="{{ route('admin.brand.edit',$brand->id) }}" class="text-center"> <i class="icon-placeholder mdi mdi-pencil-box mdi-18px mr-1"></i></a>
                      <a href="javascript:void(0)" onclick="event.preventDefault(); document.querySelector('.delete_brand_form').submit()"> <i class="icon-placeholder mdi mdi-delete mdi-18px"></i></a>
                      <form class="delete_brand_form" method="POST" action="{{ route('admin.brand.destroy',$brand->id) }}">
                        @csrf
                        @method('DELETE')
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
              <tfoot>
                  <th>Nömrə</th>
                  <th>Ad</th>            
                  <th>Şəkİl</th>
                  <th>Dİl</th>            
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
    $(document).ready(function () {
        $('#example').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "search": "Axtar",
                "lengthMenu": "Hər səhifədə _MENU_ məlumat görsət",
                "zeroRecords": "Axtarışa uyğun məlumat tapılmadı",
                "info": "_PAGES_ səhifənin _PAGE_ görsədilir",
                "infoEmpty": "Məlumat tapılmadı",
                "infoFiltered": "(_MAX_ məlumatdan filtrləndi)",
                "paginate": {
                    "first": "İlk",
                    "last": "Son",
                    "next": "Növbəti",
                    "previous": "Əvvəlki"
                }
            },
        })
    })
  </script>
@endsection
