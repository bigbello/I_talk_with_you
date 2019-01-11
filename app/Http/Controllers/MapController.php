<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mapper;

class MapController extends Controller
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

      public static function showPosition(Request $request){
        $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
        if ($query && $query['status'] == 'success') {
            $latitude = $query['lat'];
            $longitude = $query['lon'];
            $user = Auth::user();
            $id = Auth::id();
            $update = DB::table('users')->where('id', $id)->update(['last_latitude' => $latitude, 'last_longitude' => $longitude]);
            Mapper::map($latitude, $longitude);
            return view('map');
        }
        else{
          echo 'Error';
        }
    }


   //Slider in view
   /*
   <input type="range" min="1" max="50" value="5" class="slider" id="myRange">
   <p>Value: <span id="demo" name="demo"></span></p>'
   */

}
