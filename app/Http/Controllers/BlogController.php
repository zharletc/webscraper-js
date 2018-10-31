<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin;

class BlogController extends Controller
{
    public function index(){
        $blog = new Admin();
    	$Admin = Admin::find(4);
        dd($Admin);
    }
    public function crawl($url){
    	return view('crawler/crawl' , ['url' => $url , 'contents' => $contents]);
    }
    public function admin($user){
        $admin = Admin::where('user','Youu');
        $admin->delete();
    }
}
