<?php
/**
 * Freemius class
 *
 * @since 3.2
 *
 * @package Page Builder Sandwich
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

/**
 * Initializes Freemius.
 */
function pbs_fs() {
	global $pbs_fs;

	if ( ! isset( $pbs_fs ) ) {

		$module = array(
			'id' => '203',
			'slug' => 'page-builder-sandwich',
			'type' => 'plugin',
			'public_key' => 'pk_24332b201c316345690967b25da99',
			'is_premium' => false,
			'has_addons' => false,
			'has_paid_plans' => true,
			'menu' => array(
				'slug' => 'page-builder-sandwich',
				'first-path' => 'admin.php?page=page-builder-sandwich',
				'support' => false,
			),


		);

		// Include Freemius SDK.
		require_once dirname( __FILE__ ) . '/freemius/start.php';

		if ( ! PBS_IS_ENVATO && ! PBS_IS_DEVELOPER ) {
			$pbs_fs = Freemius::instance( $module['slug'], true );
		} else if ( PBS_IS_ENVATO ) {
			require_once( 'class-freemius-envato.php' );
			$pbs_fs = FreemiusEnvato::instance( $module['slug'], true );
		} else if ( PBS_IS_DEVELOPER ) {
			require_once( 'class-freemius-developer.php' );
			$pbs_fs = FreemiusDeveloper::instance( $module['slug'], true );
		}

		$pbs_fs->dynamic_init( $module );
	}

	return $pbs_fs;
}

// Init Freemius.
pbs_fs();

// Uninstall logic.
require_once( 'function-uninstall.php' );
pbs_fs()->add_action( 'after_uninstall', 'pbs_uninstall' );


/**
 * Add our own icon in the opt-in screen.
 *
 * @since 3.2
 *
 * @param string $image_path The URL path to the avatar.
 *
 * @return string The modified URL path to the avatar.
 */
function pbs_freemius_icon( $image_path ) {
	return str_replace( WP_PLUGIN_URL, '', plugins_url( 'page_builder_sandwich/images/pbs-logo.png', __FILE__ ) );
}
pbs_fs()->add_filter( 'plugin_icon', 'pbs_freemius_icon' );


/**
 * Customize the Freemius connection message.
 *
 * @since 3.3
 *
 * @param string $message The current opt-in message.
 * @param string $user_first_name First name of the user.
 * @param string $plugin_title PBS name.
 * @param string $user_login The link to the user's login.
 * @param string $site_link Anchor html link to the current site.
 * @param string $freemius_link Anchor html link to Freemius.com.
 *
 * @return string The connection message.
 */
function pbs_fs_custom_connect_message( $message, $user_first_name, $plugin_title, $user_login, $site_link, $freemius_link ) {
	return sprintf(
		__fs( 'hey-x' ) . '<br>' .
		__( 'Never miss an important update - opt-in to our security and feature updates notifications, non-sensitive diagnostic tracking with %s, and statistical tracking with %s', PAGE_BUILDER_SANDWICH ),
		$user_first_name,
		$freemius_link,
		'<a href="https://pagebuildersandwich.com/" target="_blank">pagebuildersandwich.com</a>'
	);
}

pbs_fs()->add_filter( 'connect_message', 'pbs_fs_custom_connect_message', 10, 6 );
