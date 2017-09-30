<html>
<head><title>Sermon Audio</title>
<style>
.tile{
	border:1px solid black;
	width:300px;
	height:200px;
	padding:5px;
	float:left;
}
</style>
</head>
<body>
<?php
$config = parse_ini_file('sermonaudioconfig.ini');
require_once($config["getid3path"]);
$getID3 = new getID3;
$dir    = getcwd();
$files1 = scandir($dir);

foreach($files1 as $f){
	if(strrpos($f,"mp3")>0){
		echo "<div class='tile'>";
		//echo "<div>";
		$t = $getID3->analyze($f);
		echo showtag($t["tags"]["id3v2"]["title"][0],"title");
		echo showtag($t["tags"]["id3v2"]["year"][0],"year");
		echo showtag($t["playtime_string"],"playtime");
		echo "<p class='player'><audio controls><source src='".$f."' type='audio/mpeg'>Your browser does not support audio. Download the file <a href='".$f."'>here</a>.</audio></p>";
		echo "</div>";
	}
}

function showtag($tag,$class){
	if(isset($tag)){
		return "<p class='".$class."'>".$tag."</p>";
	}
	else{
		return "<p class='".$class."'>Unknown</p>";
	}
}
?>
</body>
</html>