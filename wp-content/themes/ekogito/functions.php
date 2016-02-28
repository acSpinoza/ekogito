<?php
/**
 * Ekogito Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ekogito_Theme
 */

if ( ! function_exists( 'ekogito_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ekogito_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Ekogito Theme, use a find and replace
	 * to change 'ekogito' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ekogito', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'ekogito' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ekogito_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'ekogito_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ekogito_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ekogito_content_width', 640 );
}
add_action( 'after_setup_theme', 'ekogito_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ekogito_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ekogito' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ekogito_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ekogito_scripts() {

	wp_enqueue_style( 'uikit-style', get_template_directory_uri() . '/vendor/uikit/uikit.min.css' );

	wp_enqueue_style( 'ekogito-style', get_stylesheet_uri() );



}
add_action( 'wp_enqueue_scripts', 'ekogito_scripts' );


function ekogito_footer_scripts() {

 wp_enqueue_script( 'jquery', get_template_directory_uri() . '/vendor/jquery/jquery-1.12.0.min.js' );
 wp_enqueue_script( 'uikit-script', get_template_directory_uri() . '/vendor/uikit/uikit.min.js' );
 wp_enqueue_script( 'uikit-script-sticky', get_template_directory_uri() . '/vendor/uikit/sticky.js' );
 wp_enqueue_script( 'uikit-script-grid', get_template_directory_uri() . '/vendor/uikit/grid.js' );
 
 wp_enqueue_script( 'ekogito-custom', get_template_directory_uri() . '/js/custom.js', array(), '20160228', true );
 
 wp_enqueue_script( 'ekogito-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

 wp_enqueue_script( 'ekogito-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

}
add_action( 'wp_footer', 'ekogito_footer_scripts' );


/*
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
 * Change the posts_per_page Infinite Scroll setting from 10 to 20
 */
function my_theme_infinite_scroll_settings( $args ) {
    if ( is_array( $args ) )
        $args['posts_per_page'] = 2;
    return $args;
}
add_filter( 'infinite_scroll_settings', 'my_theme_infinite_scroll_settings' );



add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'uk-active ';
    }
    return $classes;
}

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});

