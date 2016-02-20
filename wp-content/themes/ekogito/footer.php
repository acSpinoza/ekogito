<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ekogito_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer uk-width-large-7-10 uk-container uk-container-center " role="contentinfo">
		<div class="site-info uk-text-center">
			<a href="<?php echo esc_url( __( 'https://ekogito.org', 'ekogito' ) ); ?>">Ekogito</a>
			<span class="sep"> | </span>
			2016
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
