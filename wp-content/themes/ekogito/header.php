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
<meta name="google-site-verification" content="9zcZW3HSSMZ_zmyzu7sPk0QouoNNqdSIjM-8wfWDjSk" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74185149-1', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site ">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ekogito' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<nav class="uk-navbar" data-uk-sticky >
			<div class="uk-width-large-7-10 uk-container uk-container-center ">
				<div class="uk-navbar-nav uk-text-middle ">
				<ul class="uk-navbar-nav">
					<li class="menu-item ">
						<a class="no-padding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><i class="uk-icon-justify uk-icon-dot-circle-o uk-icon-large uk-text-danger "></i> <?php bloginfo( 'name' ); ?></a>
					</li>
				</ul>
			</div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'uk-navbar-nav' , 'container_class' => 'uk-navbar-nav uk-hidden-small uk-navbar-flip' ) ); ?>
	      <a href="#offcanvas-1" class="uk-navbar-toggle uk-visible-small uk-navbar-flip" data-uk-offcanvas=""></a>
			</div>
		</nav>
		<div id="offcanvas-1" class="uk-offcanvas">
		    <div class="uk-offcanvas-bar">
					<ul class="uk-nav uk-nav-offcanvas">
						<li class="menu-item">
							<a class="uk-text-middle uk-nav uk-nav-offcanvas" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><i class="uk-icon-justify uk-icon-dot-circle-o uk-icon-large uk-text-danger"></i> <?php bloginfo( 'name' ); ?> </a>
						</li>
					</ul>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'uk-nav uk-nav-offcanvas' ) ); ?>
		    </div>
		</div>


	</header><!-- #masthead -->

	<div id="content" class="site-content uk-width-large-7-10 uk-container uk-container-center ">
