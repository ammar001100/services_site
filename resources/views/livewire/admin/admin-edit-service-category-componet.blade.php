<div>
  <div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>تعديل قسم خدمات </h1>
           <div class="crumbs">
              <ul>
                <li><a href="/">الرئيسية</a></li>
                <li>/</li>
                <li>مدير النظام</li>
                <li>/</li>
                <li><a href="{{ route('admin.service_categories') }}">اقسام الخدمات</a></li>
                <li>/</li>
                <li>تعديل  قسم </li>
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
                        <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 profile1" style="padding-bottom:40px;">
                            <div class="thinborder-ontop text-center">
                                <h3>ادخل بيانات قسم الخدمات</h3>
                                @if(Session::has('message'))
                                <p class="alert alert-success" role="alert">{{Session::get('message')}}</p>
                                @endif
                                <x-validation-errors class="mb-4" />
                                <form id="userregisterationform" enctype="multipart/form-data" wire:submit.prevent="update">
                                    @csrf                                    
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">اسم القسم</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" autofocus wire:model="name" wire:keyup="generateSlug">
                                            @error('name')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="slug" class="col-md-4 col-form-label text-md-right">Slug</label>
                                        <div class="col-md-6">
                                            <input id="slug" type="slug" class="form-control" name="slug" autofocus wire:model="slug">
                                            @error('slug')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="image" class="col-md-4 col-form-label text-md-right">الصورة</label>
                                        <div class="col-md-6">
                                            <input id="image" type="file" class="form-control" name="image" autofocus wire:model="newImage">
                                            @error('newImage')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            @if($newImage)
                                            <img src="{{$newImage->temporaryUrl()}}" width="60" />
                                            @else
                                            <img src="{{asset('images\categories')}}/{{$image}}" width="60" />
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-success pull-center">تحديث</button>
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
</div>
