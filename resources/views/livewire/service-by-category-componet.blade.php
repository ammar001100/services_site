<div>
        <div class="section-title-01 honmob">
            <div class="bg_parallax image_01_parallax"></div>
            <div class="opacy_bg_02">
                <div class="container">
                    <h1>خدمات - {{ $scategory->name }}</h1>
                    <div class="crumbs">
                        <ul>
                            <li><a href="index.html">الرئيسية</a></li>
                            <li>/</li>
                            <li><a href="{{ route('home.service_categories') }}">اقسام الخدمات</a></li>
                            <li>/</li>
                            <li>{{ $scategory->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="content-central">
            <div class="content_info" style="margin-top: -70px;">
                <div>
                    <div class="container">
                        <div style="display:flex">
                            @if($scategory->services->count() > 0)
                                @foreach ($scategory->services as $service)
                            <div class="col-xs-6 col-sm-4 col-md-3 nature hsgrids"
                                style="padding-right: 5px;padding-left: 5px;;padding-top: 5px;">
                                <a class="g-list" href="{{ route('customer.order_details',$service->slug) }}">
                                    <div class="img-hover">
                                        <img src="{{ asset('images/services/thumbnails') }}/{{ $service->thumbnail }}" alt="{{ $service->name }}"
                                            class="img-responsive">
                                    </div>
                                    <div class="info-gallery">
                                        <h3>{{ $service->name }}</h3>
                                        <hr class="separator">
                                        <p>{{ $service->tagline }}</p>
                                        <div class="content-btn"><a href="{{ route('customer.order_details',$service->slug) }}"
                                                class="btn btn-primary">اطلب الان</a></div>
                                        <div class="price"><span>&#36;</span><b>السعر</b>{{ $service->price }}</div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            @else
                               <div class="col-md-12"><p class="alear alert-danger text-center h3">لا توجد خدمات حاليا</p></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>            
        </section>
    </div>