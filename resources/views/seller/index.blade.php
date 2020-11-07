@extends('seller.layouts.app')

@section('content')
<div class="container-fluid bg-dark m-b-30">
  <div class="row">
    <div class="col-12 text-white p-t-40 p-b-90">
      <h4 class="">
        <span class="btn btn-white-translucent"><i class="mdi mdi-shape-circle-plus "></i></span>
        Salam dəyərli satıcı,
        {{ auth()->user()->name .' '. auth()->user()->surname}}
      </h4>
      @if(count(auth()->user()->stores) > 0)

      @else
      <p class="opacity-75 ">
        Əgər mağaza əlavə etməmisinizsə yeni mağaza əlavə edin.
      </p>
      <a href="{{ route('seller.store.create') }}" class="btn btn-white-translucent"><i class="mdi mdi-plus"></i> Yeni Mağaza</a>
      @endif
    </div>
  </div>
</div>
<!-- Container Fluid -->
@endsection
