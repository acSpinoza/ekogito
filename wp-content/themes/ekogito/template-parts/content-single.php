<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

?>


<?php
if(has_post_thumbnail()){ 
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large');
    $thumb_url = $thumb_url_array[0];
}
?>

<div class="uk-container uk-container-center">		
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="uk-article uk-panel uk-text-center">
	<header class="entry-header uk-animation-fade" >
		<div class="tm-grid-truncate uk-grid" data-uk-grid-margin="">
				<div class="uk-width-medium-7-10 uk-row-first uk-text-left">
			  	<h1><?php echo str_replace(' | ', '<br />', get_the_title()); ?></h1>
					
				</div>
				<div class="uk-width-medium-3-10">
					<div class="uk-cover-background " style="margin-top: 25px;max-height:120px;background-image: url(<?php echo $thumb_url; ?>);">
						<img class="uk-invisible" src="<?php echo $thumb_url; ?>" width="600" height="460" alt="">
					</div>
				</div>
		</div>
		<hr>

          
    
	</header><!-- .entry-header -->
		
	<div class="uk-grid">
    
	<div class="entry-content uk-animation-slide-bottom uk-width-medium-7-10 uk-row-first" style="margin: 0;padding: 0 30px 0 30px;">
			<div class="tm-grid-truncate uk-grid" data-uk-grid-margin="" style="padding-top: 10px;padding-bottom: 30px;">
				<div class="uk-width-medium-5-10 uk-row-first uk-text-left">
				<div class="sharedaddy sd-sharing-enabled">
                    <div class="robots-nocontent sd-block sd-social sd-social-icon sd-sharing">
                        <div class="sd-content">
                            <ul>
                               
                          
                                	<?php 
															if ( function_exists( 'sharing_display' ) ) {
																	sharing_display( '', true );
															}

															if ( class_exists( 'Jetpack_Likes' ) ) {
																	$custom_likes = new Jetpack_Likes;
																	echo $custom_likes->post_likes( '' );
															}
															?>														
                            </ul>
                        </div>
                    </div>
                </div>
				</div>
				<div class="uk-width-medium-5-10 uk-text-right uk-hidden-small">
																			<?php echo '<span class="dashicons dashicons-clock"></span> '.do_shortcode( '[est_time]' ).' de lecture'; ?>

				</div>
		</div>
          
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', '_s' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			) );
		?>
		
	</div><!-- .entry-content -->
		
<?php
get_sidebar();
?>
</div>

	<footer class="entry-footer">
    <div class="entry-meta">
	        
		</div><!-- .entry-meta -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
</div>