<?php
namespace cncYTC;

class View {

	private $data = array();

	function __construct()
	{
		add_shortcode('cnc_yt_channel', [$this, 'shortcodeChannelPlayer']);
	}

	/**
	 * Assign new value to data stack
	 * @param  string $variable Variable name
	 * @param  mixed $value    Value of the variable
	 */
	public function assign($variable, $value)
	{
		$this->data[$variable] = $value;
	}

	/**
	 * Render content using the given template file
	 * @param  string $template Template file name without extension
	 * @return string           Generated HTML markup
	 */
	public function render($template)
	{
		extract($this->data);
		$file = CNC_YTC_TEMPLATE_DIR . CNC_YTC_DS . $template . '.tpl.php';
		if (!file_exists($file)) {
			throw new \Exception("File doesn't exist");
		}
		ob_start();
		include($file);
		return ob_get_clean();
	}

	/**
	 * Trim given text to specified length
	 * @param  string $string   Text to trim
	 * @param  int $length   Length in characters
	 * @param  string $replacer Pattern to end with
	 * @return string           Trimmed text
	 */
	public function limitString($string, $length, $replacer = '...') {
	  if (strlen($string) > $length)
	     $string = mb_substr($string, 0, $length-3) . $replacer;
	  return $string;
	}

	/**
	 * Generate channel player shortcode
	 * @param  array $args Given attributes
	 */
	public function shortcodeChannelPlayer($args)
	{
	    // extract the attributes into variables
	    $atts = shortcode_atts(array(
	        'num' => -1,
	    ), $args);

	    $this->assign('', $events);
	    return $this->render('');
	}
}
