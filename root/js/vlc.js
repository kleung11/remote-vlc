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

function playbackSpeed($type) {
	switch ($type) {
		case 'fast':
			$.ajax( {
				type:'Get',
				dataType: "json",
				url:'http://' + location.hostname + '/requests/status.php?command=playbackFast',
			});
			break;
		case 'faster':
			$.ajax( {
				type:'Get',
				dataType: "json",
				url:'http://' + location.hostname + '/requests/status.php?command=playbackFaster',
			});
			break;
		case 'slow':
			$.ajax( {
				type:'Get',
				dataType: "json",
				url:'http://' + location.hostname + '/requests/status.php?command=playbackSlow',
			});
			break;
		case 'slower':
			$.ajax( {
				type:'Get',
				dataType: "json",
				url:'http://' + location.hostname + '/requests/status.php?command=playbackSlower',
			});
			break;
		default:
			$.ajax( {
				type:'Get',
				dataType: "json",
				url:'http://' + location.hostname + '/requests/status.php?command=playbackNormal',
			});
			break;
	}
}

function playPlaylist() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=play',
	});

}

function playAudioTrack1() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=audio1',
	});

}

function playAudioTrack2() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=audio2',
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

