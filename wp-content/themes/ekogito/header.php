<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ekogito_Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site uk-width-large-7-10 uk-container uk-container-center ">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ekogito' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<nav class="uk-navbar">
			<a class="uk-text-middle uk-hidden-small" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><i class="uk-icon-justify uk-icon-dot-circle-o uk-icon-large uk-text-danger "></i> <?php bloginfo( 'name' ); ?> </a>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'uk-navbar-nav' , 'container_class' => 'uk-navbar-nav uk-hidden-small uk-navbar-flip' ) ); ?>
      <a href="#offcanvas-1" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
    </nav>
		<div id="offcanvas-1" class="uk-offcanvas">
		    <div class="uk-offcanvas-bar">
					<a class="uk-text-middle uk-nav uk-nav-offcanvas" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><i class="uk-icon-justify uk-icon-dot-circle-o uk-icon-large uk-text-danger"></i> <?php bloginfo( 'name' ); ?> </a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'uk-nav uk-nav-offcanvas' ) ); ?>
		    </div>
		</div>


	</header><!-- #masthead -->

	<div id="content" class="site-content">
