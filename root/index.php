<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- Bootstrap core CSS and JS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery-1.12.4.min.js"></script>		
		<script src="js/bootstrap.min.js"></script>
		
		<!-- load vlc js -->
		<script src="js/vlc.js"></script>
		
		<!-- load settings js -->
		<script src="js/settings.js"></script>

		<!-- load favorites js -->
		<script src="js/favorites.js"></script>
		
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
			<form method="post" class="navbar-form navbar-left" role="search" id="search-form">
					<div class="col-xs-2 col-sm-1">						
						<button type="button" class="btn btn-primary btn-sm pull-left" data-toggle="modal" data-target="#myPlaylist" onclick="loadPlaylist();"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
					</div>
					<div class="col-xs-6 col-sm-5">
						<label><input type="text" class="form-control" name="name" id="search-name" placeholder="歌手 / 歌名 / Singer / Song"/></label>
					</div>
					<label class="hidden-xs col-sm-3">
						<select class="form-control" name="singSong" id="search-singSong">
							<option value="all" default>所有 / All</option>
							<option value="singer">歌手 / Singer</option>
							<option value="song">歌名 / Song</option>
						</select>
					</label>
					<div class="col-xs-2 col-sm-1">
						<button type="submit" name="submit" value="search" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
					</div>
					<div class="col-xs-1 col-sm-1">
						<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myFavorites" onclick="loadFavorites();"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>
					</div>
			</form>
		</nav>
		
		<!-- nav footer controls -->
		<nav class="navbar navbar-inverse navbar-fixed-bottom">
			<div class="container btn-group" role="group">
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-step-backward" aria-hidden="true" onclick="previousPlaylist();"></span></button>
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-play" aria-hidden="true" onclick="pausePlaylist();"></span>/<span class="glyphicon glyphicon-pause" aria-hidden="true" onclick="pausePlaylist();"></span></button>
<!--				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-stop" aria-hidden="true" onclick="stopPlaylist();"></span></button>-->
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-step-forward" aria-hidden="true" onclick="nextPlaylist();"></span></button>
				<!-- quick track change buttons -->
				<button type="button" class="btn btn-default btn-lg navbar-btn"><span class="glyphicon glyphicon-sound-dolby" aria-hidden="true" onclick="playAudioTrack();"></span></button>
				<!-- settings -->
				<div class="btn-group dropup" role="group">
					<button type="button" id="settings" class="btn btn-default btn-lg navbar-btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenu2" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						<span class="caret"></span>
					</button>
					<ul id="settings-menu" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
						<li class="dropdown-header">Speed</li>
						<li>
							<input type="range" id="speedSlider" min="0.01" max="2" step="0.01" value="1" list="powers"/>
							<datalist id="powers">
								<option value="1">
								<option value=".5">
								<option value="1.5">
							</datalist>
							<p id="speedValue" class="text-center">1</p>
						</li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Audio</li>
						<li id="audio-setting-1"><a href="#" onclick="playAudioTrack(1);">Track 1</span></a></li>
						<li id="audio-setting-2"><a href="#" onclick="playAudioTrack(2);">Track 2</span></a></li>
						<li id="audio-setting-3"><a href="#" onclick="playAudioTrack(3);">Track 3</span></a></li>
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
						<button type="button" class="btn btn-default btn-sm" onclick="clearPlaylist(); $('#playlist').html('<div class=\'alert alert-warning\' role=\'alert\'>Playlist is empty.</div>');">Clear All</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Favorites modal section -->
		<div class="modal fade" id="myFavorites" tabindex="-1" role="dialog" aria-labelledby="myFavorites">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myFavorites">Favorites</h4>
					</div>
					<div class="modal-body" id="favorites">
						<ul class="list-group">
							<li class="list-group-item">aaaa</li>
							<li class="list-group-item active">aaaa</li>
							<li class="list-group-item">aaaa</li>
							<li class="list-group-item">aaaa</li>
							<li class="list-group-item">aaaa</li>
							<li class="list-group-item">aaaa</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
<?php
// place this after the navs so the navigations will always appear
include 'configs.php';
include 'db.php';

function isAscii($str) {
    return 0 == preg_match('/[^\x00-\x7F]/', $str);
}

if(@$_POST['submit']) {
	// check something is entered or die
	if (empty($_POST["name"])) {
		die("<div>Nothing entered.</div>");		
	}
	
	$inputname = trim($_POST["name"]);
	$query_parameters = "";

	if ($_POST["singSong"] == "singer") {
		// singer name is enter
		$query_parameters = "s.singer like '%$inputname%'";

		// name may be English
		if (isAscii($inputname)){
			$query_parameters .= " or s.singerEng like '%$inputname%'";
		}		
	}
	else if ($_POST["singSong"] == "song") {
		$query_parameters = "s.songName like '%$inputname%'";
	}
	else {
		//return everything
		// singer name is enter
		$query_parameters = "s.singer like '%$inputname%'";

		// name may be English
		if (isAscii($inputname)){
			$query_parameters .= " or s.singerEng like '%$inputname%'";
		}		

		$query_parameters .= " or s.songName like '%$inputname%'";
	}
			
	//Assemble sql command with all parameters
	$sql = "SELECT s.id, s.songName, s.singer, s.dirpath, f.id AS fav_id FROM songs s LEFT JOIN hit_songs h ON s.id=h.song_id LEFT JOIN fav f ON s.id=f.song_id WHERE $query_parameters ORDER BY h.played DESC";
	//print "<pre>$sql</pre>"; die();

	$result = execute_query($sql);
	if ($result != null && $result->num_rows > 0) {
		echo "<div class=\"list-group\">\n";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<div class=\"row list-group-item\">\n";
			echo "  <div class=\"col-xs-8\">\n";
			echo "		<h4 class=\"list-group-item-heading\">" . $row["songName"] . "</h4>\n";
			echo "		<small class=\"text-lowercase list-group-item-text\">" . str_replace('+',' & ',$row['singer']) . " <a href=\"javascript:void(0)\" onclick=\"document.getElementById('search-name').value='" . $row['singer'] . "';\"><span class=\"glyphicon glyphicon-zoom-in\" aria-hidden=\"true\"></span></a></small>\n";
			echo "	</div>\n";
			echo "	<div class=\"col-xs-4\">\n";
			echo "		<button type=\"button\" class=\"btn btn-default\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\" onclick=\"addToPlaylist('" . rawurlencode($row["dirpath"] . "\\" . $row['singer'] . "-" . $row["songName"] . ".mkv") . "', " . $row["id"] . ");\"></span></button>\n";

			echo "		<button type=\"button\" class=\"btn btn-default favoriteButton\" value=\"" . $row["id"] . "\"><span class=\"glyphicon glyphicon-star";
			if (empty($row["fav_id"])) { 
				echo "-empty"; 
			}
			echo "\" aria-hidden=\"true\"></span></button>\n";

			echo "  </div>\n";
			echo "</div>\n";
		}
		echo "</div>\n";
	} else {
		echo "<div>No matching results found.</div>\n";
	}
	
}
	
?>		
		
	</body>
</html>
