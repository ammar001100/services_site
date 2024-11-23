<?php

namespace App\Livewire\Admin;

use App\Models\ServiceCategory;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Service;
use Livewire\WithFileUploads;

class AdminAddServiceComponet extends Component
{
    use WithFileUploads;
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
            'thumbnail'=>'required|mimes:jpg,png,jpeg',
            'image'=>'required|mimes:jpg,png,jpeg',
        ]);
    }
    public function create(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required',
            'tagline'=>'required',
            'service_category_id'=>'required',
            'price'=>'required',
            'description'=>'required',
            'inclusion'=>'required',
            'exclusion'=>'required',
            'thumbnail'=>'required|mimes:jpg,png,jpeg',
            'image'=>'required|mimes:jpg,png,jpeg',
        ]);
        $service = new Service();
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

        $thumbnailName = Carbon::now()->timestamp.'.'.$this->thumbnail->extension();
        $this->thumbnail->storeAs('services/thumbnails',$thumbnailName);
        $service->thumbnail = $thumbnailName;

        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('services',$imageName);
        $service->image = $imageName;
        $service->save();
        session()->flash('message','تم حفظ الخدمة بنجاح');
    }
    public function render()
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-add-service-componet',['categories'=>$categories])->layout('layouts.base');
    }
}
