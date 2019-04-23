<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<script src="../../script/jquery.min.js"></script>
    <link rel="stylesheet" href="../../script/tocas/tocas.css">
	<script type='text/javascript' src="../../script/tocas/tocas.js"></script>
	<title>Font Viewer</title>
	<style>
	@font-face {
		font-family: template;
		src: url(<?php echo $_GET["file"] ?> ) format('truetype'); 
	}
	body{
		background-color:white;
	}
	.ts.header{
		background-color:white;
		font-family: template;
	}
	.content{
		background-color:white;
		font-family: template;
	}
	</style>
</head>
<body>
<br>
<div class="ts container">
	<div class="ts large header">
		<i class="font top aligned icon"></i>
		<div class="content">
			<?php echo $_GET["file"] ?>
		</div>
	</div>
	<div class="ts divider"></div>
	<h1 class="ts header">I can eat glass, it doesn't hurt me.</h1>
	<h2 class="ts header">I can eat glass, it doesn't hurt me.</h2>
	<h3 class="ts header">I can eat glass, it doesn't hurt me.</h3>
	<h4 class="ts header">I can eat glass, it doesn't hurt me.</h4>
	<h5 class="ts header">I can eat glass, it doesn't hurt me.</h5>
	<h6 class="ts header">I can eat glass, it doesn't hurt me.</h6>
</div>
</body>

</html>