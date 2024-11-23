<div>
    <div class="section-title-01 honmob">
      <div class="bg_parallax image_02_parallax"></div>
      <div class="opacy_bg_02">
          <div class="container">
              <h1>تعديل خدمة </h1>
             <div class="crumbs">
                <ul>
                  <li><a href="/">الرئيسية</a></li>
                  <li>/</li>
                  <li>مدير النظام</li>
                  <li>/</li>
                  <li><a href="{{ route('admin.services') }}">الخدمات</a></li>
                  <li>/</li>
                  <li>تعديل</li>
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
                                  <h3>ادخل بيانات الخدمة للتعديل</h3>
                                  @if(Session::has('message'))
                                  <p class="alert alert-success" role="alert">{{Session::get('message')}}</p>
                                  @endif
                                  <!-- <x-validation-errors class="mb-4" /> -->
                                  <form id="userregisterationform" enctype="multipart/form-data" wire:submit.prevent="update">
                                      @csrf                                    
                                      <div class="form-group row">
                                          <label for="name" class="col-md-4 col-form-label text-md-right">اسم الخدمة</label>
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
                                        <label for="tagline" class="col-md-4 col-form-label text-md-right">العلامة التجارية</label>
                                        <div class="col-md-6">
                                            <input id="tagline" type="text" class="form-control" name="tagline" autofocus wire:model="tagline">
                                            @error('tagline')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="service_category_id"
                                            class="col-md-4 col-form-label text-md-right">القسم</label>
                                        <div class="col-md-6">
                                            <select id="service_category_id" class="form-control" name="service_category_id" wire:model="service_category_id" wire:keyup="generateSlug">
                                                <option value="">اختر القسم</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="price" class="col-md-4 col-form-label text-md-right">السعر</label>
                                        <div class="col-md-6">
                                            <input id="price" type="number" class="form-control" name="price" autofocus wire:model="price">
                                            @error('price')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="discount_type"
                                            class="col-md-4 col-form-label text-md-right">نوع التخفيض</label>
                                        <div class="col-md-6">
                                            <select id="discount_type" class="form-control" name="discount_type" wire:model="discount_type">
                                                <option value="fixed">ثابت</option>
                                                <option value="percent">في المئة</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="discount" class="col-md-4 col-form-label text-md-right">التخفيض</label>
                                        <div class="col-md-6">
                                            <input id="discount" type="number" class="form-control" name="discount" autofocus wire:model="discount">
                                            @error('discount')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">التفصيل</label>
                                        <div class="col-md-6">
                                            <textarea id="description" type="text" class="form-control" name="description" autofocus wire:model="description"></textarea>
                                            @error('description')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inclusion" class="col-md-4 col-form-label text-md-right">تضمين</label>
                                        <div class="col-md-6">
                                            <textarea id="inclusion" type="text" class="form-control" name="inclusion" autofocus wire:model="inclusion"></textarea>
                                            @error('inclusion')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exclusion" class="col-md-4 col-form-label text-md-right">استبعاد</label>
                                        <div class="col-md-6">
                                            <textarea id="exclusion" type="text" class="form-control" name="exclusion" autofocus wire:model="exclusion"></textarea>
                                            @error('exclusion')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
  
                                      <div class="form-group row">
                                          <label for="newthumbnail" class="col-md-4 col-form-label text-md-right">الصورة المصغرة</label>
                                          <div class="col-md-6">
                                              <input id="newthumbnail" type="file" class="form-control" name="newthumbnail" autofocus wire:model="newthumbnail">
                                              @error('newthumbnail')
                                              <p class="text-danger">{{$message}}</p>
                                              @enderror
                                              @if($newthumbnail)
                                              <img src="{{$newthumbnail->temporaryUrl()}}" width="60" />
                                              @else
                                              <img src="{{ asset('images/services/thumbnails') }}/{{ $thumbnail }}" width="60" />
                                              @endif
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="newimage" class="col-md-4 col-form-label text-md-right">الصورة</label>
                                        <div class="col-md-6">
                                            <input id="newimage" type="file" class="form-control" name="newimage" autofocus wire:model="newimage">
                                            @error('newimage')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            @if($newimage)
                                            <img src="{{$newimage->temporaryUrl()}}" width="60" />
                                            @else
                                              <img src="{{ asset('images/services') }}/{{ $image }}" width="60" />
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
  