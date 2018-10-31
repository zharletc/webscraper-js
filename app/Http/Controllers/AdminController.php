<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Content;

class AdminController extends Controller
{
    public $main;
    public function __construct()
    {
        $this->middleware('auth');
        $this->main = array(
            'filterHost' => $this->select_link(), 
            'filterContent' => $this->select_content(),
            'filterCategory' => $this->select_category(),
            'lastScrap' => $this->select_lastdate()
        );
    }
    public function index(){
    	return view('admin/index' , $this->main);
    }
    public function select_link(){
    	$filterHost = array();
    	$Links = Content::pluck('LINK');
    	foreach($Links as $link){
    		$temp = parse_url($link)["host"];
    		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $temp, $regs)) {
	          if(!in_array($regs['domain'], $filterHost)){
	             $filterHost[] = $regs['domain'];
	          }
	        }
    	}
        return $filterHost;
    }
    public function select_content(){
    	return Content::pluck('CONTENT');
    }
    public function select_category(){
        $filterCategory = array();
        $Categories = Content::pluck('KATEGORI');
        foreach($Categories as $result){
            if(!in_array(ucfirst(strtolower($result)),$filterCategory)){
                if($result != ""||$result != null){
                     $filterCategory[] = ucfirst(strtolower($result));
                }
            }
        }
    	return $filterCategory;
    }
    public function select_lastdate(){
    	$getDate = Content::latest('GET_DATE')->limit(1)->get();
        $date1 = date_create(date('Y-m-d',strtotime($getDate[0]->GET_DATE)));
        $date2 = date_create(date('Y-m-d'));
        $interval = date_diff($date2,$date1)->format('%a Days Ago');
        if($interval == '0 Days Ago'){$interval = "Today";}
        if($interval == '1 Days Ago'){$interval = "Yesterday";}
        return $interval;
    }
    public function content(){
        return view('admin/content' , $this->main);
    }
}
