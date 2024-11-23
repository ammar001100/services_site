<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddSliderComponet extends Component
{
    use WithFileUploads;
    public $title;
    public $status = 1;
    public $image;
    public function updated($felds){
        $this->validateOnly($felds,[
            'title'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg',
        ]);
    }
    public function create(){
        $this->validate([
            'title'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg',
        ]);
        $slider = new Slider();
        $slider->title = $this->title;
        $slider->status = $this->status;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('sliders',$imageName);
        $slider->image = $imageName;
        $slider->save();
        session()->flash('message','تم حفظ الشريط المنزلق بنجاح');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-slider-componet')->layout('layouts.base');
    }
}
