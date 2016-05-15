<?php
/*
Plugin Name: Responsive Videos - FitVids
Description: Makes emebedded videos responsive
Version: 1.1.2
Author: Sibin Grasic
Author URI: http://sgi.io
*/

/**
 * 
 * @package SGI\SSR
 */

/* Prevent Direct access */
if ( !defined( 'DB_NAME' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/*Define plugin main file*/
if ( !defined('SGI_FITVIDS_FILE') )
	define ( 'SGI_FITVIDS_FILE', __FILE__ );

/* Define BaseName */
if ( !defined('SGI_FITVIDS_BASENAME') )
	define ('SGI_FITVIDS_BASENAME',plugin_basename(SGI_FITVIDS_FILE));

/* Define internal path */
if ( !defined( 'SGI_FITVIDS_PATH' ) )
	define( 'SGI_FITVIDS_PATH', plugin_dir_path( SGI_FITVIDS_FILE ) );

/* Define internal version for possible update changes */
define ('SGI_FITVIDS_VERSION', '1.1.2');

/* Load Up the text domain */
function sgi_ssr_load_textdomain()
{
	load_plugin_textdomain('sgissr', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action('wp_loaded','sgi_ssr_load_textdomain');

/* Check if we're running compatible software */
if ( version_compare( PHP_VERSION, '5.2', '<' ) && version_compare(WP_VERSION, '3.8', '<') ) :
	if (is_admin()) :
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		deactivate_plugins( __FILE__ );
		wp_die(__('Fitvids - Responsive Videos plugin requires WordPress 3.8 and PHP 5.3 or greater. The plugin has now disabled itself','sgidpw'));
	endif;
endif;

/* Let's load up our plugin */

function sgi_fitvids_backend_init()
{
	require_once (SGI_FITVIDS_PATH.'lib/fitvids-backend.php');
	new SGI_FitVids_Backend();
}

function sgi_fitvids_frontend_init()
{
	require_once (SGI_FITVIDS_PATH.'lib/fitvids-frontend.php');
	new SGI_FitVids_Frontend();
}


if (is_admin()) : 
	add_action('plugins_loaded','sgi_fitvids_backend_init');
else :
	add_action('init','sgi_fitvids_frontend_init',20);
endif;