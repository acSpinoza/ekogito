<?php

/**
 * 
 * @package SGI\SSR
 */

/**
 * 
 * Main class for WP-Admin hooks
 * 
 * This class loads all of our backend hooks and sets up our admin interfaces
 * 
 * @subpackage Admin Interfaces
 * @author Sibin Grasic
 * @since 1.0
 * @var version - plugin version
 * @var opts - plugin opts
 */
class SGI_FitVids_Backend
{

	private $version;
	private $opts;

	/**
	 * Sgi SSR Admin constructor
	 * 
	 * Constructor first checks for the plugin version. If this is the first activation, plugin adds version info to the DB with autoload option set to false.
	 * In that manner we can easily change plugin options and defaults accross versions, and preserve compatibility
	 * @return void
	 */
	public function __construct()
	{

		if ( $ssr_ver = get_option('sgi_fitvids_ver') ) :
			//$this->version = $ssr_ver;

			if (version_compare(SGI_FITVIDS_VERSION,$ssr_ver,'>')) :
				update_option('sgi_fitvids_ver', SGI_FITVIDS_VERSION);
				$this->version = SGI_FITVIDS_VERSION;
			endif;

		else :
			$ssr_ver = SGI_FITVIDS_VERSION;
			add_option('sgi_fitvids_ver',$ssr_ver,'','no');
		endif;

		$ssr_opts = get_option('sgi_fitvids_opts',
			array(
				'selector' => '.entry-content',
				'active'   => array(
					'post' => true,
					'page' => true,
					'fp'   => true,
					'arch' => true,
				)
		));

		$this->opts = $ssr_opts;

		add_action('admin_init', array(&$this,'register_settings'));
		add_filter('plugin_action_links_'.SGI_FITVIDS_BASENAME, array(&$this,'add_settings_link'));
	}

	/**
	 * Function that adds settings link to the plugin page
	 * @param array $links 
	 * @return array - merged array with our links
	 * @author Sibin Grasic
	 * @since 1.0
	 */
	public function add_settings_link($links)
	{
		$admin_url = admin_url();
		$link = array("<a href=\"${admin_url}options-reading.php#sgi-fitvids\">Settings</a>");

		return array_merge($links,$link);
	}

	/**
	 * Function that is hooked into the admin initialisation and registers settings
	 * @return void
	 * @author Sibin Grasic
	 * @since 1.0
	 */
	public function register_settings()
	{
		add_settings_section('sgi_fitvids_opts','Responsive video options',array(&$this, 'settings_section_info'), 'reading');

		add_settings_field('sgi_fitvids_opts[selector]', __('CSS selector for script','sgifitvids'), array(&$this,'selector_callback'), 'reading', 'sgi_fitvids_opts', $this->opts['selector']);
		add_settings_field('sgi_fitvids_opts[active]', __('Activation options','sgifitvids'), array(&$this,'active_callback'), 'reading', 'sgi_fitvids_opts', $this->opts['active']);

		register_setting('reading','sgi_fitvids_opts',array(&$this,'sanitize_opts'));

	}

	/**
	 * Function that displays the section heading information
	 * @author Sibin Grasic
	 * @since 1.0
	 */
	public function settings_section_info()
	{
		echo '<div id="sgi-fitvids"></div><p>'.__('These are the settings for the FitVids responsive Videos','sgifitvids').'</p>';
	}

	/**
	 * Function that displays the input box for the CSS selestor
	 * @param string $selector 
	 * @return void
	 * @author Sibin Grasic
	 * @since 1.0
	 */
	public function selector_callback($selector)
	{
		echo "<input type=\"text\" name=\"sgi_fitvids_opts[selector]\" value=\"${selector}\">".'<br>';
		echo "<small>".__('Default selector is .entry-content, if you\'re having compatibility issues, change the CSS selector','sgifitvids').'</small>';
	}

	public function active_callback($active)
	{
		$local_opts = array(
			'post' => checked($active['post'],true,false),
			'page' => checked($active['page'],true,false),
			'fp'   => checked($active['fp'],true,false),
			'arch' => checked($active['arch'],true,false),
		);

		echo "<input type=\"checkbox\" name=\"sgi_fitvids_opts[active][post]\" {$local_opts['post']} ><label>Single Post</label><br>";
		echo "<input type=\"checkbox\" name=\"sgi_fitvids_opts[active][page]\" {$local_opts['page']} ><label>Single Page</label><br>";
		echo "<input type=\"checkbox\" name=\"sgi_fitvids_opts[active][fp]\" 	 {$local_opts['fp']} ><label>Front Page</label><br>";
		echo "<input type=\"checkbox\" name=\"sgi_fitvids_opts[active][arch]\" {$local_opts['arch']} ><label>Archive Pages</label>";

	}

	/**
	 * Function that "sanitizes options"
	 * 
	 * @param array $opts
	 * @return array options array
	 * @author Sibin Grasic
	 * @since 1.0
	 * 
	 */
	public function sanitize_opts($opts)
	{

		

		foreach ($opts['active'] as $key => $value) :

			if ($value == 'on') :
				$opts['active'][$key] = true;
			else :
				$opts['active'][$key] = false;
			endif;
			
		endforeach;

		//var_dump($opts);die;

		return $opts;
	}
}