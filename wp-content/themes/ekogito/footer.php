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
    <footer id="colophon" class="site-footer" role="contentinfo">
    <div id="tm-footer" class="site-info  tm-footer uk-block uk-block-secondary uk-contrast">
        <div class="uk-container uk-container-center">

            <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                <div class="uk-width-medium-1-1 uk-row-first">

                    <div class="uk-panel">

                        <ul class="uk-grid uk-grid-medium uk-flex uk-flex-center">
                            <li>
                                <a href="https://www.facebook.com/ekogito.co" target="_blank" class="uk-icon-hover uk-icon-small uk-icon-facebook"></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/ekogito" target="_blank" class="uk-icon-hover uk-icon-small uk-icon-twitter"></a>
                            </li>
                        </ul>
                        <ul class="uk-subnav uk-margin uk-flex uk-flex-center">
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Ekogito <?php echo date("Y"); ?></a>
                            </li>
                        </ul>

                    </div>

                </div>
            </section>

        </div>
    </div>
    </footer>

    <div id="offcanvas" class="uk-offcanvas">
        <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">

            <ul class="uk-nav uk-nav-offcanvas" data-uk-nav>

                <?php
    			wp_nav_menu( array(
    				'menu'              => 'primary',
    				'theme_location'    => 'primary',
    				'depth'             => 1,
    				'container'         => 'uk-nav uk-nav-offcanvas',
    				'menu_class'        => 'uk-nav uk-nav-offcanvas',
    				'fallback_cb'       => 'basey_primary_menu::fallback',
    				'walker'            => new basey_primary_menu())
    			);
    			?>	 

            </ul>

        </div>
    </div>

<?php 
/*  if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
}
 
if ( class_exists( 'Jetpack_Likes' ) ) {
    $custom_likes = new Jetpack_Likes;
    echo $custom_likes->post_likes( '' );
}*/
?>


<?php wp_footer(); ?>

</body>
</html>
