<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;

class VideoController extends Controller
{
   public function index(){
    $playlist = Playlist::all();
   }
}
