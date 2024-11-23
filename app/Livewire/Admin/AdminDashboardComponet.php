<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminDashboardComponet extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-dashboard-componet')->layout('layouts.base');
    }
}
