<!doctype HTML>
<html>
  <head>
    <title>jQuery json-viewer</title>
    <meta charset="utf-8" />

    <script src="../../script/jquery.min.js"></script>
    <script src="jquery.json-viewer.js"></script>
    <link href="jquery.json-viewer.css" type="text/css" rel="stylesheet" />
	<style>
		body{
			margin-left: 30px;
			background-color: white;
		}
	</style>
    <script>
	$.get( "<?php echo "../".$_GET["file"] ?>", function( data ) {
		$('#json-renderer').jsonViewer(data);
	});
    </script>
  </head>
  <body>
  <pre id="json-renderer"></pre>
  </body>
</html>
