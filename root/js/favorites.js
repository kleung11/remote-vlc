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

function deleteFromFavorites($song_id) {
	$.ajax( {
		type:'Get',
		dataType: "json",
		url:'http://' + location.hostname + '/requests/favorites/update.php?command=delete&song_id=' + $song_id,
	});
	$(this).closest('button').remove();
}

$(function() {
	var buttons = $('button');

	buttons.click(function() {
		if ($(this).hasClass('favoriteButton')) {
			//alert('here');
			//$(this).removeClass('btn-default');
			//$(this).addClass('btn-warning');		

			if ($(this).children('span').hasClass('glyphicon-star')) {
				$(this).children('span').removeClass('glyphicon-star');
				$(this).children('span').addClass('glyphicon-star-empty');
				deleteFromFavorites($(this).attr('value'));
			}
			else {
				$(this).children('span').removeClass('glyphicon-star-empty');
				$(this).children('span').addClass('glyphicon-star');
				addToFavorites($(this).attr('value'));
			}
		};
	});	
});


