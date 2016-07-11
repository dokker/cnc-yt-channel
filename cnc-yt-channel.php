<?php
/*
Plugin Name: CNC Youtube channel player
Plugin URI: http://colorandcode.hu
Description: Youtube channel player shortcode
Version: 1.0
Author: docker
Author URI: https://hu.linkedin.com/in/docker
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// load translations
load_plugin_textdomain( 'cnc-yt-channel-newsletter', false, 'cnc-yt-channel/languages' );

/**
 * Initial settings
 */
define('CNC_DS', DIRECTORY_SEPARATOR);
define('CNC_PROJECT_PATH', realpath(dirname(__FILE__)));
define('CNC_PROJECT_URL', plugins_url() . CNC_DS . 'cnc-yt-channel');
define('CNC_TEMPLATE_DIR', CNC_PROJECT_PATH . CNC_DS . 'templates');
define('CNC_THEME', get_stylesheet_directory());

/**
 * Autoload
 */
$vendorAutoload = CNC_PROJECT_PATH . CNC_DS . 'vendor' . CNC_DS . 'autoload.php';
if (is_file($vendorAutoload)) {
	require_once($vendorAutoload);
}

function __cnc_yt_channel_load_plugin()
{
	$controller = new \cncYTC\Controller();
}

add_action('plugins_loaded', '__cnc_yt_channel_load_plugin');
