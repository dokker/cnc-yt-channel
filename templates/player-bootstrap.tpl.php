<div class="youtube_player shortcode-block">
  <div class="col-sm-6 col-md-8" id="featured_video">
    	<div class="signal"></div>
    	<div class="video-container row"><?php echo $video_featured; ?></div>
  </div>
  <div class="col-sm-6 col-md-4">
    <?php echo $video_list; ?>
    <a class="more-yt-videos" href="<?php echo $yt_url; ?>" target="_blank">
      <?php _e('More', 'cnc-yt-channel'); ?></a>
  </div>
</div>
