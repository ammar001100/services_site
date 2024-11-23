<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class ServiceCategoryComponent extends Component
{
    public function render()
    {
        $categories = ServiceCategory::all();
        return view('livewire.service-category-component',['categories' => $categories])->layout('layouts.base');
    }
}
