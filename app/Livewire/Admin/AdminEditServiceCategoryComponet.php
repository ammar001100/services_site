<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;
use Livewire\WithFileUploads;

class AdminEditServiceCategoryComponet extends Component
{
    use WithFileUploads;
    public $id;
    public $name;
    public $slug;
    public $image;
    public $newImage;

    public function mount($id){
        $category = ServiceCategory::find($id);
        $this->id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image;
    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name,'-');
    }
    
    public function updated($felds){
        $this->validateOnly($felds,[
            'name'=>'required',
            'slug'=>'required',
        ]);
        if($this->newImage){
            $this->validateOnly($felds,[
                'newImage'=>'required|mimes:jpg,png,jpeg',
            ]);
        }
    }

    public function update(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required',
        ]);
        if($this->newImage){
            $this->validate([
                'newImage'=>'required|mimes:jpg,png,jpeg',
            ]);
        }
        $category = ServiceCategory::find($this->id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        if($this->newImage){
            unlink('images/categories'.'/'.$category->image);
            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('categories',$imageName);
            $category->image = $imageName;    
        };
        $category->save();
        session()->flash('message','تم تحديث القسم بنجاح');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-service-category-componet')->layout('layouts.base');
    }
}
