
<x-base-layout>
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
            <div class="bg_parallax image_02_parallax"></div>
            <div class="opacy_bg_02">
                <div class="container">
                    <h1>Registeration</h1>
                    <div class="crumbs">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li>/</li>
                            <li>Registeration</li>
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
                        <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 profile1 text-right" style="padding-bottom:40px;">
                            <div class="thinborder-ontop">
                                <h3>ادخل بياناتك للتسجيل</h3>
                                <x-validation-errors class="mb-4" />
                                <form id="userregisterationform" method="POST" action="{{ route('register') }}">
                                    @csrf                                    
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">الاسم</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" :value="old('name')" required autofocus autocomplete="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكتروني</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autofocus autocomplete="email">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">رقم الهاتف</label>
                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control" name="phone" :value="old('phone')" required autofocus autocomplete="phone">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">كلمة المرور</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label text-md-right">اعادة كلمة المرور</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="registers"
                                            class="col-md-4 col-form-label text-md-right">التسجيل ك</label>
                                        <div class="col-md-6">
                                            <select id="registers" class="form-control" name="registers">
                                                <option value="CST">مستخدم</option>
                                                <option value="SVP">مقدم خدمة</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <h1>حدد موقعك</h1>
                                    <div class="text-center">
                                    <input type="text" id="placeInput" placeholder="أدخل اسم الموقع">
                                    <input type="hidden" name="lat" id="lat"> <!-- حقل إدخال مخفي لتخزين خط العرض -->
                                    <input type="hidden" name="lon" id="lon"> <!-- حقل إدخال مخفي لتخزين خط الطول -->
                                    <div id="suggestions"></div>
                                    <div id="map"></div>
                                    </div>
                                    <br>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-10">
                                            <span class="pull-left" style="font-size: 18px;">تسجيل جديد<a
                                                    href="login.html" title="Login"> اضط هنا</a></span>
                                            <button type="submit" class="btn btn-primary pull-right"> تسجيل</button>
                                        </div>
                                    </div>
                                </form>
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
        @push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {
            var map = L.map('map').setView([15.5932, 32.5341], 13); // تحديد الإحداثيات الافتراضية لأم درمان، السودان

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            var marker = L.marker([15.5932, 32.5341], { draggable: true }).addTo(map); // ماركر يمكن سحبه

            // تحديث حقول الإدخال المخفية عند سحب الماركر
            marker.on('dragend', function(e) {
                var lat = e.target.getLatLng().lat;
                var lon = e.target.getLatLng().lng;
                $('#lat').val(lat);
                $('#lon').val(lon);
            });

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
                                $('#lat').val(suggestion.lat);
                                $('#lon').val(suggestion.lon);
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
                        $('#lat').val(lat);
                        $('#lon').val(lon);
                    });
                }
                map.setView([location.lat, location.lon], 13);
            }

            // تحديد الموقع الجغرافي الحالي إذا كان متاحاً
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    $('#lat').val(lat);
                    $('#lon').val(lon);
                    map.setView([lat, lon], 13);
                    marker.setLatLng([lat, lon]); // تحديث موقع الماركر
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
</x-base-layout>
