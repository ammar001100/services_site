<!-- @push('scc')
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" /> 
@endpush -->
<div>
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
                                                <form method="POST" action="{{ route('customer.order_create') }}" enctype="multipart/form-data" >
                                                    @csrf                                    
                                                    <div class="form-group row">
                                                        <label for="slug" class="col-md-4 col-form-label text-md-right">توقيت الزيارة</label>
                                                        <div class="col-md-6">
                                                            <input id="slug" type="date" class="form-control" name="time" autofocus wire:model="slug">
                                                            @error('slug')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">توضيح المشكلة</label>
                                                        <div class="col-md-6">
                                                            <textarea id="name" class="form-control" name="details"></textarea>
                                                            @error('name')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="image" class="col-md-4 col-form-label text-md-right">صورة توضيحية</label>
                                                        <div class="col-md-6">
                                                            <input id="image" type="file" class="form-control" name="image">
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
                                            <label for="slug" class="col-md-4 col-form-label text-md-right">موقع المنزل </label>
                                            <div class="col-md-12">
                                                <input type="hidden" value="{{ $service->id }}" name="service_id" id="service_id">
                                                <input type="text" id="placeInput" placeholder="أدخل اسم الموقع">
                                                <input type="hidden" name="lat" id="latInput"> <!-- حقل إدخال مخفي لتخزين خط العرض -->
                                                <input type="hidden" name="lon" id="lonInput"> <!-- حقل إدخال مخفي لتخزين خط الطول -->
                                                <input type="hidden" name="country" id="countryInput"> <!-- حقل إدخال مخفي لتخزين الدولة -->
                                                <input type="hidden" name="state" id="stateInput"> <!-- حقل إدخال مخفي لتخزين الولاية -->
                                                <input type="hidden" name="city" id="cityInput"> <!-- حقل إدخال مخفي لتخزين المدينة -->
                                                <input type="hidden" name="suburb" id="suburbInput"> <!-- حقل إدخال مخفي لتخزين الضاحية -->
                                                <input type="hidden" name="postcode" id="postcodeInput"> <!-- حقل إدخال مخفي لتخزين الرمز البريدي -->
                                                <input type="hidden" name="street" id="streetInput"> <!-- حقل إدخال مخفي لتخزين الشارع -->
                                                <div id="suggestions"></div>
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">                                            
                                            <button type="submit" class="btn btn-primary">ارسال الطلب</button>
                                        </form>
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
    
</div>
@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    $(document).ready(function() {
            var map = L.map('map').setView([15.5932, 32.5341], 13); // تحديد الإحداثيات الافتراضية لأم درمان، السودان

            // إضافة طبقة الخريطة من MapTiler للصور الجوية
            L.tileLayer('https://api.maptiler.com/maps/hybrid/{z}/{x}/{y}.jpg?key=p9s9T1NDSwDhhgVKcrkz', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://www.maptiler.com/">MapTiler</a>',
                maxZoom: 20,
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(map);

            var marker = L.marker([15.5932, 32.5341], { draggable: true }).addTo(map); // ماركر يمكن سحبه

            // تحديث حقول الإدخال المخفية عند سحب الماركر
            marker.on('dragend', function(e) {
                var lat = e.target.getLatLng().lat;
                var lon = e.target.getLatLng().lng;
                updateHiddenInputs(lat, lon);
            });

            function updateHiddenInputs(lat, lon, address) {
                $('#latInput').val(lat);
                $('#lonInput').val(lon);
                $('#countryInput').val(address && address.country || '');
                $('#stateInput').val(address && address.state || '');
                $('#cityInput').val(address && (address.city || address.town || address.village) || '');
                $('#suburbInput').val(address && address.suburb || '');
                $('#postcodeInput').val(address && address.postcode || '');
                $('#streetInput').val(address && address.road || '');
            }

            function searchPlace(placeName) {
                let url = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(placeName)}&format=json&addressdetails=1`;

                $.get(url, function(data) {
                    let suggestionsContainer = $('#suggestions');
                    suggestionsContainer.empty();

                    if (data.length === 0) {
                        suggestionsContainer.append('<p>الموقع غير موجود</p>');
                    } else {
                        data.forEach(function(suggestion) {
                            let item = $('<div class="suggestion-item"></div>').text(suggestion.display_name);
                            item.click(function() {
                                $('#placeInput').val(suggestion.display_name);
                                updateHiddenInputs(suggestion.lat, suggestion.lon, suggestion.address);
                                suggestionsContainer.empty();
                                showLocationOnMap(suggestion);
                            });
                            suggestionsContainer.append(item);
                        });
                    }
                });
            }

            function showLocationOnMap(location) {
                if (marker) {
                    marker.setLatLng([location.lat, location.lon]); // تحديث موقع الماركر
                } else {
                    marker = L.marker([location.lat, location.lon], { draggable: true }).addTo(map); // إنشاء ماركر جديد
                    marker.on('dragend', function(e) {
                        var lat = e.target.getLatLng().lat;
                        var lon = e.target.getLatLng().lng;
                        updateHiddenInputs(lat, lon);
                    });
                }
                map.setView([location.lat, location.lon], 13);
            }

            // تحديد الموقع الجغرافي الحالي إذا كان متاحاً
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    updateHiddenInputs(lat, lon);
                    map.setView([lat, lon], 13);
                    marker.setLatLng([lat, lon]); // تحديث موقع الماركر

                    // البحث عن العنوان بناءً على الإحداثيات
                    let url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1`;
                    $.get(url, function(data) {
                        if (data && data.address) {
                            updateHiddenInputs(lat, lon, data.address);
                        }
                    });
                }, function(error) {
                    console.error("خطأ في الحصول على الموقع:", error.message);
                });
            } else {
                console.warn("المتصفح لا يدعم خدمة تحديد الموقع الجغرافي.");
            }

            $('#placeInput').on('input', function() {
                let placeName = $(this).val().trim();
                if (placeName.length > 0) {
                    searchPlace(placeName);
                } else {
                    $('#suggestions').empty();
                }
            });
        });
    </script>    
 @endpush