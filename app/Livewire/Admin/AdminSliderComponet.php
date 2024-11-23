<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSliderComponet extends Component
{
    use WithPagination;
    public function delete($id){
        $slider = Slider::find($id);
        unlink('images/sliders'.'/'.$slider->image);
        $slider->delete();
        session()->flash('message','تم حذف الشريط المنزلق بنجاح');
    }
    public function render()
    {
        $sliders = Slider::paginate(10);
        return view('livewire.admin.admin-slider-componet',['sliders'=>$sliders])->layout('layouts.base');
    }
}
