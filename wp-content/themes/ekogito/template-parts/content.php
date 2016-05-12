<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

if(has_post_thumbnail()){ 
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large');
    $thumb_url = $thumb_url_array[0];
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="frontpage-grid">
        <figure class="list-post-thumbnail uk-width-small-1-1 uk-width-medium-1-1 uk-overlay uk-overlay-hover">
<?php
            the_post_thumbnail();
            ?>            <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center">
                <div>
                <a href="<?php echo esc_url( get_permalink()); ?>"><i class="uk-icon-plus uk-icon-large"></i></a>
                <br>
                <br>
                <?php
                sharing_display( '', true );
                if ( class_exists( 'Jetpack_Likes' ) ) {
                    $custom_likes = new Jetpack_Likes;
                    echo $custom_likes->post_likes( '' );
                }
                ?>                
                </div>
            </figcaption>
        </figure>
        <div class="uk-panel uk-panel-box uk-width-small-1-1 uk-width-medium-1-1 uk-article uk-text-center no-sharing">

            <?php
    			if ( is_single() ) {
    				the_title( '<h2 class="title entry-title uk-h2">', '</h2>' );
    			} else {
    				the_title( '<h2 class="title entry-title uk-h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    			}
    		?>
    		<hr class="center-hr">
            <p class="uk-article-meta">
            <?php 
    		$categories_list = get_the_category_list( esc_html__( ', ', 'ekogito' ) );
    		if ( $categories_list && ekogito_categorized_blog()) {
    			printf( '<h6>' . esc_html__( ' %1$s - ', 'ekogito' ) . '', $categories_list ); // WPCS: XSS OK.
    		}
    		the_modified_date( 'l, F j', '', '</h6>' ); 
    		?>
            </p>
            
            <p class="uk-article-lead">
            <?php
            if(has_excerpt()) {
    		    the_excerpt();   
    		} 
    		echo do_shortcode( '[jpshare]' );
    		?>
    		
            </p>
        </div>
    </div>
</div><!-- #post-## -->

