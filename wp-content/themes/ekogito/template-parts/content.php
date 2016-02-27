<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

if ( has_post_thumbnail() ) { 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
} 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div data-uk-grid>
        <div class="uk-width-small-1-1 uk-width-medium-1-1">
            <div class="uk-cover-background" style="min-height: 200px; background-image: url(<?php echo $image[0] ?>);"></div>
        </div>
        <div class="uk-panel uk-panel-box uk-width-small-1-1 uk-width-medium-1-1 uk-article uk-text-left">

            <?php
    			if ( is_single() ) {
    				the_title( '<h2 class="title entry-title uk-h2">', '</h2>' );
    			} else {
    				the_title( '<h2 class="title entry-title uk-h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    			}
    		?>
            <p class="uk-article-meta">
            <?php 
    		$categories_list = get_the_category_list( esc_html__( ', ', 'ekogito' ) );
    		if ( $categories_list && ekogito_categorized_blog()) {
    			printf( '<h6>' . esc_html__( ' %1$s - ', 'ekogito' ) . '', $categories_list ); // WPCS: XSS OK.
    		}
    		the_date( 'l, F j', '', '</h6>' ); 
    		?>
            </p>
            <hr class="small-hr">
            <p class="uk-article-lead">
            <?php
            if(has_excerpt()) {
    		    the_excerpt();   
    		} ?>
            </p>
            

        </div>
    </div>
	<footer class="entry-footer">
		<?php ekogito_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

