<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area content-area uk-container uk-container-center">
		<main id="main" class="site-main" role="main">
    
    		<?php
    		if ( have_posts() ) : ?>
    
    			<header class="page-header">
    				<?php
    					the_archive_title( '<h1 class="page-title uk-text-center">', '</h1><hr>' );
    					the_archive_description( '<div class="taxonomy-description uk-text-center">', '</div>' );
    				?>
    			</header><!-- .page-header -->
    			<?php
    			/* Start the Loop */
    		    echo '<div class="uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3" data-uk-grid="{gutter: 20}">';

    			while ( have_posts() ) : the_post();
    
    				/*
    				 * Include the Post-Format-specific template for the content.
    				 * If you want to override this in a child theme, then include a file
    				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
    				 */
    				get_template_part( 'template-parts/content', get_post_format() );
    
    			endwhile;
    			echo '</div>';
    
    			the_posts_navigation();
    
    		else :
    
    			get_template_part( 'template-parts/content', 'none' );
    
    		endif; ?>
    
            

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
