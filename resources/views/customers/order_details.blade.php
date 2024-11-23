@extends('layouts.base2')
@section('content')
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-top: 10px;
        }
        #suggestions {
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            margin-top: 5px;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_01_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>{{ $service->category->name }} - {{ $service->name }}</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">الرئيسية</a></li>
                        <li>/</li>
                        <li><a href="{{ route('home.service_categories') }}">اقسام الخدمات</a></li>
                        <li>/</li>
                        <li><a href="{{ route('home.service_by_category',$service->category->slug) }}">{{ $service->category->name }}</a></li>
                        <li>/</li>
                        <li>{{ $service->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="content-central">
        <div class="semiboxshadow text-center">
            <img src="{{ asset('assets/img/img-theme/shp.png') }}" class="img-responsive" alt="{{ $service->name }}">
        </div>
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <aside class="widget" style="margin-top: 18px;">
                                <div class="panel panel-default">
                                    <div class="panel-heading">تفاصيل الطلب</div>
                                    <div class="panel-body">
                                        
                                            <div class="thinborder-ontop text-center">
                                                <h3>ادخل بيانات الطلب</h3>
                                                @if(Session::has('message'))
                                                <p class="alert alert-success" role="alert">{{Session::get('message')}}</p>
                                                @endif
                                                <!-- <x-validation-errors class="mb-4" /> -->                                    
                                                    <div class="form-group row">
                                                        <label for="time" class="col-md-4 col-form-label text-md-right">توقيت الزيارة</label>
                                                        <div class="col-md-6">
                                                            <input type="date" class="form-control" name="time" id="time">
                                                            @error('slug')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">توضيح المشكلة</label>
                                                        <div class="col-md-6">
                                                            <textarea class="form-control" name="details" id="details"></textarea>
                                                            @error('name')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="image" class="col-md-4 col-form-label text-md-right">صورة توضيحية</label>
                                                        <div class="col-md-6">
                                                            <input type="file" class="form-control" name="image" id="image">
                                                            @error('image')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                            
                                                        </div>
                                                    </div>
                                                
                                            
          
                                        <table class="table">
                                            <tr>
                                                <td style="border-top: none;">السعر</td>
                                                <td style="border-top: none;"><span>&#36;</span>{{ $service->price*1 }}</td>
                                            </tr>
                                            <tr>
                                                <td>الكمية</td>
                                                <td>1</td>
                                            </tr>
                                            @php
                                            $total = $service->price;
                                            @endphp
                                            @if($service->discount)
                                            @if($service->discount_type == 'fixed')
                                            @php
                                            $total = $total - ($total * $service->discount/100)*1;
                                            @endphp
                                            <tr>
                                                <td>التخفيض</td>
                                                <td>${{ $service->discount*1 }}%</td>
                                            </tr>
                                            @elseif($service->discount_type == 'percent')
                                            @php
                                            $total = $total - $service->discount;
                                            @endphp
                                            <tr>
                                                <td>التخفيض</td>
                                                <td>${{ $service->discount*1 }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                @endif
                                                <td>المجموع</td>
                                                <td><span>&#36;</span>{{ $total }}</td>
                                            </tr>
                                        </table>
                                        <div class="form-group row">
                                            <label for="slug" class="col-md-4 col-form-label text-md-right">اختر مقدم الخدمة</label>
                                            <div class="col-md-12">
                                                <input type="hidden" value="{{ $service->id }}" name="service_id" id="service_id">
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="col-md-6 single-blog text-right">
                            <div class="post-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="post-header">   
                                            <div class="post-info-wrap">
                                                <h2 class="post-title"><a href="#" title="Post Format: Standard"
                                                        rel="bookmark"> <i class="fa fa-circle"></i> اسم الخدمة - {{ $service->name }}</a></h2>
                                                <div class="post-meta" style="height: 10px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="">
                                            <div class="img-hover">
                                                <img src="{{ asset('images/services'.'/'.$service->image) }}" alt=""
                                                    class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="post-content">
                                            <h3>توضيح الخدمة</h3>
                                            <p>{{ $service->description }}</p><br>
                                            <h4>الخدمة تتضمن</h4>
                                            <ul class="list-styles">
                                                @foreach (explode("|",$service->inclusion) as $inclusion)
                                                <li><i class="fa fa-plus"></i> {{ $inclusion }} </li>
                                                @endforeach
                                            </ul>
                                            <h4>الخدمة لا تتضمن</h4>
                                            <ul class="list-styles">
                                                @foreach (explode("|",$service->exclusion) as $exclusion)
                                                <li><i class="fa fa-minus"></i> {{ $exclusion }} </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    var action = "{{ route('customer.order_save') }}";
    var service_id = {{ $service['id'] }};
    var map = L.map('map').setView([{{ $userLocation['lat'] }}, {{ $userLocation['lon'] }}], 13); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var userIcon = L.icon({
        iconUrl: "{{ asset('assets/img/favicon.png') }}",
        iconSize: [30, 30],
        iconAnchor: [22, 38],
    });

    L.marker([{{ $userLocation['lat'] }}, {{ $userLocation['lon'] }}], {icon: userIcon}).addTo(map)
        .bindPopup('موقعك الحالي')
        .openPopup();

    var serviceProviders = @json($serviceProviders);

    serviceProviders.forEach(function(provider) {
            
            var popupContent = `
                <b>${provider.name}</b><br>
                المسافة: ${provider.distance.toFixed(2)} كم<br>
                <form action="${  action  }" method="POST" enctype="multipart/form-data" onsubmit="return setHiddenFields(this)">
                    @csrf
                    <input type="hidden" name="provider_id" value="${provider.id}">
                    <input type="hidden" name="service_id" value="${service_id}">
                    <input type="hidden" name="time" value="${time}">
                    <input type="hidden" name="details" value="${details}">
                    <input type="hidden" name="image" value="${image}">
                    <button class="btn btn-success btn-sm" type="submit">طلب الخدمة</button>
                </form>
            `;
            var marker = L.marker([provider.lat,provider.lon]).addTo(map)
                .bindPopup(popupContent);
        });
        function setHiddenFields(form){
            form.time.value = document.getElementById('time').value;
            form.details.value = document.getElementById('details').value;
            var imageInput = form.image.value = document.getElementById('image').value;
            var file = imageInput.files[0];
            if(file){
                var reader = new FileReader();
                reader.onloadend = function(){
                    form.image.value = reader.result;
                }
            reader.readAsDataURL(file);
            }
            return true;
        }

</script>
 @endpush