<div>
<div class="section-title-01 honmob">
            <div class="bg_parallax image_01_parallax"></div>
            <div class="opacy_bg_02">
                <div class="container">
                    <h1>جميع الاقسام</h1>
                    <div class="crumbs">
                        <ul>
                            <li><a href="/">الرئيسية</a></li>
                            <li>/</li>
                            <li>اقسام الخدمات</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="content-central">
            <div class="content_info" style="margin-top: -70px;">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="services-lines full-services">
                            @foreach($categories as $category)
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="{{ route('home.service_by_category',['category_slug'=>$category->slug]) }}"><img class="icon-img"
                                                src="{{asset('images/categories')}}/{{$category->image}}" alt="{{$category->name}}"></a></i>
                                    <h5>{{$category->name}}</h5>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content_info content_resalt">
                <div class="container">
                    <div class="row">
                        <div class="titles">
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
