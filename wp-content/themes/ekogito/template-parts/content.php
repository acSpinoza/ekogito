<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

?>
<div class="uk-width-medium-1-2">
<article id="post-<?php the_ID(); ?>" class="uk-article uk-panel uk-panel-box">

	<header class="entry-header uk-text-center">

		<?php
		// Check if the post has a Post Thumbnail assigned to it.
			if ( has_post_thumbnail() ) {
			    the_post_thumbnail('large');
			}
			if ( is_single() ) {
				the_title( '<h2 class="entry-title uk-h2">', '</h2>' );
			} else {
				the_title( '<h2 class="entry-title uk-h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>

		<?php
		endif; ?>
	</header><!-- .entry-header -->

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

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ekogito' ),
				'after'  => '</div>',
			) );
			}
		?>
	</div><!-- .entry-content -->
	<p class="entry-meta uk-text-center">
		<?php //ekogito_posted_on(); ?>
		<?php ekogito_entry_footer(); ?>
	</p><!-- .entry-meta -->

</article><!-- #post-## -->
</div>
