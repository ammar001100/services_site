<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;
//use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerServiceController extends Controller
{
    public function index(Request $request)
   {
       $service = Service::where('slug',$request->service_slug)->first();
       $r_service = Service::where('service_category_id',$service->service_category_id)->where('slug','!=',$request->service_slug)->inRandomOrder()->first();
       $serviceId = $service->id;
       $userLocation = ['lat' => auth()->user()->lat, 'lon' => auth()->user()->lon]; 
       $serviceType = $request->input('service_type', 'default_service'); 

       // جلب مقدمي الخدمات الأقرب حسب المسافة
       $serviceProviders = User::select('*', DB::raw("(
               6371 * acos(
                   cos(radians({$userLocation['lat']})) * 
                   cos(radians(lat)) * 
                   cos(radians(lon) - radians({$userLocation['lon']})) + 
                   sin(radians({$userLocation['lat']})) * 
                   sin(radians(lat))
               )
           ) AS distance"))
           ->whereHas('services',function($query) use ($serviceId){
            $query->where('service_id',$serviceId);
           })
           ->where('is_active', 1)
           //->where('service_type', $serviceType)
           ->orderBy('distance')
           ->limit(50)
           ->get();

       return view('customers.order_details', compact('serviceProviders', 'userLocation','service','r_service'));
   }

   public function requestService($id)
   {
       // منطق لمعالجة طلب الخدمة
       return view('request', compact('id'));
   }
}
