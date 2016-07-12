<?php
namespace cncYTC;

class Controller {
	private $view;

	function __construct () {
		$this->view = \cncYTC\View();
		add_action('wp_enqueue_scripts', [$this, 'registerScripts']);
		add_action('wp_enqueue_scripts', [$this, 'registerStyles']);
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
			wp_enqueue_style( 'cnc-yt-channel-style' , CNC_PROJECT_URL . CNC_DS . 'assets/css/style.css');
		}
	}
}
