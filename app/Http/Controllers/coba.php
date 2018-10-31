<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cobamodel;
use Illuminate\Support\Facades\DB;

class coba extends Controller
{
    public function index(){
    	return view('coba');
    }
    public function validasi(Request $req){
    	$user = $req->user;
    	$pass = $req->password;
    	$result = coba::where('username',$user)->get();
    	if($result->username == 'azhar'){
    		return view('home');
    	}
    	// if($req->user == "azhar"){
    	// 	if($req->password == "123"){
    	// 		return view('home');
    	// 	}
    	// }
    }
}
