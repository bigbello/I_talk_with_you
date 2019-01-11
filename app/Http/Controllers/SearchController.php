<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mapper;

class SearchController extends Controller
{

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('auth');
      }


    public static function search(Request $request){
      $title = '';
      $user =   Auth::user();
      $condition = $request->input('condition');
      if($condition == '2'){
        $others = DB::table('users')->where('id', '<>', $user->id)->get();
      }
      else if($condition == '0'){
        $others = DB::table('users')->where([['id', '<>', $user->id], ['condition', '=', 'Caregiver']])->get();
      }
      else if($condition == '1'){
        $others = DB::table('users')->where([['id', '<>', $user->id], ['condition', '=', 'Caretaker']])->get();
      }
      foreach ($others as $other){
        $meters = SearchController::calcola_distanza($user->last_latitude, $user->last_longitude, $other->last_latitude, $other->last_longitude);
        $quantity = $request->input('quantity') * 1000;
        if($meters < $quantity){
          $title = $other->name;
        }
      }
      if($title == ''){
        $title = 'No users found';
      }
      return view('search')->withTitle($title);
    }

    public static function getLatitude(){
        $user = Auth::user();
        $latitude = $user->last_latitude;
        return $latitude;
    }

    public static function getLongitude(){
        $user = Auth::user();
        $longitude = $user->last_longitude;
       return $longitude;
    }

    public static function calcola_distanza($latitude1, $longitude1, $latitude2, $longitude2) {
        $theta = $longitude1 - $longitude2;
        $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return $meters;
    }

}
