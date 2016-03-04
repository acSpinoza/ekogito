<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

?>
<article id="post-<?php the_ID(); ?>" class="uk-article uk-panel uk-text-center">

    <?php
    if ( is_single() ) {
		the_title( '<h2 class="entry-title uk-h2">', '</h2>' );
	} else {
		the_title( '<h2 class="entry-title uk-h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}
	//echo "<hr>";
    ?>
	<?php
    if( has_post_thumbnail() && !is_single()) { 
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
        $thumb_url = $thumb_url_array[0];
	?>
    <div class="list-post-thumbnail uk-margin uk-text-contrast uk-text-center uk-flex uk-flex-center uk-flex-middle" data-uk-parallax="{bg: '-200'}" style="background-image: url(<?php echo $thumb_url; ?>);">
    	<header class="entry-header uk-text-center">

		<?php
		// Check if the post has a Post Thumbnail assigned to it.

			
			ekogito_entry_footer();


		if ( 'post' === get_post_type() ) : ?>

		<?php
		endif; ?>
	</header><!-- .entry-header -->
    </div>
    <?php } else { ?>
    	<header class="entry-header uk-text-center">

		<?php
		// Check if the post has a Post Thumbnail assigned to it.

			ekogito_entry_footer();

		if ( 'post' === get_post_type() ) : ?>

		<?php
		endif; ?>
	</header><!-- .entry-header -->
	<?php } ?>
	<div class="entry-content uk-text-center">
		<?php
			if (!is_single()) {
				the_excerpt();
			} else {
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ekogito' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )

			) );
			// if ( has_post_thumbnail() ) {
			//     the_post_thumbnail( 'medium' );
			// }

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ekogito' ),
				'after'  => '</div>',
			) );
			}
		?>
	</div><!-- .entry-content -->
	<p class="entry-meta uk-text-center">
		<?php //ekogito_posted_on(); ?>
		<?php //ekogito_entry_footer(); ?>
	</p><!-- .entry-meta -->

</article><!-- #post-## -->
