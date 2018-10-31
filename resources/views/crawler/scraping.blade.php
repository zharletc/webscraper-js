@include('crawler.header')
<?php 
$doc = new DOMDocument(); 

$content = array();
$postUrl = $_POST['inclink'];
$postTag = $_POST['tag'];
$postAttr = $_POST['attr1'];
$postAttr2 = $_POST['attr2'];
$postVal = $_POST['val1'];
$postVal2 = $_POST['val2'];
$postName = $_POST['name'];
$allSelect = array();

$x = 0;
foreach($postTag as $tag){
	$allSelect[] = array('Tag'=>$tag , 'Name' => $postName[$x] , 'Attribute'=>$postAttr[$x] , 'Value'=>$postVal[$x] , 'Attribute2' => $postAttr2[$x]);
	$x++;
}
$x = 0;
foreach($postUrl as $result){
	$save = "";
	$part = "";
	$quer = "";
	$quer2 = "";
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

	for($i=0;$i<count($partType);$i++){
		if($quer == ""){
			$quer = $partType[$i];
		}else{
			$quer .= "," . $partType[$i];
		}
	}
	$dataContent = explode("::",$save);
	for($i=0;$i<count($dataContent);$i++){
		if($quer2 == ""){
			$quer2 = '"' .str_replace('"', '\'', $dataContent[$i]);
		}else{
			if($i == count($dataContent)-1){
				$quer2 .= '","' .str_replace('"', '\'', $dataContent[$i]) . '"';
			}else{
				$quer2 .= '","' .str_replace('"', '\'', $dataContent[$i]);
			}
		}
	}
	$query = "INSERT INTO content (".$quer.") VALUES (".$quer2.")";

	echo $query . "<br>";
	/*if($conn->query($query) === false){
		echo "<br>'$conn->error'";
	}else{
		echo "<br>" . $conn->error;
	}*/
	$x++;
}
?>