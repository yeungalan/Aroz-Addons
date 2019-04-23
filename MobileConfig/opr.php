<?php
require_once 'PlistParser.php';
$result = [];
$plistParser = new PlistParser;
$result = $plistParser->plistToArray($_GET["filename"]);


if($result == []){
	$seed = rand();
	exec('openssl smime -inform DER -verify -in "'.$_GET["filename"].'" -noverify -out "designed'.$seed.'.mobileconfig"  -signer output'.$seed.'.crt',$out);
	
	//this piece of shit are use for remove first line character
	$processFirstline = fopen("designed".$seed.".mobileconfig", "r");
	$processFirstlineContents = fread($processFirstline, filesize("designed".$seed.".mobileconfig"));
	fclose($processFirstline);
	if($processFirstlineContents[0] == "\n" || $processFirstlineContents[0] == "\r" || $processFirstlineContents[0] == " "){
		$processFirstlineContents = substr($processFirstlineContents, 2);
	}
	$processFirstline = fopen("designed".$seed.".mobileconfig", "w");
	fwrite($processFirstline,$processFirstlineContents);
	fclose($processFirstline);
	//so just dismiss this piece of shit
	$result = $plistParser->plistToArray("designed".$seed.".mobileconfig");
	
	$filename = "output".$seed.".crt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	$crtRawData = openssl_x509_parse($contents,false);
	$crtRawData["PayloadDisplayName"] = "Certificate";
	$crtRawData["PayloadDescription"] = "Certificate information";
	$crtRawData["PayloadType"] = "com.openssl.certificate";
	array_push($result["PayloadContent"],arraymerge($crtRawData,""));
	
	unlink("designed".$seed.".mobileconfig");
	unlink("output".$seed.".crt");
}

echo json_encode($result,true);



function arraymerge($array,$arrayName) {
	$result = array(); 
	foreach ($array as $key => $value) { 
    if (is_array($value)) {
		if($arrayName == "purposes"){
			$result["purpose"] = $result["purpose"].$value[2].",";			
		}else{
			$result = array_merge($result, arraymerge($value,$key));
		}
    }else{
		if($value !== false && $value !== true){
				$result[$key] = $value;
		}	  
    } 
  } 
  return $result; 
} 
//openssl smime -inform DER -verify -in wifi_1.mobileconfig -noverify -out de-signed.mobileconfig  -signer designed.pem
//openssl x509 -in designed.pem -text -noout 
?>