<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Team;

class TeamController extends Controller
{
    //fungsi menampilkan data tim
    public function index(){
        //$ar_team = DB::table('team')->get();//query builder
        $ar_team = Team::all();//eloquent
        return view('frontend.team', compact('ar_team'));
    }
}
