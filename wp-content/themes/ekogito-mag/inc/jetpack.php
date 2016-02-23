<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Ekogito
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function ekogito_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'ekogito_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function ekogito_jetpack_setup
add_action( 'after_setup_theme', 'ekogito_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function ekogito_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function ekogito_infinite_scroll_render

/**
 * Add support for the Site Logo
 */
function ekogito_site_logo_init() {
	add_image_size( 'ekogito-logo', 200, 200 );
	add_theme_support( 'site-logo', array( 'size' => 'ekogito-logo' ) );
}
add_action( 'after_setup_theme', 'ekogito_site_logo_init' );

/**
 * Return early if Site Logo is not available.
 */
function ekogito_the_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	} else {
		jetpack_the_site_logo();
	}
}

/**
* Add theme support for Responsive Videos.
*/
add_theme_support( 'jetpack-responsive-videos' );

/**
 * Featured Posts
 */
function ekogito_has_multiple_featured_posts() {
	$featured_posts = apply_filters( 'ekogito_get_featured_posts', array() );
	if ( is_array( $featured_posts ) && 1 < count( $featured_posts ) ) {
		return true;
	}
	return false;
}
function ekogito_get_featured_posts() {
	return apply_filters( 'ekogito_get_featured_posts', false );
}
