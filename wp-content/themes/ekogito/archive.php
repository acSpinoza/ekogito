<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area uk-container uk-container-center">
		<main id="main" class="site-main" role="main">
		<header class="entry-header uk-animation-slide-bottom">
	    <div class="uk-grid uk-flex-middle" data-uk-grid-margin="" data-uk-grid-match>
            <div class="uk-width-medium-10-10 uk-row-first">
                <div class="sharedaddy sd-sharing-enabled">
                    <div class="robots-nocontent sd-block sd-social sd-social-icon sd-sharing">
                        <div class="sd-content">
                            <ul>
                                <li>
                                    <h1><?php echo get_the_archive_title(); ?></h1>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
        		    ekogito_entry_footer();
                ?>
            </div>
        </div>
	</header><!-- .entry-header -->
		<hr>
        
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			echo '<div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-medium-1-4" data-uk-grid="{gutter: 30}">';
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
            echo '</div>';
            echo '<div class="uk-flex uk-flex-middle uk-text-center uk-container-center">';
			the_posts_navigation();
			echo '</div>';

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();