<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditServiceComponet extends Component
{
    use WithFileUploads;
    public $id;
    public $name;
    public $slug;
    public $tagline;
    public $service_category_id;
    public $price;
    public $discount_type;
    public $discount;
    public $description;
    public $inclusion;
    public $exclusion;
    public $thumbnail;
    public $image;

    public $newthumbnail;
    public $newimage;

    public function mount($service_slug){
        $service = Service::where('slug',$service_slug)->first();
        $this->id = $service->id;
        $this->name = $service->name;
        $this->tagline = $service->tagline;
        $this->slug = $service->slug;
        $this->service_category_id = $service->service_category_id;
        $this->price = $service->price;
        $this->discount_type = $service->discount_type;
        $this->discount = $service->discount;
        $this->description = $service->description;
        $this->inclusion = str_replace("|","\n", $service->inclusion);
        $this->exclusion = str_replace("|","\n",$service->exclusion);

        $this->thumbnail = $service->thumbnail;
        $this->image = $service->image;

        //$this->newthumbnail = $service->newthumbnail;
        //$this->newimage = $service->newimage;
    }
    public function generateSlug(){
        $this->slug = Str::slug($this->name,'-');
    }
    public function updated($felds){
        $this->validateOnly($felds,[
            'name'=>'required',
            'slug'=>'required',
            'tagline'=>'required',
            'service_category_id'=>'required',
            'price'=>'required',
            'description'=>'required',
            'inclusion'=>'required',
            'exclusion'=>'required',
        ]);
        if($this->newthumbnail){
            $this->validateOnly($felds,[
                'newthumbnail'=>'required|mimes:jpg,png,jpeg',
            ]);
        }
        if($this->newimage){
            $this->validateOnly($felds,[
                'newimage'=>'required|mimes:jpg,png,jpeg',
            ]);
        }
    }
    public function update(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required',
            'tagline'=>'required',
            'service_category_id'=>'required',
            'price'=>'required',
            'description'=>'required',
            'inclusion'=>'required',
            'exclusion'=>'required',
        ]);
        if($this->newthumbnail){
            $this->validate([
                'newthumbnail'=>'required|mimes:jpg,png,jpeg',
            ]);
        }
        if($this->newimage){
            $this->validate([
                'newimage'=>'required|mimes:jpg,png,jpeg',
            ]);
        }
        $service = Service::find($this->id);
        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->tagline = $this->tagline;
        $service->service_category_id = $this->service_category_id;
        $service->price = $this->price;
        $service->discount_type = $this->discount_type;
        $service->discount = $this->discount;
        $service->description = $this->description;
        $service->inclusion = str_replace("\n",'|',trim($this->inclusion));
        $service->exclusion = str_replace("\n",'|',trim($this->exclusion));

        if($this->newthumbnail){
            unlink('images/services/thumbnails'.'/'.$service->thumbnail);
            $newthumbnail = Carbon::now()->timestamp.'.'.$this->newthumbnail->extension();
        $this->newthumbnail->storeAs('services/thumbnails',$newthumbnail);
        $service->thumbnail = $newthumbnail;
        }
        
        if($this->newimage){
            unlink('images/services'.'/'.$service->image);
            $newimage = Carbon::now()->timestamp.'.'.$this->newimage->extension();
        $this->newimage->storeAs('services',$newimage);
        $service->image = $newimage;
        }

        $service->update();
        session()->flash('message','تم تحديث الخدمة بنجاح');
    }
    public function render()
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-edit-service-componet',['categories'=>$categories])->layout('layouts.base');
    }
}
