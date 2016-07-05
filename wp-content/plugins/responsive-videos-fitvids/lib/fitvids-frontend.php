<?php

/**
 * 
 * @package SGI\SSR
 */

/**
 * 
 * Main plugin class
 * 
 * This class loads plugin options, enqueues scripts and loads up the selection sharer
 * 
 * @subpackage Frontend interfaces
 * @author Sibin Grasic
 * @since 1.0
 * @var opts - plugin options
 */
class SGI_FitVids_Frontend
{

	private $opts;

	/**
	 * Class Constructor
	 * 
	 * Loads default options (if none are saved) and enqueues our scripts
	 * @author Sibin Grasic
	 * @since 1.0
	 */
	public function __construct()
	{
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

		add_action('wp_enqueue_scripts',array(&$this,'load_scripts'),75);
	}

	/**
	 * Load our scripts when needed.
	 * 
	 * Since we only need selection share on single posts, we're checking if we're viewing single post or page
	 *
	 * @author Sibin Grasic
	 * @since 1.0
	 */
	public function load_scripts()
	{
		if ( (is_single() && $this->opts['active']['post']) || (is_page()  && $this->opts['active']['page']) || (is_home() && $this->opts['active']['fp']) || (is_archive()  && $this->opts['active']['arch']) ) : 

			
			wp_register_script( 'sgi-fitvids', plugins_url( "assets/js/jQuery.fitVids.js", SGI_FITVIDS_BASENAME ), array('jquery'), SGI_FITVIDS_VERSION, true);
			wp_enqueue_script('sgi-fitvids');


			add_action ('wp_footer',array (&$this,'footer_activation'),90);

		endif;
	}

	/**
	 * Add script activator to footer
	 * 
	 * Adds a small inline script to the bottom of the footer which targets our custom selector set in WP-admin
	 * 
	 * @author Sibin Grasic
	 * @since 1.0
	 */
	public function footer_activation()
	{
		$selector = $this->opts['selector'];

		echo 
		"
		<script type=\"text/javascript\">
		jQuery(document).ready(function(){
			jQuery('${selector}').fitVids();
		});
		</script>
		";
	}
}