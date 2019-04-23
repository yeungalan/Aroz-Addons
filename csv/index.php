<!doctype HTML>
<html>
  <head>
    <title>CSV Viewer</title>
    <meta charset="utf-8" />
	<script src="../../script/jquery.min.js"></script>
    <link rel="stylesheet" href="../../script/tocas/tocas.css">
	<script type='text/javascript' src="../../script/tocas/tocas.js"></script>
	<style> body{background-color: white} </style>
  </head>
  <body>
  <table class="ts sortable table">
	<?php
		$printed = false;
		ini_set('auto_detect_line_endings',TRUE);
		$handle = fopen($_GET["file"],'r');
		while ( ($data = fgetcsv($handle) ) !== FALSE ) {
			if(array_filter($data)){
				if(isset($_GET["headers"]) && $printed == false){
					echo "<thead>";
				}else if($printed == false){
					echo "<thead>";
				}
					echo "<tr>";
						for($i=0;$i<sizeOf($data);$i++){
							if(isset($_GET["headers"]) && $printed == false){
								echo "<th>".$data[$i]."</th>";
							}else if(!isset($_GET["headers"]) && $printed == false){
								$displayVal = $i + 1;
								echo "<th>Row ". $displayVal ."</th>";
							}else{
								echo "<td>".$data[$i]."</td>";
							}
						}
					echo "</tr>";
					
				if($printed == false){
					echo "</thead><tbody>";
				}
				if(!isset($_GET["headers"]) && $printed == false){
					for($i=0;$i<sizeOf($data);$i++){
						echo "<td>".$data[$i]."</td>";
					}
				}
				$printed = true;
			}
		}
		ini_set('auto_detect_line_endings',FALSE);
	?>
				
		</tbody>
	</table>
		<?php 
		if(!isset($_GET["headers"])){
				echo '<div class="ts button" onclick=" window.location.href = window.location.href + \'&headers=1\';">This file contains header</div>';
			}else{
				echo '<div class="ts button" onclick=" window.location.href = window.location.href.replace(\'&headers=1\',\'\');">This file DON\'T contains header</div>';
			}
		?>
		<br>
	<script>
	ts('.ts.sortable.table').tablesort();
	</script>
  </body>

</html>
