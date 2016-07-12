<?php
namespace cncYTC;

class Controller {
	private $view;
	private $player_template;

	function __construct () {
		$this->view = new \cncYTC\View();
		add_action('wp_enqueue_scripts', [$this, 'registerScripts']);
		add_action('wp_enqueue_scripts', [$this, 'registerStyles']);

		add_shortcode('cnc_yt_channel', [$this, 'shortcodeChannelPlayer']);
        $config = include(CNC_YTC_PROJECT_PATH . CNC_YTC_DS . 'config.php');
        if ($config) {
            $this->player_template = $config['player_template'];
        }
	}

	/**
	 * Register scripts
	 */
	public function registerScripts() {
		if (true) {
			wp_register_script('cnc-yt-channel-script', CNC_YTC_PROJECT_URL . CNC_YTC_DS . 'assets/js/script.js', array('jquery'));
			wp_enqueue_script('cnc-yt-channel-script');
		}
	}

	/**
	 * Register styles
	 */
	public function registerStyles() {
		if (true) {
			wp_enqueue_style( 'cnc-yt-channel-style' , CNC_YTC_PROJECT_URL . CNC_YTC_DS . 'assets/css/style.css');
		}
	}

	/**
	 * Generate channel player shortcode
	 * @param  array $args Given attributes
	 */
	public function shortcodeChannelPlayer($args)
	{
	    // extract the attributes into variables
	    $atts = shortcode_atts(array(
	        'num' => 4,
	    ), $args);

	    $this->yt = new \cncYTC\Youtube();
	    $this->view->assign('video_featured', $this->yt->getFeaturedHTML(''));
	    $this->view->assign('video_list', $this->yt->getHTML($atts['num']));
	    return $this->view->render($this->player_template);
	}
}
