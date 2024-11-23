<?php

namespace App\Livewire;

use App\Models\ServiceCategory;
use App\Models\Slider;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $scategory = ServiceCategory::inRandomOrder()->take(8)->get();
        $sliders = Slider::where('status',1)->get();
        return view('livewire.home-component',['scategory'=>$scategory,'sliders'=>$sliders])->layout('layouts.base');
    }
}
