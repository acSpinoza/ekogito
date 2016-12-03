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
		'footer' => esc_html__( 'Footer', 'ekogito' ),
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
function ekogito_footer_scripts() {
    
 wp_enqueue_script( 'jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js#asyncload' );

 wp_enqueue_script( 'uikit-script', get_template_directory_uri() . '/vendor/uikit/js/uikit.js#asyncload' );
 wp_enqueue_script( 'uikit-script-grid', get_template_directory_uri() . '/vendor/uikit/js/components/grid.min.js#asyncload' );
 wp_enqueue_script( 'uikit-script-slider', get_template_directory_uri() . '/vendor/uikit/js/components/slider.js#asyncload' );
 wp_enqueue_script( 'uikit-script-slideshow', get_template_directory_uri() . '/vendor/uikit/js/components/slideshow.js#asyncload' );
 wp_enqueue_script( 'uikit-script-slideshow-fx', get_template_directory_uri() . '/vendor/uikit/js/components/slideshow-fx.js#asyncload' );
 wp_enqueue_script( 'uikit-script-sticky', get_template_directory_uri() . '/vendor/uikit/js/components/sticky.min.js#asyncload' );
 wp_enqueue_script( 'uikit-script-parallax', get_template_directory_uri() . '/vendor/uikit/js/components/parallax.min.js#asyncload' );
 wp_enqueue_script( 'uikit-script-lightbox', get_template_directory_uri() . '/vendor/uikit/js/components/lightbox.min.js#asyncload' );
	
	wp_enqueue_script( 'isotope-script', '//npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js' );
	

 wp_enqueue_script( 'ekogito-script', get_template_directory_uri() . '/dist/script.min.js#asyncload');

}
add_action( 'wp_footer', 'ekogito_footer_scripts' );

function ekogito_scripts() {
    
 wp_enqueue_style( 'uikit-style', get_template_directory_uri() . '/vendor/uikit/css/uikit.css#asyncload' );
 wp_enqueue_style( 'uikit-style-slider', get_template_directory_uri() . '/vendor/uikit/css/components/slider.css#asyncload' );
 wp_enqueue_style( 'uikit-style-slideshow', get_template_directory_uri() . '/vendor/uikit/css/components/slideshow.css#asyncload' );
 wp_enqueue_style( 'uikit-style-slidenav', get_template_directory_uri() . '/vendor/uikit/css/components/slidenav.css#asyncload' );
 wp_enqueue_style( 'uikit-style-sticky', get_template_directory_uri() . '/vendor/uikit/css/components/sticky.min.css#asyncload' );
	
	//wp_enqueue_style( 'isotope-style', get_template_directory_uri() . '/vendor/uikit/css/components/sticky.min.css#asyncload' );

 wp_enqueue_style( 'ekogito-style', get_template_directory_uri() . '/dist/style.min.css#asyncload' ); 
}
add_action( 'wp_enqueue_scripts', 'ekogito_scripts' );


function ekogito_footer_scripts_sharing() {
    if(is_singular() && !is_front_page()){
    wp_enqueue_script( 'ekogito-script-sharing', get_template_directory_uri() . '/js/sharing.js');
    }
    if(!is_front_page()){
    wp_enqueue_script( 'ekogito-script-nav', get_template_directory_uri() . '/js/nav.js'); 
    }
    
}
add_action( 'wp_footer', 'ekogito_footer_scripts_sharing' );



/*
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/*
 * Custom Walker for UiKit.
 */
require get_template_directory() . '/inc/menus.php';

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

/**
 * Load More functions file.
 */
//require get_template_directory() . '/inc/load-more.php';



/*function mytheme_infinite_scroll_init() {
add_theme_support( 'infinite-scroll', array(
    'posts_per_page' => 2,
) );
}
add_action( 'init', 'mytheme_infinite_scroll_init' );*/

/*
 * Change the posts_per_page Infinite Scroll setting from 10 to 20
 */
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = ' uk-active ';
    }
    return $classes;
}


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

function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
//add_filter('the_content', 'filter_ptags_on_images');

//remove_filter( 'the_content', 'wpautop' );

//add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;


function _remove_script_version( $src ){
	if(!strpos($src, 'fonts.googleapis.com')){
		$parts = explode( '?', $src );
	return $parts[0];
	}	
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

add_filter( 'jetpack_photon_reject_https', '__return_false' );

// Async load
function ikreativ_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async"; 
    }
add_filter( 'clean_url', 'ikreativ_async_scripts', 11, 1 );


function recent_content(){


		$my_query = new WP_Query(array( 'posts_per_page' => 6 ) );


if ( $my_query->have_posts() ) :
	
		ob_start();
			/* Start the Loop */
		echo '<ul class="recent_posts_categories uk-visible-large" >';
		wp_list_categories(array(
        'orderby'    => 'name',
        'show_count' => false,
      	'title_li' 	 => '',
				'depth'      => 1,
				'hide_empty' => true,
				'exclude'		 => array( 79, 92, 97 ),
			
    ) );
		echo '</ul>';
			echo '<div class="grid-frontpage uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-medium-1-3 uk-grid-match" data-uk-grid="{gutter: 20}">';
		while ($my_query->have_posts()) : $my_query->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
            echo '</div>';
            echo '<div class="uk-flex uk-flex-middle uk-text-center uk-container-center">';
			the_posts_navigation();
			echo '</div>';

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
	
	return ob_get_clean();
	
}

add_shortcode('recent_content', 'recent_content');

function projects_list(){


// WP_Query arguments
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => 9, //get_the_ID(),
    'order'          => 'ASC',
    'orderby'        => 'menu_order',
		'post_status' 	 => array( 'publish' ),
 );

// The Query
$projects_posts = new WP_Query( $args );


if ( $projects_posts->have_posts() ) :
	
		ob_start();
			/* Start the Loop */
			echo '<div class="grid-frontpage uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-medium-1-2" data-uk-grid="{gutter: 20}">';
		while ($projects_posts->have_posts()) : $projects_posts->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
            echo '</div>';
            echo '<div class="uk-flex uk-flex-middle uk-text-center uk-container-center">';
			the_posts_navigation();
			echo '</div>';

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
	
	return ob_get_clean();
	
}

add_shortcode('projects_list', 'projects_list');


function children_posts(){


// WP_Query arguments
$children_args = array(
    'post_type'      => 'page',
    'posts_per_page' => 3,
    'post_parent'    => 560,
    'order'          => 'ASC',
    'orderby'        => 'menu_order',
		'post_status' 	 => array( 'publish' ),
 );

// The Query
$children = new WP_Query( $children_args );


if ( $children->have_posts() ) :
	
		ob_start();
			/* Start the Loop */
			echo '<div class="grid-frontpage uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-medium-1-2" data-uk-grid="{gutter: 20}">';
		while ($children->have_posts()) : $children->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
            echo '</div>';
            echo '<div class="uk-flex uk-flex-middle uk-text-center uk-container-center">';
			the_posts_navigation();
			echo '</div>';

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
	
	return ob_get_clean();
	
}

add_shortcode('children-posts', 'children_posts');


function get_post_id($atts, $content = null ){
	
	
	$a = shortcode_atts( array(
        'id' => ''
    ), $atts );
	
		$args = array(
'p' => $a['id'], // id of a page, post, or custom type
'post_type' => 'any');
$my_posts = new WP_Query($args);


if ( $my_posts->have_posts() ) :
	
		ob_start();
			/* Start the Loop */
			echo '<div class="grid-frontpage uk-grid-width-small-1-1 uk-grid-width-medium-1-1 uk-grid-width-medium-1-1" data-uk-grid>';
		while ($my_posts->have_posts()) : $my_posts->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
            echo '</div>';
            echo '<div class="uk-flex uk-flex-middle uk-text-center uk-container-center">';
			the_posts_navigation();
			echo '</div>';

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
	
	return ob_get_clean();
	
}

add_shortcode('get_post_id', 'get_post_id');


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

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return ' ... ';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}





function inspirations_mtl(){
	
ob_start();
	?>

 <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
Carte

<div id="map"></div>
    <script>
initMap();
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 11,
    center: {lat: 41.876, lng: -87.624}
  });

  var ctaLayer = new google.maps.KmlLayer({
    url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
    map: map
  });
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js">
    </script>
<?php
	return ob_get_clean();
	
}

add_shortcode('inspirations_mtl', 'inspirations_mtl');



function ekogito_carte(){
	
ob_start();
	?>
	Carte

	<script>
console.log('carte');
function initMap() {
  var myLatLng = {lat: -25.363, lng: 131.044};



  // Create a marker and set its position.
  var marker = new google.maps.Marker({
    map: map,
    position: myLatLng,
    title: 'Hello World!'
  });
}
    </script>
	<?php
	return ob_get_clean();
	
}

add_shortcode('ekogito_carte', 'ekogito_carte');

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');


function post_author(){
	
	ob_start();
	
	?>
<header class="uk-comment-header uk-grid">
		<div class=" uk-width-2-6 uk-row-first">
			<img class="uk-comment-avatar" src="<?php echo get_avatar_url( get_the_author_meta( 'email' ) )?>" width="100" height="100" alt="" style="padding-top: 10px">
		</div>
		<div class="uk-width-4-6">
			<h4 class="uk-comment-title">Ecrit par <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>"><?php echo get_the_author(); ?></a></h4>
			<div class="uk-comment-meta"><?php the_author_meta('description'); ?></br><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>">Lire les autres articles</a></div>
		</div>
</header>

	<?php

	return ob_get_clean();
	
}

add_shortcode('post_author', 'post_author');
