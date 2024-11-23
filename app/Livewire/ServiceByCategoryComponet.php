<?php

namespace App\Livewire;

use App\Models\ServiceCategory;
use Livewire\Component;

class ServiceByCategoryComponet extends Component
{
    public $category_slug;
    public function mount($category_slug){
        $this->category_slug = $category_slug;
    }
    public function render()
    {
        $scategory = ServiceCategory::where('slug',$this->category_slug)->first();
        return view('livewire.service-by-category-componet',['scategory'=>$scategory])->layout('layouts.base');
    }
}
