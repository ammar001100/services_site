<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ServiceCategory;

class AdminServiceCategoryComponet extends Component
{
    public function deleteServiceCategory($id)
    {
        $scatygory = ServiceCategory::find($id);
        If($scatygory){
            If($scatygory->image){
                unlink('images/categories'.'/'.$scatygory->image);
            }
            $scatygory->delete();
            session()->flash('message','تم حذف قسم الخدمات بنجاح');
        }else{
            session()->flash('message','عفوا القسم غير موجود');
        }        
    }
    public function render()
    {
        $categories = ServiceCategory::paginate(10);
        return view('livewire.admin.admin-service-category-componet',['categories' => $categories])->layout('layouts.base');
    }
}
