<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

?>
<div class="uk-panel">
<article id="post-<?php the_ID(); ?>" class="uk-article ">

	<header class="entry-header uk-text-center">

		<?php
		// Check if the post has a Post Thumbnail assigned to it.
if ( has_post_thumbnail() ) {
    the_post_thumbnail();
}
			if ( is_single() ) {
				the_title( '<h2 class="entry-title uk-h2">', '</h2>' );
			} else {
				the_title( '<h2 class="entry-title uk-h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<p class="entry-meta">
			<?php //ekogito_posted_on(); ?>
			<?php ekogito_entry_footer(); ?>
		</p><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content uk-text-center">
		<?php
			the_excerpt();
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
</div>
