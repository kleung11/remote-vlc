function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

/*
function processSettings($settings) {
	console.log($settings);
	console.log($settings.information.category);
	
	if ($settings !== null && $settings !== undefined) {
		$.each( $settings.information.category, function( key, value ) {
			if (value.Type == 'Audio') {
				alert(key.match(/\d/));
				 $("#audio-setting-" . key.match(/\d/)).
			}
		});
	}
	$( "#settings-menu" ).load( 'http://' + location.hostname + '/requests/playlist.php', function() {});
}
*/
/*
$(function() {
	$('#settings').click(function() {
		getStatus();
	});
	
	$('#settings').click();
});
*/

$(function() {
	var currentValue = $('#speedValue');
	
	$('#speedSlider').change(function() {
		currentValue.html(this.value);
		playbackSpeed(this.value);
	});
	
	$('#speedSlider').change();
});

