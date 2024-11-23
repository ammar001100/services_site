<div>
    <div class="section-title-01 honmob">
      <div class="bg_parallax image_02_parallax"></div>
      <div class="opacy_bg_02">
          <div class="container">
              <h1>اضافة شريط منزلق</h1>
             <div class="crumbs">
                <ul>
                  <li><a href="/">الرئيسية</a></li>
                  <li>/</li>
                  <li>مدير النظام</li>
                  <li>/</li>
                  <li><a href="{{ route('admin.sliders') }}">الشريط المنزلق</a></li>
                  <li>/</li>
                  <li>اضافة  شريط منزلق جديد</li>
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
                                  <h3>ادخل بيانات الشريط المنزلق</h3>
                                  @if(Session::has('message'))
                                  <p class="alert alert-success" role="alert">{{Session::get('message')}}</p>
                                  @endif
                                  <!-- <x-validation-errors class="mb-4" /> -->
                                  <form id="userregisterationform" enctype="multipart/form-data" wire:submit.prevent="create">
                                      @csrf                                    
                    
                                      <div class="form-group row">
                                        <label for="title" class="col-md-4 col-form-label text-md-right">العنوان</label>
                                        <div class="col-md-6">
                                            <input id="title" type="text" class="form-control" name="title" autofocus wire:model="title">
                                            @error('title')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row">
                                        <label for="status"
                                            class="col-md-4 col-form-label text-md-right">الحالة</label>
                                        <div class="col-md-6">
                                            <select id="status" class="form-control" name="status" wire:model="status">
                                                <option value="1">مفعل</option> 
                                                <option value="0">غير مفعل</option> 
                                            </select>
                                        </div>
                                    </div>
  
                                      <div class="form-group row">
                                        <label for="image" class="col-md-4 col-form-label text-md-right">الصورة</label>
                                        <div class="col-md-6">
                                            <input id="image" type="file" class="form-control" name="image" autofocus wire:model="image">
                                            @error('image')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            @if($image)
                                            <img src="{{$image->temporaryUrl()}}" width="60" />
                                            @endif
                                        </div>
                                    </div>
  
                                      <div class="form-group row mb-0">
                                          <div class="col-md-10">
                                              <button type="submit" class="btn btn-success pull-center">اضافة</button>
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
  