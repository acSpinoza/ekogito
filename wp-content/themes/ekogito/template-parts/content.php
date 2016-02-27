<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		if ( has_post_thumbnail() ) { 
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
	
		<?php } ?>
	<div class="uk-border uk-cover-background uk-grid-match" style="background-image: url(<?php echo $image[0] ?>);">

        <div class="uk-text-left " data-uk-grid-margin="">
            

            <div class="uk-panel-box uk-panel-box-white  uk-width-medium-8-10">
    			<?php
    				if ( is_single() ) {
    					the_title( '<h2 class="entry-title uk-h2">', '</h2>' );
    				} else {
    					the_title( '<h2 class="entry-title uk-h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    				}
    
    			?>
    			
    			
    			<hr class="small-hr">
    			<?php if(get_the_content() || has_excerpt()){ ?>
    			<p class="uk-article-meta"><?php ekogito_entry_footer(); ?></p>
    			<!-- <hr class="uk-article-divider"> -->
    			<p>
    				<?php
    					if (!is_single()) {
    						the_excerpt();
    					} else {
    					the_content( sprintf(
    						/* translators: %s: Name of current post. */
    						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ekogito' ), array( 'span' => array( 'class' => array() ) ) ),
    						the_title( '<span class="screen-reader-text">"', '"</span>', false )
    					) );
    
    					wp_link_pages( array(
    						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ekogito' ),
    						'after'  => '</div>',
    					) );
    					}
    				?>
    			</p>
    			<?php } ?>
    			<?php 
    			$categories_list = get_the_category_list( esc_html__( ', ', 'ekogito' ) );
        		if ( $categories_list && ekogito_categorized_blog()) {
        			printf( '<small>' . esc_html__( ' %1$s - ', 'ekogito' ) . '</small>', $categories_list ); // WPCS: XSS OK.
        		}
        		the_date( 'l, F j', '<small>', '</small>' ); 
        		?> 
    		</div>
    		<div class=" uk-width-medium-2-10">
                <div class="uk-panel image-placeholder">
                
                </div>
            </div>
        </div>
    </div>
	<footer class="entry-footer">
		<?php ekogito_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

