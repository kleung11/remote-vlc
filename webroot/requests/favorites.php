<?php
include '../configs.php';
include '../db.php';

header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

$sql = 'select s.singer, s.song_name, s.song_location, f.song_id from favorites f, songs s where f.song_id=s.id order by f.id';
$result = execute_query($sql);

if (empty($result) || $result->num_rows <=0) {
	echo "<div class=\"alert alert-warning\" role=\"alert\">Nothing yet saved in favorites.</div>";
	die();	
}


print "<ul class=\"list-group\">\n";
while($row = $result->fetch_assoc()) {
	// file stores song name in the format of singer+singer-songname so we will need to construct it back
	$song_name = $row['song_name'];
	$singer = $row['singer'];	
	$song_id = $row['song_id'];
	$song_location = $row['song_location'];

	// print_r($song);
	print "	<li class=\"list-group-item";
	print "\" id=\"song-" . $song_id . "\"><div class=\"row\">\n";
	
	print "		<div class=\"col-xs-8\">\n";
	print "			<h4 class=\"list-group-item-heading\">" . $song_name . "</h4>\n";
	print "			<small class=\"text-lowercase list-group-item-text\">" . preg_replace("/\+/", " & ", $singer) . "</small>\n";
	print "		</div>\n";
	print "		<div class=\"col-xs-4\">\n";
	print "			<button type=\"button\" class=\"btn btn-primary btn-sm\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\" onclick=\"addToPlaylist('" . rawurlencode($song_location) . "', " . $song_id . ");\"></span></button>\n";
	print "			<button type=\"button\" class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-star\" aria-hidden=\"true\" onclick=\"deleteFromFavorites('" . $song_id . "'); $(this).closest('li').remove();\"></span></button>\n";
	print "		</div>\n";
	print "	</div></li>\n";
}
print "</ul>\n";


?>