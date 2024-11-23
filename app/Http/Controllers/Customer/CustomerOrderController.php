<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
//use App\Models\User;
//use auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller
{
    public function create(Request $request)
    {
        $x = 1;
        $order_ = Order::latest()->first();
        if ($order_) {
            $order_c = $order_->id;
        } else {
            $order_c = 1;
        }
        $order_code = mt_rand(1000, 9999);
        if ($request->image) {
            $imageName = Carbon::now()->timestamp.'.'.$request->image->extension();
            $request->image->storeAs('orders', $imageName);
        } else {
            $imageName = null;
        }
        if (! $request->country) {
            $country = 'السودان';
        } else {
            $country = $request->country;
        }
        Order::create([
            'service_id' => $request->service_id,
            'user_id' => auth()->user()->id,
            'sprovider_id' => $x,
            'order_code' => $order_c + $order_code,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'country' => $country,
            'city' => $request->city,
            'state' => $request->state,
            'street' => $request->street,
            'suburb' => $request->suburb,
            'postcode' => $request->postcode,
            'time' => $request->time,
            'details' => $request->details,
            'status' => 0,
            'image' => $imageName,
        ]);

        return redirect()->route('customer.order_show');
    }

    public function save(Request $request)
    {
        //return dd($request);
        $provider = User::find($request->provider_id);
        $customer = User::find(auth()->user()->id);
        $service = Service::find($request->service_id);
        if (! $provider) {
            return redirect()->back();
        }
        if (! $service) {
            return redirect()->back();
        }
        $order_ = Order::latest()->first();
        if ($order_) {
            $order_c = $order_->id;
        } else {
            $order_c = 1;
        }
        $order_code = mt_rand(10000, 99999);
        if ($request->hasFile('image')) {
            $imageName = Carbon::now()->timestamp.'.'.$request->image->extension();
            $request->image->storeAs('orders', $imageName);
        } else {
            $imageName = null;
        }
        Order::create([
            'service_id' => $request->service_id,
            'user_id' => $customer->id,
            'sprovider_id' => $request->provider_id,
            'order_code' => $order_c - $order_code,
            'lat' => $customer->lat,
            'lon' => $customer->lon,
            'country' => '',
            'city' => '',
            'state' => '',
            'street' => '',
            'suburb' => '',
            'postcode' => '0',
            'time' => $request->time,
            'details' => $request->details,
            'status' => 0,
            'image' => $imageName,
        ]);

        return redirect()->route('customer.order_show');
    }
    public function show(){
      $orders = Order::where('user_id',auth()->user()->id)->paginate(10);
       return view('customers.order_show',compact('orders'));
    }
    public function order($order_id){
      $order = Order::find($order_id);
      if($order){
        $customer = User::find(auth()->user()->id);
        $provider = User::find($order->sprovider_id);
        $service = Service::find($order->service_id);
        return view('customers.order',compact('customer','provider','service','order'));
      }else{
        return redirect()->back();
      }
    }
}
