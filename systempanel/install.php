<?php
$file = fopen('zip://' . $_GET["file"] . '#info.json',"r");
while(! feof($file)){
  $str = $str.fgets($file);
 }

fclose($file);

$data =  json_decode($str,true);
print_r($data);

foreach ($data["panel"] as $key => $value) {
    $fp = fopen("../../System Settings/menus/".$key.".csv", 'a+');
	foreach ($value as &$string) {
		echo $key." ".$string;
		fwrite($fp, $string);
	}
	fclose($fp);
}
/*
$zip = new ZipArchive;
$res = $zip->open($_GET["file"]);
if ($res === TRUE) {
    $zip->extractTo('../');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
*/
exec('unzip ../../Desktop/files/admin/inith6472697665.zip "panel/*" -d"../../SystemAOB/functions/"');
?>
