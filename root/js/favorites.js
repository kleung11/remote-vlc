function loadFavorites() {
	$( "#favorites" ).load( 'http://' + location.hostname + '/requests/favorites.php', function() {});
}

function addToFavorites($song_id) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/favorites/update.php?command=add&song_id=' + $song_id,
	});
	$(this).closest('button').remove();
}

function deleteFromFavorites($fav_id) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/favorites/update.php?command=delete&fav_id=' + $fav_id,
	});
	$(this).closest('button').remove();
}
