<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServiceComponet extends Component
{
    use WithPagination;
    public function delete($service_id){
        $service = Service::find($service_id);
        if($service->humbnail){
            unlink('images/services/thumbnails'.'/'.$service->thumbnail);
        }
        if($service->image){
            unlink('images/services'.'/'.$service->image);
        }
        $service->delete();
        session()->flash('message','تم حذف الخدمة بنجاح');
    }
    public function render()
    {
        $services = Service::paginate(10);
        return view('livewire.admin.admin-service-componet',['services'=>$services])->layout('layouts.base');
    }
}
