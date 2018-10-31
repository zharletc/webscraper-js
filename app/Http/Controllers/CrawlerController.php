<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\DB;
class CrawlerController extends Controller
{
	function filter_link($url,$url_child){
		$filter = $url_child;
		if(substr($filter,0,1) == "/" && substr($filter,0,2)!="//"){
			$filter = parse_url($url)["scheme"]."://".parse_url($url)["host"].$filter;
		}else if(substr($filter,0,2)=="//"){
			$filter = parse_url($url)["scheme"].":".$filter;
		}else if(substr($filter,0,2)=="./"){
			$filter = parse_url($url)["scheme"]."://".parse_url($url)["host"].dirname(parse_url($url)["path"]).substr($filter,1);
		}else if(substr($filter,0,1) == "#" && substr($filter,2) != ""){
			$filter = parse_url($url)["scheme"]."://".parse_url($url)["host"].dirname(parse_url($url)['path']).$filter;
		}else if(substr($filter,0,3)== "../"){
			$filter = parse_url($url)["scheme"]."://".parse_url($url)["host"]."/".$filter;
		}else if(substr($filter,0,11)== "javascript:"){
				$filter="";
		}else if(substr($filter,0,4) != "http" && substr($filter,0,5) != "https" && substr($filter,2)!=""){
			$filter = parse_url($url)["scheme"]."://".parse_url($url)["host"].dirname(parse_url($url)["path"])."/".$filter;
		}
		return $filter;
	}
    public function urldefine(Request $req){
    	$url = $req->url;
    	if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
		    dd('Not a valid URL');
		}else{
			$link = array();
			$temp = array();
			$doc = new \DOMDocument();
			@$doc->loadHTML(@file_get_contents($_POST['url']));
			$links = $doc->getElementsByTagName("a");
			foreach ($links as $result) {
				if(empty($link)){
					$temp = $req->url;
				}else{
					$temp = $this->filter_link($url,$result->getAttribute("href"));
				}
				if(!in_array($temp, $link)){
						$link[] = $temp;
				}	
			}
			return view('crawler/urldefine', ['links' => $link]);
		}
    }
    public function browse(Request $req){
    	$doc = new \DOMDocument();
    	$start = $req->subLink;

    	@$doc->loadHTML(@file_get_contents($start));
    	$titles = $doc->getElementsByTagName("title");
    	foreach($titles as $result){
			$title = $result->nodeValue; 
		}
		return view('crawler/define' , ['title' => $title , 'url' => $start]);
    }
    public function crawl(Request $req){
    	$doc = new \DOMDocument();
		$url = $req->url;
		$title = $req->title;;
		$all_tags = array();
		$all_attrs = array();
		$all_value = array();
		$temp = array();
		@$doc->loadHTML(@file_get_contents($url));
		$tags = $doc->getElementsByTagName('*');
		foreach($tags as $result){	
			if(!in_array($result->tagName, $all_tags)){
				$all_tags[] = $result->tagName;
			}
		}
		return view('crawler/crawl',['title' => $title , 'url' => $url , 'tags' => $all_tags]);
    }
    public function selectBlock(Request $req){
    	$doc = new \DOMDocument();
    	$url = $req->url;
    	$tag = $req->tag;
    	$all_tags = array();
    	$attr1 = (isset($req->attr1)? $req->attr1 : "");
		$attr2 = (isset($req->attr2)? $req->attr2 : "");
		$value = (isset($req->val1)? $req->val1 : "");
		$value2 = (isset($req->val2)? $req->val2 : "");
		$data = $this->get_detail($url,$tag,$attr1,$attr2,$value,$value2);
		@$doc->loadHTML(@file_get_contents($url));
		$tags = $doc->getElementsByTagName('*');
		foreach($tags as $result){	
			if(!in_array($result->tagName, $all_tags)){
				$all_tags[] = $result->tagName;
			}
		}
		$collectColumn = $this->get_column();
		return view('crawler/scrapselect',['data' => $data , 'tags' => $all_tags , 'columns' => $collectColumn]);
    }
    function get_column(){
    	$result = DB::getSchemaBuilder()->getColumnListing('content');
		return $result;
	}
    function get_detail($url,$tag,$attr1,$attr2,$value,$value2){
		$doc = new \DOMDocument();
		$title = "";
		$link = "";
		$data = array();
		$temp = array();
		@$doc->loadHTML(@file_get_contents($url));
		$elements = $doc->getElementsByTagName($tag);
		if($value!=""){
			foreach ($elements as $element) {
				$getAttr1 = $element->getAttribute($attr1);
				if($getAttr1 == strtolower($value) ){
					$title = $element->nodeValue;
					$link = $element->getAttribute($attr2);
					if($link!=""){
						if(!in_array($this->filter_link($url,$link), $temp)){
							$temp[] = $this->filter_link($url,$link);
							$data[] = array("Title" => $title , "Link" => $this->filter_link($url,$link));
						}
					}
				}else if(strpos($getAttr1, strtolower($value)) !== true && strpos($link,parse_url($url)['host'])==true){
					$title = $element->nodeValue;
					$link =  $this->filter_link($url,$element->getAttribute($attr2));
					if($link!=""){
						if(!in_array($this->filter_link($url,$link), $temp)){
							$temp[] = $this->filter_link($url,$link);
							$data[] = array("Title" => $title , "Link" => $this->filter_link($url,$link));
						}
					}

				}
			}

		}else{
			foreach ($elements as $element) {
				$title = $element->nodeValue;
				$link = $element->getAttribute($attr1);
				if(!in_array($this->filter_link($url,$link), $temp)){
					$temp[] = $this->filter_link($url,$link);
					$data[] = array("Title" => $title , "Link" => $this->filter_link($url,$link));
				}
			}
		}
	return $data;
	}
}
