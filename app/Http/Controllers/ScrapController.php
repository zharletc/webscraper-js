<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Content;
class ScrapController extends Controller
{
    public function index(Request $req){
    	$doc = new \DOMDocument();
    	$content = array();
    	$allSelect = array();
    	$collect = array();
		$fixcollect = array();
    	$postUrl = $req->inclink;
		$postTag = $req->tag;
		$postAttr = $req->attr1;
		$postAttr2 = $req->attr2;
		$postVal = $req->val1;
		$postVal2 = $req->val2;
		$postName = $req->name;
		$y = 0; $x = 0;
		foreach($postTag as $tag){
			$allSelect[] = array('Tag'=>$tag , 'Name' => $postName[$x] , 'Attribute'=>$postAttr[$x] , 'Value'=>$postVal[$x] , 'Attribute2' => $postAttr2[$x]);
			$x++;
		}
		$x = 0;
		foreach($postUrl as $result){
			$save = "";$part = "";$quer = "";$quer2 = "";
			$arr = explode("::",$result);
			$link = $arr[0];
			@$doc->loadHTML(file_get_contents($link));
			foreach($allSelect as $data){
				$nameSel = $data['Name'];
				$tagSel = $data['Tag'];
				$attrSel = $data['Attribute'];
				$attrSel2 = $data['Attribute2'];
				$valSel = $data['Value'];
				$tags = $doc->getElementsByTagName($tagSel);
				foreach($tags as $tag){
					if($tag->getAttribute($attrSel) == strtolower($valSel)){
						if($tag->hasAttribute($attrSel2) === true){
							if($part == "" && $save == ""){
								$part = $nameSel;
								$save = $tag->getAttribute($attrSel2);
							}else{
								$part .="::" . $nameSel;
								$save .="::" . $tag->getAttribute($attrSel2);
							}		
						}else{
							if($part == "" && $save == ""){
								$part = $nameSel;
								$save = $tag->nodeValue;
							}else{
								$part .="::" . $nameSel;
								$save .="::" . $tag->nodeValue;
							}	
						}			
					}
				}
			}
			$part .="::LINK" ;
			$save .="::".$link; 
			$countPart = "";
			$partType = explode("::",$part);
			$dataContent = explode("::",$save);
			for($i=0;$i<count($partType);$i++){
				if($quer == ""){
					$quer = $partType[$i];
				}else{
					$quer .= "::" . $partType[$i];
				}
			}
			for($i=0;$i<count($dataContent);$i++){
			if($quer2 == ""){
					$quer2 = preg_replace("/\r|\n/",'<br/>',$dataContent[$i]);
			
			}else{
				$quer2 .= '::' . preg_replace("/\r|\n/",'<br/>',$dataContent[$i]);
			}
			}
			$arrCol = explode("::",$quer);
			$arrVal = explode("::",$quer2);
				for ($i=0; $i < count($arrCol) ; $i++) { 
						$collect[$y][$arrCol[$i]] = $arrVal[$i] ;
				}
			$y++;
		}
		foreach ($collect as $input) {
			$this->insert(json_encode($input));
		}
		return redirect('/')->with('alert','Data Saved!');
    }
    public function insert($arr){
    	Content::insert(json_decode($arr,true));
    }
}
