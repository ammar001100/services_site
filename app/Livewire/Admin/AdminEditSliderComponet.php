<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminEditSliderComponet extends Component
{
    use WithFileUploads;
    public $id;
    public $title;
    public $status;
    public $image;
    public $newimage;
    public function mount($id){
        $slider = Slider::find($id);
        $this->id = $slider->id;
        $this->title = $slider->title;
        $this->status = $slider->status;
        $this->image = $slider->image;
    }
    public function updated($felds){
        $this->validateOnly($felds,[
            'title'=>'required',
        ]);
        if($this->newimage){
            $this->validate([
                'newimage'=>'required|mimes:jpg,png,jpeg',
            ]);
        }
    }
    public function update(){
        $slider = Slider::find($this->id);
        $slider->title = $this->title;
        $slider->status = $this->status;
        if($this->newimage){
            unlink('images/sliders'.'/'.$slider->image);
            $newimage = Carbon::now()->timestamp.'.'.$this->newimage->extension();
        $this->newimage->storeAs('sliders',$newimage);
        $slider->image = $newimage;
        }
        $slider->update();
        session()->flash('message','تم تحديث الشريط المنزلق بنجاح');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-slider-componet')->layout('layouts.base');
    }
}
