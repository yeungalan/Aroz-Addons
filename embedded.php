<?php
	$file = str_replace("../SystemAOB/functions/extDiskAccess.php?file=","",$_GET["filepath"]);
	$extension = strtolower(pathinfo($file)['extension']);
	
	switch($extension){
	    case "cr2":
			$plugin = "raw";			
			break;
		case "psd":
			$plugin = "raw";
			break;
		case "tiff":
			$plugin = "raw";
			break;
		case "cr":
			$plugin = "docx";
			break;
		case "docx":
			$plugin = "docx";
			break;
		case "json":
			$plugin = "json";
			break;
		case "csv":
			$plugin = "csv";
			break;
		case "apk":
			$plugin = "apk";
			break;
		case "ttf":
			$plugin = "font";
			break;
		case "otf":
			$plugin = "font";
			break;
		case "mobileconfig":
			$plugin = "mobileconfig";
			break;
		case "zip":
			$plugin = "systempanel";
			break;
	};
	header('Location: '.$plugin.'?file=../'.$file);
?>
