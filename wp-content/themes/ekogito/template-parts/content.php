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
	<div class="list uk-panel-box uk-grid uk-grid-collapse uk-text-left" data-uk-grid-margin="">

		<?php
		if ( has_post_thumbnail() ) { ?>
			<div class="uk-width-large-1-3 uk-width-medium-1-2 uk-row-first">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
		<?php } ?>

	  <div class="uk-width-large-2-3 uk-width-medium-1-2 ">
				<?php
					if ( is_single() ) {
						the_title( '<h2 class="entry-title uk-h2">', '</h2>' );
					} else {
						the_title( '<h2 class="entry-title uk-h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					}

			?>
			<p class="uk-article-meta"><?php ekogito_entry_footer(); ?></p>
			<hr class="uk-article-divider">
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
		</div>


</div>


	<footer class="entry-footer">
		<?php ekogito_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
