jQuery(document).ready(function($) {
	$('.video-list-item').click(function() {
		$('.featured').removeClass('featured');
		$('#featured_video .video-container').fadeTo(400, 0).delay(400).fadeTo(400,1);
		$(this).addClass('featured');
		videoId = $(this).attr('data-video-id');
		iframe_html = '<iframe src="//www.youtube.com/embed/'+videoId+'"></iframe>';
		$('#featured_video .video-container').html(iframe_html);
	});
}); // Fully reference jQuery after this point.
