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
	<header class="entry-header uk-animation-slide-bottom">
	    <div class="uk-grid uk-flex-middle" data-uk-grid-margin="" data-uk-grid-match>
            <div class="uk-width-medium-8-10 uk-row-first">
                <div class="sharedaddy sd-sharing-enabled">
                    <div class="robots-nocontent sd-block sd-social sd-social-icon sd-sharing">
                        <div class="sd-content">
                            <ul>
                                <li>
                                    <h1><?php echo get_the_title(); ?></h1>
                                </li>
                                <br class="uk-visible-medium">
                                <li class="share-facebook uk-hidden-small uk-animation-fade uk-animation-3"><a rel="nofollow" data-shared="" class="share-facebook sd-button share-icon no-text" href="http://ekogito.co" target="_blank" title="Click to share on Facebook"><span></span><span class="sharing-screen-reader-text">Click to share on Facebook (Opens in new window)<span class="share-count-dest share-count"></span></span></a>
                                </li>
                                <li class="share-twitter uk-hidden-small uk-animation-fade uk-animation-3"><a rel="nofollow" data-shared="" class="share-twitter sd-button share-icon no-text" href="http://ekogito.co" target="_blank" title="Click to share on Twitter"><span></span><span class="sharing-screen-reader-text">Click to share on Twitter (Opens in new window)<span class="share-count-dest share-count"></span</span></a>
                                </li>
                                <li class="share-end"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
        		    ekogito_entry_footer();
                ?>
            </div>
            <div class="uk-width-medium-2-10 uk-flex-middle">
                <div class="uk-cover-background uk-hidden-small" style="max-height:150px;background-image: url(<?php echo $thumb_url; ?>);">
                    <img class="uk-invisible" src="<?php echo $thumb_url; ?>" width="600" height="460" alt="">
                </div>
            </div>
        </div>
	</header><!-- .entry-header -->
    <hr>
	<div class="entry-content uk-animation-slide-bottom">
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

	<footer class="entry-footer">
    <div class="entry-meta">
	        
		</div><!-- .entry-meta -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
</div>