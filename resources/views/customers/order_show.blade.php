@extends('layouts.base2')
@section('content')
<style>
    nav svg{
        height:20px;
    }
    nav .hidden{
        display:block !important;
    }
</style>
    <div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1> الطلبات 
                <a class="btn btn-success btn-sm" href="{{ route('home.service_categories') }}"><i class="fa fa-plus"></i></a>
                </h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">الرئيسية</a></li>
                        <li>/</li>
                        <li>الطلبات</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
    <section class="content-central">
        @if(Session::has('message'))
        <div class="text-center">
         <p class="alert alert-success" role="alert">{{Session::get('message')}}</p>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="text-center">
         <p class="alert alert-danger" role="alert">{{Session::get('message')}}</p>
        </div>
        @endif
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                    <div class="row portfolioContainer">
                        <div class="col-md-12 profile1">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">رقم الطلب</th>
                                    <th class="text-center">وقت حضور العامل</th>
                                    <th class="text-center">الخدمة</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">التفاصيل</th>
                                    <th class="text-center">تاريخ الانشاء</th>
                                    <th class="text-center"></th>
                                    <th class="text-center">الصورة</th>
                                    <th class="text-center">الاجراءت</th>
                                </tr>
                                </thead>
                                <tbody style="center">
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->order_code }}</td>
                                        <td class="text-center">{{ $order->time }}</td>
                                        <td class="text-center">{{ $order->service->name }}</td>
                                        <td class="text-center">
                                            @if($order->status == 1)
                                            مفعل
                                            @else
                                              قيد المراجعة
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $order->details }}</td>
                                        <td class="text-center">{{ $order->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('customer.order',$order->id) }}" class="btn btn-success btn-sm">عرض الطلب</a>
                                        </div>
                                        </td>
                                        <td class="text-center">
                                        <img class="pull-center" src="{{asset('images/orders')}}/{{$order->image}}" alt="غير موجودة" width="80" />
                                        </td>
                                        <td class="text-center">
                                        <a href=""><i class="fa  fa-edit fa-2x"></i></a>
                                        <a href="")'><i style="margin-right:10px" class="fa  fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    $(document).ready(function() {
        @foreach($orders as $order)
            var map = L.map('map-{{ $order->id }}').setView([{{ $order->lat }}, {{ $order->lon }}], 13); 
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            L.marker([{{ $order->lat }},{{ $order->lon }}]).addTo(map);
        @endforeach
        });
</script>    
 @endpush