<?php
$site = $_SERVER['SERVER_NAME'];
$port = "8080";
$username = "";
$password = "ricky";
$path = "/requests/status.json?command=";

if (!empty($_GET)) {
	switch ($_GET['command']) {
		case 'add':
			if (empty($_GET['song'])) {
				//id not given so do nothing
				die("Missinng parameter: song");
			}

			// $path of song might be have spaces in DB and we store them with _ in the file system
			$song = (String) preg_replace("/ /", "_", $_GET['song']);

			$path .= 'in_enqueue&input=' . urlencode($song);
			//header('Content-Type: text/html; charset="UTF-8"');
			//echo "here" . $song . "there" . "<br/>";
			//echo $path; die();
			break;
		case 'aspect4x3':
			$path .= 'aspectratio&val=4:3';
			break;
		case 'aspect16x9':
			$path .= 'aspectratio&val=16:9';
			break;
		case 'audioTrack':
			if (empty($_GET['track'])) {
				//id not given so do nothing
				die("Missinng parameter: track");
			}

			$path .= 'audio_track&val=' . $_GET['track'];
			break;
		case 'clearPlaylist':
			$path .= 'pl_empty';
			break;
		case 'deleteSong':
			if (empty($_GET['song_id'])) {
				//id not given so do nothing
				die("Missinng parameter: song_id");
			}
			$path .= 'pl_delete&id=' . $_GET['song_id'];
			break;
		case 'fullscreen':
			$path .= 'fullscreen';
			break;
		case 'next':
			$path .= 'pl_next';
			break;
		case 'pause':
			$path .= 'pl_pause';
			break;
		case 'playbackSpeed':
			$speed = 1;
			if (!empty($_GET['speed'])) {
				$speed = $_GET['speed'];
			}
			
			$path .= 'rate&val=' . $speed;
			break;
		case 'previous':
			$path .= 'pl_previous';
			break;
		case 'stop':
			$path .= 'pl_stop';
			break;
		default:
			// pl_pause also works...
			$path .= 'pl_play';
			
			// play a specific number on the playlist
			if (!empty($_GET['song_id'])) {
				$path .= '&id=' . $_GET['song_id'];
				//echo $path; die();
			}
			break;
	}
}

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

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

print $output;
?>