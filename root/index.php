﻿<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "kko";

function isAscii($str) {
    return 0 == preg_match('/[^\x00-\x7F]/', $str);
}

if (!empty($_GET) && $_GET['songSelected'] != null) {
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset('utf8');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "call sp_add2PlayList('" . $_GET['songSelected'] . "')";
	$cname=$conn->query($sql);
	
	header('Location: http://' . $_SERVER['SERVER_NAME']);
}

header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- Bootstrap core CSS and JS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery-1.12.4.min.js"></script>		
		<script src="js/bootstrap.min.js"></script>
		
		<!-- load vlc js -->
		<script src="js/vlc.js"></script>
		
		<!-- load my css overrides -->
		<link href="css/styles.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<meta name="description" content="This is a remote VLC controller scaled for mobile devices.">
		<title>My VLC Controller</title>

	</head>
	
	<body>
		<!-- top nav bar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<form method="post" class="navbar-form navbar-center" role="search">
					<div class="form-group">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myPlaylist" onclick="loadPlaylist();"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
						<label><input type="text" class="form-control" name="name" placeholder="歌手 / 歌名 / Singer / Song"/></label>
						<label class="hidden-xs">
							<select class="form-control" name="singSong">
								<option value="all" default>所有 / All</option>
								<option value="singer">歌手 / Singer</option>
								<option value="song">歌名 / Song</option>
							</select>
						</label>
						<button type="submit" name="submit" value="search" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
					</div>
				</form>
			</div>
		</nav>

		<!-- nav footer controls -->
		<nav class="navbar navbar-inverse navbar-fixed-bottom">
			<div class="container btn-group" role="group">
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-step-backward" aria-hidden="true" onclick="previousPlaylist();"></span></button>
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-play" aria-hidden="true" onclick="playPlaylist();"></span></button>
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-pause" aria-hidden="true" onclick="pausePlaylist();"></span></button>
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-stop" aria-hidden="true" onclick="stopPlaylist();"></span></button>
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-step-forward" aria-hidden="true" onclick="nextPlaylist();"></span></button>

				<!-- audio track buttons -->
				<div class="btn-group dropup" role="group">
					<button type="button" class="btn btn-default btn-lg navbar-btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenu2" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-cd" aria-hidden="true"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
						<li class="dropdown-header">Speed</li>
						<li><a href="#" onclick="playbackSpeed('fast');">Fast</span></a></li>
						<li><a href="#" onclick="playbackSpeed('faster');">Faster</span></a></li>
						<li><a href="#" onclick="playbackSpeed('normal');">Normal</span></a></li>
						<li><a href="#" onclick="playbackSpeed('slower');">Slower</span></a></li>
						<li><a href="#" onclick="playbackSpeed('slow');">Slow</span></a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Audio</li>
						<li><a href="#" onclick="playAudioTrack1();">Track 1</span></a></li>
						<li><a href="#" onclick="playAudioTrack2();">Track 2</span></a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Video</li>
						<li><a href="#" onclick="switchTo4x3video();">4x3</span></a></li>
						<li><a href="#" onclick="switchTo16x9video();">16x9</span></a></li>
						<li><a href="#" onclick="toggleFullscreen();">Fullscreen</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<!-- Playlist modal section -->
		<div class="modal fade" id="myPlaylist" tabindex="-1" role="dialog" aria-labelledby="myPlaylist">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myPlaylist">Playlist</h4>
					</div>
					<div class="modal-body" id="playlist">
						<ul class="list-group">
							<li class="list-group-item">aaaa</li>
							<li class="list-group-item active">aaaa</li>
							<li class="list-group-item">aaaa</li>
							<li class="list-group-item">aaaa</li>
							<li class="list-group-item">aaaa</li>
							<li class="list-group-item">aaaa</li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" onclick="clearPlaylist();">Clear All</button>
					</div>
				</div>
			</div>
		</div>
		
<?php
if(@$_POST['submit']) {
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset('utf8');

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// check something is entered or die
	if (empty($_POST["name"])) {
		die("<div>Nothing entered.</div>");		
	}
	
	$inputname = trim($_POST["name"]);
	$query_parameters = "";

	if ($_POST["singSong"] == "singer") {
		// singer name is enter
		$query_parameters = "singer like '%$inputname%'";

		// name may be English
		if (isAscii($inputname)){
			$query_parameters .= " or singerEng like '%$inputname%'";
		}		
	}
	else if ($_POST["singSong"] == "song") {
		$query_parameters = "songName like '%$inputname%'";
	}
	else {
		//return everything
		// singer name is enter
		$query_parameters = "singer like '%$inputname%'";

		// name may be English
		if (isAscii($inputname)){
			$query_parameters .= " or singerEng like '%$inputname%'";
		}		

		$query_parameters .= " or songName like '%$inputname%'";
	}
			
	//Assemble sql command with all parameters
	$sql = "SELECT songName, singer, dirpath FROM songs where $query_parameters";
	//print "<pre>$sql</pre>"; die();

	$result = $conn->query($sql);
	if ($result != null && $result->num_rows > 0) {
		echo "<div class=\"list-group\">\n";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<div class=\"row list-group-item\">\n";
			echo "  <div class=\"col-xs-10\">";
			echo "		<h4 class=\"list-group-item-heading\">" . $row["songName"] . "</h4>\n";
			echo "		<small class=\"text-lowercase list-group-item-text\">" . str_replace('+',' & ',$row['singer']) . "</small>\n";
			echo "	</div>";
			echo "	<div class=\"col-xs-2\">";
			echo "		<button type=\"button\" class=\"btn btn-default\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\" onclick=\"addToPlaylist('" . rawurlencode($row["dirpath"] . "\\" . $row['singer'] . "-" . $row["songName"] . ".mkv") . "');\"></span></button>\n";
			echo "  </div>";
			echo "</div>\n";
		}
		echo "</div>\n";
	} else {
		echo "<div>No matching results found.</div>\n";
	}
	
	$conn->close();
}
	
?>		
		
	</body>
</html>