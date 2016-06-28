<?php
include '../configs.php';
include '../db.php';

header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

$sql = 'select id, singer, songName from fav order by id';
$result = execute_query($sql);

if (empty($result) || $result->num_rows <=0) {
	echo "<div class=\"alert alert-warning\" role=\"alert\">Nothing yet saved in favorites.</div>";
	die();	
}


print "<ul class=\"list-group\">\n";
while($row = $result->fetch_assoc()) {
	// song name is in the format of singer+singer-songname so we want to break it apart for the display
	$song_name = $row['songName'];

	$singer = $row['singer'];
	$singer = (String) preg_replace("/\+/", " & ", $singer);
	
	$song_id = $row['id'];

	// print_r($song);
	print "	<li class=\"list-group-item";
	print "\" id=\"song-" . $song_id . "\"><div class=\"row\">\n";
	
	print "		<div class=\"col-xs-8\">\n";
	print "			<h4 class=\"list-group-item-heading\">" . $song_name . "</h4>\n";
	print "			<small class=\"text-lowercase list-group-item-text\">" . $singer . "</small>\n";
	print "		</div>\n";
	print "		<div class=\"col-xs-4\">\n";
	print "			<button type=\"button\" class=\"btn btn-primary btn-sm\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\" onclick=\"playSong(" . $song_id . ");\"></span></button>\n";
	print "			<button type=\"button\" class=\"btn btn-warning btn-sm\"><span class=\"glyphicon glyphicon-star\" aria-hidden=\"true\" onclick=\"deleteSong('" . $song_id . "','" . $song_name . "','" . $singer . "'); $(this).closest('li').remove();\"></span></button>\n";
	print "		</div>\n";
	print "	</div></li>\n";
}
print "</ul>\n";


?>