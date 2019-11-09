<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddress;
use App\Address;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $countries = DB::table("countries")->get();
        $addresses = auth()->user()->addresses->sortBy('name');
        return view('address', compact('user', 'countries', 'addresses'));
    }

    public function store(StoreAddress $request){
        $address = Address::add($request->validated());
        $address->setCountry($request->get('country_id'));
        $address->setState($request->get('state_id'));
        $address->setCity($request->get('city_id'));

        return redirect('/addresses');
    }

    public function destroy($id){
        Address::find($id)->delete();
        return redirect('/addresses');
    }

    public function getStates($id)
    {
        $states = DB::table("states")
            ->where("country_id",$id)
            ->pluck("name","id");
        return response()->json($states);
    }

    public function getCities($id)
    {
        $cities= DB::table("cities")
            ->where("state_id",$id)
            ->pluck("name","id");
        return response()->json($cities);
    }

    protected function validateAddress(){
        return request()->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'user_id' => ['required'],
            'country_id' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['required'],
            'street' => ['nullable', 'min:2', 'max:255'],
            'house' => ['nullable', 'max:12'],
            'information' => ['nullable', 'min:2', 'max:500']
        ]);
    }
}
