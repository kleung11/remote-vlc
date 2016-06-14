<?php
include '../configs.php';

$vlc_path = "/requests/status.json?command=";

function increment_song_counter($song_id) {
	global $db_servername, $db_username, $db_password, $db_name;
	
	// Create connection
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		//couldn't update counter but let's not die()
		return;
	}

	$sql = "INSERT INTO hit_songs (song_id, played) VALUES(" . $song_id . ",1) ON DUPLICATE KEY UPDATE played = played + 1";
	$cname=$conn->query($sql);
}

function decrement_song_counter($song_id) {
	/*
	global $db_servername, $db_username, $db_password, $db_name;
	
	// Create connection
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		//couldn't update counter but let's not die()
		return;
	}

	$sql = "UPDATE IGNORE hit_songs SET played = played - 1 WHERE song_id = " . $song_id;
	$cname=$conn->query($sql);
	*/
}

if (!empty($_GET)) {
	switch ($_GET['command']) {
		case 'add':
			if (empty($_GET['song'])) {
				//song not given so do nothing
				die("Missing parameter: song");
			}

			// $vlc_path of song might be have spaces in DB and we store them with _ in the file system
			$song = (String) preg_replace("/ /", "_", $_GET['song']);

			$vlc_path .= 'in_enqueue&input=' . urlencode($song);
			//header('Content-Type: text/html; charset="UTF-8"');
			//echo "here" . $song . "there" . "<br/>";
			//echo $vlc_path; die();
			
			//increment counter each time we add a song
			if (!empty($_GET['song_id'])) {
				increment_song_counter($_GET['song_id']);
			}
			break;
		case 'aspect4x3':
			$vlc_path .= 'aspectratio&val=4:3';
			break;
		case 'aspect16x9':
			$vlc_path .= 'aspectratio&val=16:9';
			break;
		case 'audioTrack':
			if (empty($_GET['track'])) {
				//track number not given so do nothing
				die("Missing parameter: track");
			}

			$vlc_path .= 'audio_track&val=' . $_GET['track'];
			break;
		case 'clearPlaylist':
			$vlc_path .= 'pl_empty';
			break;
		case 'deleteSong':
			if (empty($_GET['song_id'])) {
				//song_id not given so do nothing
				die("Missing parameter: song_id");
			}
			$vlc_path .= 'pl_delete&id=' . $_GET['song_id'];

			//decrement counter each time we remove a song
			if (!empty($_GET['song_id'])) {
				decrement_song_counter($_GET['song_id']);
			}
			
			break;
		case 'fullscreen':
			$vlc_path .= 'fullscreen';
			break;
		case 'next':
			$vlc_path .= 'pl_next';
			break;
		case 'pause':
			$vlc_path .= 'pl_pause';
			break;
		case 'playbackSpeed':
			$speed = 1;
			if (!empty($_GET['speed'])) {
				$speed = $_GET['speed'];
			}
			
			$vlc_path .= 'rate&val=' . $speed;
			break;
		case 'previous':
			$vlc_path .= 'pl_previous';
			break;
		case 'stop':
			$vlc_path .= 'pl_stop';
			break;
		case 'play':
			// pl_pause also works...
			$vlc_path .= 'pl_play';
			
			// play a specific number on the playlist
			if (!empty($_GET['song_id'])) {
				$vlc_path .= '&id=' . $_GET['song_id'];
				//echo $vlc_path; die();
			}
			break;
		default:
			// do nothing, just getting status info
			break;
	}
}

// create curl resource 
$ch = curl_init(); 
// set url 
curl_setopt($ch, CURLOPT_URL, $vlc_site . $vlc_path); 
curl_setopt($ch, CURLOPT_PORT, $vlc_port);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, ":$vlc_password");
//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
   
// $output contains the output string 
$output = curl_exec($ch); 
// close curl resource to free up system resources 
curl_close($ch);      

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

print $output;
?>