<?php

use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Customer\CustomerServiceController;
use App\Http\Controllers\SearchController;
use App\Livewire\Admin\AdminAddServiceCategoryComponet;
use App\Livewire\Admin\AdminAddServiceComponet;
use App\Livewire\Admin\AdminAddSliderComponet;
use App\Livewire\Admin\AdminDashboardComponet;
use App\Livewire\Admin\AdminEditServiceCategoryComponet;
use App\Livewire\Admin\AdminEditServiceComponet;
use App\Livewire\Admin\AdminEditSliderComponet;
use App\Livewire\Admin\AdminServiceByCategoryComponet;
use App\Livewire\Admin\AdminServiceCategoryComponet;
use App\Livewire\Admin\AdminServiceComponet;
use App\Livewire\Admin\AdminSliderComponet;
use App\Livewire\Customer\CustomerDashboardComponent;
use App\Livewire\HomeComponent;
use App\Livewire\ServiceByCategoryComponet;
use App\Livewire\ServiceCategoryComponent;
use App\Livewire\ServiceDetailsComponet;
use App\Livewire\Sprovider\SproviderDashboardComponent;
use Illuminate\Support\Facades\Route;






//For Index 
Route::get('/',HomeComponent::class)->name('home');
Route::get('/service-categories',ServiceCategoryComponent::class)->name('home.service_categories');
Route::get('/{category_slug}/service',ServiceByCategoryComponet::class)->name('home.service_by_category');
Route::get('/service/{service_slug}',ServiceDetailsComponet::class)->name('home.service_details');
Route::get('/auto_complete',[SearchController::class,'autoComplete'])->name('auto_complete');
Route::post('/search_service',[SearchController::class,'searchService'])->name('search_service');
//For Auth
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',HomeComponent::class)->name('dashboard');
});

//For Admin
Route::middleware([
    'auth:sanctum','auth_admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin/dashboard',AdminDashboardComponet::class)->name('admin.dashboard');
    Route::get('admin/service-categories',AdminServiceCategoryComponet::class)->name('admin.service_categories');
    Route::get('admin/add-service-categories',AdminAddServiceCategoryComponet::class)->name('admin.add_service_categories');
    Route::get('admin/service-category/edit/{id}',AdminEditServiceCategoryComponet::class)->name('admin.edit_service_category');
    Route::get('admin/services',AdminServiceComponet::class)->name('admin.services');
    Route::get('admin/{category_slug}/services',AdminServiceByCategoryComponet::class)->name('admin.services_by_category');
    Route::get('admin/service/add',AdminAddServiceComponet::class)->name('admin.add_service');
    Route::get('admin/service/edit/{service_slug}',AdminEditServiceComponet::class)->name('admin.edit_service');
    Route::get('admin/sliders',AdminSliderComponet::class)->name('admin.sliders');
    Route::get('admin/slider/add',AdminAddSliderComponet::class)->name('admin.add_slider');
    Route::get('admin/slider/edit/{id}',AdminEditSliderComponet::class)->name('admin.edit_slider');
}); 
//For S provider
Route::middleware([
    'auth:sanctum','auth_sprovider',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('sprovider/dashboard',SproviderDashboardComponent::class)->name('sprovider.dashboard');
});
//For Customer
Route::middleware([
    'auth:sanctum','auth_customer',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('customer/dashboard',CustomerDashboardComponent::class)->name('customer.dashboard');
    Route::post('customer/orders/create',[CustomerOrderController::class,'create'])->name('customer.order_create');
    Route::get('customer/orders/show',[CustomerOrderController::class,'show'])->name('customer.order_show');
    Route::get('customer/order/{id}',[CustomerOrderController::class,'order'])->name('customer.order');
    Route::post('customer/orders/save',[CustomerOrderController::class,'save'])->name('customer.order_save');
    Route::get('customer/service/{service_slug}',[CustomerServiceController::class,'index'])->name('customer.order_details');
});
