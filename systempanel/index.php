<?php
$data =  json_decode(file_get_contents('zip://' . $_GET["file"] . '#info.json'),true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<script src="../../script/jquery.min.js"></script>
    <link rel="stylesheet" href="../../script/tocas/tocas.css">
	<script type='text/javascript' src="../../script/tocas/tocas.js"></script>
	<title>Systempanel</title>
	<style>body{background-color:white}</style>
</head>
<body>
<br>
<div class="ts container">
<a class="ts very compact right floated button" href="install.php?file=<?php echo $_GET["file"]; ?>">Install</a>
<div class="ts big comments">
    <div class="comment">
        <a class="avatar">
            <img src="icon.png" id="logo">
        </a>
        <div class="content">
            <p class="author" id="packagename"><?php echo $data["name"]; ?></p>
            <div class="middoted actions">
                <div class="reply" id="version"><?php echo $data["author"]; ?> </div>
            </div>
        </div>
    </div>
</div>
<div class="ts divider"></div>
<div class="ts header" id="permission">
<?php echo $data["description"]; ?>
<br>
</div>
</div>
</body>
</html>