<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<script src="../../script/jquery.min.js"></script>
    <link rel="stylesheet" href="../../script/tocas/tocas.css">
	<script type='text/javascript' src="../../script/tocas/tocas.js"></script>
	<title>APK Viewer</title>
	<style>body{background-color:white}</style>
</head>
<body>
<br>
<div class="ts container">
<div class="ts big comments">
    <div class="comment">
        <a class="avatar">
            <img src="icon.png" id="logo">
        </a>
        <div class="content">
            <p class="author" id="packagename">Loading...</p>
            <div class="middoted actions">
                <div class="reply" id="version">Loading...</div>
            </div>
        </div>
    </div>
</div>
<div class="ts divider"></div>
<div class="ts header" id="permission">
<br>
</div>
</div>
</body>
<script>
var file = "<?php echo $_GET["file"]?>";
$.get( "opr.php?file=" + file, function( data ) {
	if(data !== ""){
		var obj = JSON.parse(data);
		$("#logo").attr("src",obj["logo"]);
		$("#packagename").text(obj["package"][0]);
		$("#version").text(obj["versionName"][0] + " (API Level:" + obj["minSdkVersion"][0] + " To "+ obj["targetSdkVersion"][0] + ")");
		$("#permission").html("<p>App Permissions<br>This application may request access to</p>");
		$.each( obj["feature"].reverse(), function( value ) {
			var icon = '<p style="width: 100%"><i class="large icons"><i class="%icon% icon"></i></i>%text%</p>';
			icon = icon.replace("%text%",obj["feature"][value][1]);
			switch(obj["feature"][value][0]){
				case "Audio":
					icon = icon.replace("%icon%","sound");
					break;
				case "Bluetooth":
					icon = icon.replace("%icon%","bluetooth");
					break;
				case "Camera":
					icon = icon.replace("%icon%","photo");
					break;
				case "DeviceUI":
					icon = icon.replace("%icon%","desktop");
					break;
				case "Fingerprint":
					icon = icon.replace("%icon%","id badge");
					break;
				case "Gamepad":
					icon = icon.replace("%icon%","game");
					break;
				case "Infrared":
					icon = icon.replace("%icon%","signal");
					break;
				case "Location":
					icon = icon.replace("%icon%","location arrow");
					break;
				case "NFC":
					icon = icon.replace("%icon%","tags");
					break;
				case "OpenGL":
					icon = icon.replace("%icon%","computer");
					break;
				case "Sensor":
					icon = icon.replace("%icon%","feed");
					break;
				case "Telephony":
					icon = icon.replace("%icon%","phone");
					break;
				case "TouchScreen":
					icon = icon.replace("%icon%","mobile");
					break;
				case "USB":
					icon = icon.replace("%icon%","usb");
					break;
				case "Vulkan":
					icon = icon.replace("%icon%","sound");
					break;
				case "WiFi":
					icon = icon.replace("%icon%","wifi");
					break;
				case "Permission":
					icon = icon.replace("%icon%","lock");
					break;
				default:
					icon = icon.replace("%icon%","settings");
					break;
			}
			$("#permission").append(icon);		
		});
		$("#permission").append("<br>");
	}else{
		$("#packagename").text("Error while prasing apk");
		$("#version").text("");
		$("#permission").html("<p>Parse error.</p>");
	}
});

function convertSize(size){
	if((size) < 1024){
		return Math.round(size) + "B";
	}else if((size) < 1048576){
		return Math.round(size/1024) + "KB";
	}else if((size) < 1073741824){
		return Math.round(size/1048576) + "MB";
	}else if((size) < 1099511627776){
		return Math.round(size/1073741824) + "GB";
	}else{
		return "Too Big!";
	}
}
</script>
</html>