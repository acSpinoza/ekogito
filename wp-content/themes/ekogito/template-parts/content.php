<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */
?>
<div class="grid-item">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="frontpage-grid">
        <figure class="list-post-thumbnail uk-width-small-1-1 uk-width-medium-1-1 uk-overlay uk-overlay-hover">
            <?php
            if( has_post_thumbnail() ) { 
            the_post_thumbnail();
            ?>
            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-text-middle">
                <div class="uk-overlay-panel uk-overlay-icon"></div>
            </div>
            <a class="uk-position-cover" href="<?php echo(get_permalink())  ?>"></a>
        </figure>
        <?php } ?>
        <div class="uk-panel uk-panel-box uk-width-small-1-1 uk-width-medium-1-1 uk-article uk-text-center">

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
</div>

