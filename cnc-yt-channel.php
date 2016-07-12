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
load_plugin_textdomain( 'cnc-yt-channel', false, 'cnc-yt-channel/languages' );

/**
 * Initial settings
 */
define('CNC_YTC_DS', DIRECTORY_SEPARATOR);
define('CNC_YTC_PROJECT_PATH', realpath(dirname(__FILE__)));
define('CNC_YTC_PROJECT_URL', plugins_url() . CNC_YTC_DS . 'cnc-yt-channel');
define('CNC_YTC_TEMPLATE_DIR', CNC_YTC_PROJECT_PATH . CNC_YTC_DS . 'templates');
define('CNC_YTC_THEME', get_stylesheet_directory());

/**
 * Autoload
 */
$vendorAutoload = CNC_YTC_PROJECT_PATH . CNC_YTC_DS . 'vendor' . CNC_YTC_DS . 'autoload.php';
if (is_file($vendorAutoload)) {
	require_once($vendorAutoload);
}

function __cnc_yt_channel_load_plugin()
{
	$controller = new \cncYTC\Controller();
}

add_action('plugins_loaded', '__cnc_yt_channel_load_plugin');
