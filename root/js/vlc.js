// dumb way of keeping track of which song track we are playing
$playTrack = 1;

function loadPlaylist() {
	$( "#playlist" ).load( 'http://' + location.hostname + '/requests/playlist.php', function() {});
	
	 setTimeout(loadPlaylist, 10000); // reload every 10 seconds
}

function addToPlaylist($song, $song_id) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=add&song=' + $song + '&song_id=' + $song_id,
	});
}

function clearPlaylist() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=clearPlaylist',
	});

}

function deleteFromPlaylist($song_id, $song, $singer) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php?command=delete&song_id=' + $song_id + '&song=' + $song + '&singer=' + $singer,
	});

}

function getStatus() {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/status.php',
//		success:function($response) {
            // For example, filter the response
//            processSettings($response);
//        },
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
	
	if (!$track) {
		// we will update the current playing track and use that instead
		if ($playTrack == 1) {
			$playTrack = 2;
		}
		else {
			$playTrack = 1;
		}
		
		$track = $playTrack;
	}
	
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

$(function() {
	var buttons = $('button');

	buttons.click(function() {
		if ($(this).hasClass('addPlaylistButton')) {
			// value contains song_id, name of song, and singer
			$values = $(this).attr('value').split(",");
			$song_id = $values[0];
			$song = $values[1];
			$singer = $values[2]; // not currently used

			if (!$(this).prop('disabled')) {
				$(this).prop('disabled', true);
				addToPlaylist($song, $song_id);
			}
		};
	});	
});

loadPlaylist();