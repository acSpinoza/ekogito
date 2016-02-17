<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Ekogito
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="uk-cover-background uk-position-relative" style="background-image: url(https://images.unsplash.com/photo-1448518184296-a22facb4446f?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&s=1bd19ac4e5aa3f90ce7dbd3820ec8930);">
                                <img class="uk-invisible" src="https://images.unsplash.com/photo-1448518184296-a22facb4446f?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&s=1bd19ac4e5aa3f90ce7dbd3820ec8930" >
                                <div class="uk-position-cover uk-flex uk-flex-center uk-flex-middle">
                                    <div style="background: rgba(42, 142, 183, 0.8); font-size: 50px; line-height: 75px; color: #fff;">Bazinga!</div>
                                </div>
                            </div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ekogito' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'ekogito' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
