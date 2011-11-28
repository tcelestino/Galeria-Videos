function player(v_id) {
	var vid = new Flash("http://www.youtube.com/v/"+v_id, "player", "510", "292", "10");
                 vid.addParameter("scale", "noscale");
                 vid.addParameter("wmode", "transparent");
				 jQuery('#player').html(vid.toString());
}

jQuery(function() {
	var video = jQuery('ul#thumbVideos li:first a').attr('rel');
	
	

	player(video);
	
	jQuery('ul#thumbVideos li a').click(function(e) {
		player(jQuery(this).attr('rel') 
		);
		e.preventDefault();
	});

});
