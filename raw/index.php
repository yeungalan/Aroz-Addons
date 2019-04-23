<?php
$file = $_GET["file"];
	$extension = strtolower(pathinfo($file)['extension']);
	switch($extension){
	    case "cr2":
			exiv2($file);
			break;
		case "psd":
			Imagick($file);
			break;
		case "tiff":
			exiv2($file);
			break;
	};
	
/* Function */
	function exiv2($image){
			exec("exiv2 -ep -l ./tmp/ ".$image);
			foreach (glob("./tmp/*") as $filename) {
				preg_match("/.*-preview([0-9]*).jpg/", $filename, $out);
				$arr[$out[1]] =  $filename;
			}
			arsort($arr);
			$imageData = base64_encode(file_get_contents(array_shift(array_values($arr))));
			$src = 'data: image/jpg;base64,'.$imageData;
			echo '<style>body{background-color: black;}</style><img style="display: block;margin-left: auto;margin-right: auto;" height="96%" src="'.$src.'">';

			foreach ($arr as $filename){
				unlink($filename);
			}
	}
	
	function Imagick($image){
		$im = new Imagick( $image );
		$im->readImageFile($image);
		$im->setImageBackgroundColor('#ffffff');
        $im->setImageFormat('png');
		echo '<style>body{background-color: black;}</style><img style="display: block;margin-left: auto;margin-right: auto;" height="96%" src="data:image/jpg;base64,'.base64_encode($im->getImageBlob()).'">';

	}
?>