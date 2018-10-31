<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Content;
use Input;

class NaviController extends Controller
{
    public function kategori(Request $request)
    {
    	$message = $request->message;
    	$tabelKategori = Content::where('KATEGORI',$message)->get();
        if ($request->isMethod('post')){    
            return response()->json($tabelKategori); 
        }
        
        // return response()->json(['response' => 'This is get method']);
    }
    public function site(Request $request)
    {
    	$message = $request->message;
    	$column = str_replace("-", ".",$message);
    	$tabelKategori = Content::where('LINK','LIKE','%'.$column.'%')->get();
        if ($request->isMethod('post')){    
            return response()->json($tabelKategori); 
        }
        
        // return response()->json(['response' => 'This is get method']);
    }
}
