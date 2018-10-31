<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Content;

class ContentController extends Controller
{
    public function index(){
    	$Contents = Content::get();
    	return view('crawler/content' , ['Contents'=> $Contents]);
    }
    public function show($id){
    	$Contents = Content::find($id);
    	if(!$Contents)
    		abort(503);
    	return view('crawler/content_detail' , ['Contents'=> $Contents]);
    }
    public function showTrash(){
    	$Trash = Content::onlyTrashed()->get();
    	return view('crawler/trash' , ['Trash' => $Trash]);
    }
    public function update(Request $request){
        // dd($request);
        try{
            $update = Content::where('ID',$request->textID)->update([
            'TITLE' => $request->textTitle,
            'CONTENT' => $request->textContent,
            'KATEGORI' => $request->textCategory,
            'KEYWORD' => $request->textKeyword,
            'LINK' => $request->textLink,
            'ARTICLE_DATE' => $request->textArtdate
            ]);
        } catch(\Illuminate\Database\QueryException $e){
            dd("ERROR DB");
        }
        return redirect()->back()->with('alert','Update Sukses');
    }
}
