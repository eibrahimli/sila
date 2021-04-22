@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid bg-dark m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">
                <h4 class=""><span class="btn btn-white-translucent"><i class="mdi mdi-shape-circle-plus "></i></span> Hər Vaxtın Xeyir</span>,
                    {{ auth()->user()->name }}!</h4>
                <p class="opacity-75 ">
                    Dəyərli adminimiz xoş gəlmisən :D
                </p>
                <a href="{{ route('admin.order.notActiveIndex') }}" class="btn btn-white-translucent">Yeni sifarişlər</a>

            </div>
        </div>
    </div>
    <div class="container-fluid pull-up">

    </div>
@endsection
