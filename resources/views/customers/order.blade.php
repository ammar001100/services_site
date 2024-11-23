@extends('layouts.base2')
@section('content')
    <div class="section-title-01 honmob">
                <div class="bg_parallax image_02_parallax"></div>
                <div class="opacy_bg_02">
                    <div class="container">
                        <h1>بيانات الطلب</h1>
                        <div class="crumbs">
                            <ul>
                                <li><a href="/">الطلبات</a></li>
                                <li>/</li>
                                <li>بيانات الطلب</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content-central">
                <div class="semiboxshadow text-center">
                </div>
                <div class="content_info">
                    <div class="paddings-mini">
                        <div class="container">
                            <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2 profile1" style="padding-bottom:40px;">
                                <div class="thinborder-ontop">
                                    <table class="table table-bordered text-center" style="background: #bcb2ea">
                                        <tr>
                                            <td style="background: #d5faca" >
                                                <b style="color: #000">رقم الطلب</b>
                                            </td>
                                            <td style="background: #d5faca" >
                                                <b style="color: #000">{{ $order->order_code }}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #d5faca">
                                                <b style="color: #000">اسم الخدمة</b>
                                            </td>
                                            <td style="background: #d5faca">
                                                {{ $service->name }}
                                            </td>
                                        </tr>
                                    </tr>
                                    <tr>
                                        <td style="background: #d5faca">
                                            <b style="color: #000">سعر الخدمة</b>
                                        </td>
                                        <td style="background: #d5faca">
                                            {{ $service->price * 1 }} SDG
                                        </td>
                                    </tr>
                                    @if(!empty($service->discount))
                                    <tr>
                                        <td style="background: #d5faca">
                                            <b style="color: #502b2b">التخفيض</b>
                                        </td>
                                        <td style="background: #d5faca">
                                            @if($service->discount_type == 'fixed') SDG @else % @endif {{ $service->discount * 1 }} 
                                        </td>
                                    </tr>
                                    @endif
                                        <tr>
                                            <td style="background: #d5faca">
                                                <b style="color: #000">اسم مقدم الخدمة</b>
                                            </td>
                                            <td style="background: #d5faca">
                                                {{ $provider->name }}
                                            </td>
                                        <tr>
                                            <td style="background: #d5faca">
                                                <b style="color: #000">رقم مقدم الخدمة</b>
                                            </td>
                                            <td style="background: #d5faca">
                                                {{ $provider->phone }} - <a href="www.wh.com/{{ $provider->phone }}"><i class="fa fa-whatsapp"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #d5faca">
                                                <b style="color: #000">حالة الطلب</b>
                                            </td>
                                            <td style="background: #d5faca">
                                                @if($order->status == 0)
                                                قيد المراجعة
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #d5faca">
                                                <b style="color: #000">تفاصيل الطلب</b>
                                            </td>
                                            <td style="background: #d5faca;word-wrap: break-word;white-space: normal;">
                                                {{ $order->details }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #d5faca">
                                                <b style="color: #000">تاريخ و وقت حضور العامل</b>
                                            </td>
                                            <td style="background: #d5faca">
                                                {{ $order->time }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #d5faca">
                                                <b style="color: #000">تاريخ انشاء الطلب</b>
                                            </td>
                                            <td style="background: #d5faca">
                                                {{ $order->created_at->format('Y-m-d') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #d5faca" colspan="2">
                                                <a href="#" class="btn btn-danger btn-sm">الغاء الطلب</a>
                                                <a href="#" class="btn btn-success btn-sm">تم اكتمال الانتهاء</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="section-twitter">
                    <i class="fa fa-twitter icon-big"></i>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>             
            </section>
@endsection
@push('scripts')
 @endpush