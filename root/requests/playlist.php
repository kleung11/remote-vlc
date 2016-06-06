<?php
$site = $_SERVER['SERVER_NAME'];
$port = "8080";
$username = "";
$password = "ricky";
$path = "/requests/playlist.json";
// create curl resource 
$ch = curl_init(); 
// set url 
curl_setopt($ch, CURLOPT_URL, $site . $path); 
curl_setopt($ch, CURLOPT_PORT, $port);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, ":$password");
//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
// $output contains the output string 
$output = curl_exec($ch); 
// close curl resource to free up system resources 
curl_close($ch);      

header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

//echo $output; die();
if (empty($output)) {
	//VLC server is not up
	echo "<div class=\"alert alert-danger\" role=\"alert\">Oh snap! VLC is not running.</div>";
	die();
}

$playlist = (array)json_decode($output);
//the server returns multiple playlist objects and we only want the first one.
$playlist = (array)$playlist['children'][0];

//print_r($playlist['children']); die();
if (empty($playlist['children'])) {
	// empty playlist
	echo "<div class=\"alert alert-warning\" role=\"alert\">Playlist is empty.</div>";
	die();
}

print "<ul class=\"list-group\">\n";
foreach ($playlist['children'] as $value) {
	$song = (array)$value;
	
	// get song name without the extension
	$extension = strrpos($song['name'],'.');
	$name = $song['name'];
	if ($extension !== false) {
		$name = substr($song['name'],0,$extension);
	}

	// print_r($song);
	print "	<li class=\"list-group-item";

	if (!empty($song['current'])) {
		// indiate that this is the current playing song
		print " active";
	}
	
	print "\" id=\"song-" . $song['id'] . "\"><div class=\"row\">\n";
	print "		<div class=\"col-xs-8\">" . $name . "</div>\n";
	print "		<div class=\"col-xs-4\">\n";
	print "			<button type=\"button\" class=\"btn btn-success btn-sm\"><span class=\"glyphicon glyphicon-play-circle\" aria-hidden=\"true\" onclick=\"playSong(" . $song['id'] . ");\"></span></button>\n";
	print "			<button type=\"button\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-remove-circle\" aria-hidden=\"true\" onclick=\"deleteSong(" . $song['id'] . "); $(this).closest('li').remove();\"></span></button>\n";
	print "		</div>\n";
	print "	</div></li>\n";
}
print "</ul>\n";


?>