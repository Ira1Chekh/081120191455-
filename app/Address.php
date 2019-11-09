<?php

namespace App;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'country_id',
        'state_id',
        'city_id',
        'street',
        'house',
        'information'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

    public static function add($fields){
        $address = new static;
        $address->fill($fields);
        $address->user_id = Auth::user()->id;
        $address->save();

        return $address;
    }

    public function setCountry($id){
        if($id == null){ return; }
        $this->country_id = $id;
        $this->save();
    }
    public function setState($id){
        if($id == null){ return; }
        $this->state_id = $id;
        $this->save();
    }
    public function setCity($id){
        if($id == null){ return; }
        $this->city_id = $id;
        $this->save();
    }

    public function getCountryName(){
        return ($this->country != null)
            ? $this->country->name
            : 'No country selected';
    }
    public function getStateName(){
        return ($this->state != null)
            ? $this->state->name
            : 'No state selected';
    }
    public function getCityName(){
        return ($this->city != null)
            ? $this->city->name
            : 'No city selected';
    }

}
