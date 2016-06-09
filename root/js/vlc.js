function loadPlaylist() {
	$( "#playlist" ).load( 'http://' + location.hostname + '/requests/playlist.php', function() {});
}

function addToPlaylist($song) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=add&song=' + $song,
	});
}

function clearPlaylist() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=clearPlaylist',
	});

}

function deleteSong($id) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=deleteSong&song_id=' + $id,
	});

}

function nextPlaylist() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=next',
	});

}

function pausePlaylist() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=pause',
	});

}

function playbackSpeed($speed) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=playbackSpeed&speed=' + $speed,
	});
}

function playPlaylist() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=play',
	});

}

function playAudioTrack($track) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=audioTrack&track=' + $track,
	});

}

function playSong($id) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=play&song_id=' + $id,
	});

}

function previousPlaylist() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=previous',
	});

}

function switchTo4x3video() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=aspect4x3',
	});
}

function switchTo16x9video() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=aspect16x9',
	});
}
	
function stopPlaylist() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=stop',
	});

}

function toggleFullscreen() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=fullscreen',
	});
}

