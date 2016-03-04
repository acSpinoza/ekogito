<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ekogito_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found uk-text-center">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( "Nondidju, n'y a rin du tout icite!", 'ekogito' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">

					<?php
						get_search_form();
					?>
                    <div class="uk-margin-top">
                    <?php
						the_widget( 'WP_Widget_Tag_Cloud' );
					?>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
