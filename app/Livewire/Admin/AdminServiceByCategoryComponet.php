<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServiceByCategoryComponet extends Component
{
    use WithPagination;
    public $category_slug;
    public function mount($category_slug){
        $this->category_slug = $category_slug;
    }

    public function render()
    {
        $category = ServiceCategory::where('slug',$this->category_slug)->first();
        $services = Service::where('service_category_id',$category->id)->paginate(10);
        return view('livewire.admin.admin-service-by-category-componet',['category_name'=>$category->name,'services'=>$services])->layout('layouts.base');
    }
}
