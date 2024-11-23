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
                    <h1> الخدمات 
                    <a class="btn btn-success btn-sm" href="{{ route('admin.add_service') }}"><i class="fa fa-plus"></i></a>
                    </h1>
                    <div class="crumbs">
                        <ul>
                            <li><a href="/">الرئيسية</a></li>
                            <li>/</li>
                            <li>الخدمات</li>
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
                                        <th class="text-center">#</th>
                                        <th class="text-center">الاسم</th>
                                        <th class="text-center">السعر</th>
                                        <th class="text-center">الحالة</th>
                                        <th class="text-center">القسم</th>
                                        <th class="text-center">تاريخ الانشاء</th>
                                        <th class="text-center">الصورة</th>
                                        <th class="text-center">الاجراءت</th>
                                    </tr>
                                    </thead>
                                    <tbody style="center">
                                        @foreach($services as $service)
                                        <tr>
                                            <td class="text-center">{{ $service->id }}</td>
                                            <td class="text-center">{{ $service->name }}</td>
                                            <td class="text-center">{{ $service->price }}</td>
                                            <td class="text-center">
                                                @if($service->status == 1)
                                                مفعل
                                                @else
                                                غير مفعل
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $service->category->name }}</td>
                                            <td class="text-center">{{ $service->created_at }}</td>
                                            <td class="text-center">
                                            <img class="pull-center" src="{{asset('images/services/thumbnails')}}/{{$service->thumbnail}}" alt="{{$service->name}}" width="80" />
                                            </td>
                                            <td class="text-center">
                                            <a href="{{route('admin.edit_service',['service_slug'=>$service->slug])}}"><i class="fa  fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('هل انت متاكد من عملية الحذف') || event.stopImmediatePropagation()" wire:click.prevent = 'delete({{$service->id}})'><i style="margin-right:10px" class="fa  fa-times fa-2x text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $services->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
