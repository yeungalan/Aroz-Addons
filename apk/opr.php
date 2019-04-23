<?php
//information reference :
https://developer.android.com/guide/topics/manifest/uses-feature-element

$outputname = md5(rand(0, 30000).time()."apkxml");
$result = [];

exec('sudo ./axmldec -i "../'.$_GET["file"].'" -o "../tmp/'.$outputname.'.xml"',$output);
//get icon
$zip = new ZipArchive;
$zip->open('../'.$_GET["file"]);
$zip->extractTo('../tmp/'.$outputname."/");
$zip->close();
foreach (glob('../tmp/'.$outputname.'/res/*/ic_launcher.png') as $filename) {
	$result["logo"] = $filename;
}
if($result["logo"] == NULL){
	foreach (glob('../tmp/'.$outputname.'/res/*/icon.png') as $filename) {
		$result["logo"] = $filename;
	}
}
if($result["logo"] == NULL){
	$result["logo"] = "icon.png";
}
//prase XML
$xml=simplexml_load_file('../tmp/'.$outputname.'.xml') or die();

$result["package"] = $xml->xpath('/manifest/@package')[0]->package;
$result["versionName"] = $xml->xpath('/manifest/@android:versionName')[0]->versionName;
$result["minSdkVersion"] =  $xml->xpath('/manifest/uses-sdk/@android:minSdkVersion')[0]->minSdkVersion;
$result["targetSdkVersion"] =  $xml->xpath('/manifest/uses-sdk/@android:targetSdkVersion')[0]->targetSdkVersion;

$i = 0;
foreach($xml->xpath('/manifest/uses-permission/@android:name')as &$value){
	$tmp = getdetails($value->name);
	if($tmp !== NULL){
		$result["feature"][$i] = $tmp;
		$i += 1;
	}
}
foreach($xml->xpath('/manifest/uses-feature/@android:name')as &$value){
	$tmp = getdetails($value->name);
	if($tmp !== NULL){
		$result["feature"][$i] = $tmp;
		$i += 1;
	}
}

echo json_encode($result);

function getdetails($name){
	$csv = array_map('str_getcsv', file('list.csv'));
	foreach($csv as &$value){
		if(strtolower($value[0]) == strtolower($name)){
			return array($value[1],$value[2]);
		}
	}
}

