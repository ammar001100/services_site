<div>
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
                    <h1>اقسام الخدمات 
                    <a class="btn btn-success btn-sm" href="{{ route('admin.add_service_categories') }}"><i class="fa fa-plus"></i></a>
                    </h1>
                    <div class="crumbs">
                        <ul>
                            <li><a href="/">الرئيسية</a></li>
                            <li>/</li>
                            <li>مدير النظام / اقسام الخدمات</li>
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
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th class="text-center">الصورة</th>
                                        <th>Slug</th>
                                        <th>الاجراءت</th>
                                    </tr>
                                    </thead>
                                    <tbody style="center">
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                            <img class="pull-center" src="{{asset('images/categories')}}/{{$category->image}}" alt="{{$category->name}}" width="80" />
                                            </td>
                                            <td>{{ $category->slug }}</td>
                                            <td>
                                            <a href="{{route('admin.edit_service_category',['id'=>$category->id])}}"><i class="fa  fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('هل انت متاكد من عملية الحذف') || event.stopImmediatePropagation()" wire:click.prevent = 'deleteServiceCategory({{$category->id}})'><i style="margin-right:10px" class="fa  fa-times fa-2x text-danger"></i></a>
                                            <a href="{{route('admin.services_by_category',['category_slug'=>$category->slug])}}" style="margin-right: 10px;"><i class="fa  fa-list fa-2x"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
