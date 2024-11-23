<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;
use Livewire\WithFileUploads;

class AdminAddServiceCategoryComponet extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $image;
    public function generateSlug(){
        $this->slug = Str::slug($this->name,'-');
    }
    public function updated($felds){
        $this->validateOnly($felds,[
            'name'=>'required',
            'slug'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg',
        ]);
    }
    public function create(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg',
        ]);
        $category = new ServiceCategory();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('categories',$imageName);
        $category->image = $imageName;
        $category->save();
        session()->flash('message','تم حفظ القسم بنجاح');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-service-category-componet')->layout('layouts.base');
    }
}
