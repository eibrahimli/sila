@extends('backend.layouts.app')

@section('title','Aladdin.az sifariş invoys faylı')

@section('content')

<div class="bg-dark m-b-30">
    <div class="container">
        <div class="row p-b-60 p-t-60">

            <div class="col-md-6 text-white p-b-30">
                <div class="media">
                    <div class="avatar avatar mr-3">
                        <div class="avatar-title bg-success rounded-circle mdi mdi-receipt  ">

                        </div>
                    </div>
                    <div class="media-body">
                        <div class="opacity-75">To,</div>
                        <h4 class="m-b-0">{{ ucfirst($order->city) }} </h4>
                        <p class="opacity-75">
                            Invoice ID #{{ $order->id }} <br>
                            Invoice Vaxt : {{ $order->date }}
                        </p>
                        <button class="btn btn-white-translucent" id="printDiv"> <i class="mdi
                        mdi-printer"></i>
                            Print</button>
                    </div>
                </div>

            </div>  
        </div>
    </div>
</div>
<div class="pull-up">
    <div class="container" id="printableArea">
        <div class="row">
            <div class="col-md-12 m-b-40">
                <div class="card">
                    <div class="card-body">
                        <div class="row">   
                            <div class="col-md-6">                                
                                <address class="m-t-10">
                                    To,<br>
                                    <span class="h4 font-primary"> {{ ucfirst($order->city) }},</span> <br>
                                    <span class="h5 font-primary"> {{ ucfirst($order->name) }} {{ ucfirst($order->surname) }},</span> <br>
                                    {{ $order->adress }} <br>      
                                    {{ $order->number }} <br>
                                    {{ $order->email }}                                                                  
                                </address>
                            </div>
                            <div class="col-md-6 text-right my-auto">
                                <h1 class="font-primary">INVOICE</h1>
                                <div class="">Invoice Nömrəsi: #{{ $order->id }}</div>
                                <div class="">Vaxt: {{ $order->date }}</div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table m-t-20">
                                <thead>
                                <tr>
                                    <th class="">Məhsul</th>
                                    {{-- <th class="text-center">Rəng</th>                                                                         --}}
                                    <th class="text-center">Məbləğ</th>
                                    <th class="text-center">Note</th>
                                    <th class="text-center">Poçt Kodu</th>
                                    <th class="text-center">Miqdar</th>
                                    <th class="text-right">Ümumi Məbləğ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach (unserialize($order->cart) as $cart)
                                <tr>
                                    <td class="">
                                        <p class="text-black m-0">{{ $cart->name }}</p>                                        
                                    </td>
                                    {{-- <td class="text-center">{{ $cart->options->all()['name'] }}</td>                                                                         --}}
                                    <td class="text-center">₼{{ $cart->price }}</td>
                                    <td class="text-center">{{ $order->note }}</td>
                                    <td class="text-center">{{ $order->post_code }}</td>
                                    <td class="text-center">{{ $cart->qty }}</td>
                                    <td class="text-right">₼{{ $cart->qty * $cart->price }}</td>
                                </tr>
                                @endforeach                                                                                           
                                <tr class="bg-light text-right">
                                    <td colspan="3" class="text-right">
                                        Ümumi
                                    </td>
                                    <td colspan="2" class="text-right">
                                        ₼ {{ $order->total_price }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-t-10 p-b-20">                            
                            <hr>
                            <div class="text-center opacity-75">
                                &copy; Silaexpress.com {{ date('Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
    <script src="{{ asset('backend/js/invoice_print.js') }}"></script>
@endsection