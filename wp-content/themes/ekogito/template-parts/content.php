<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ekogito_Theme
 */

if(has_post_thumbnail()){ 
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large');
    $thumb_url = $thumb_url_array[0];
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="frontpage-grid">
        <figure class="list-post-thumbnail uk-width-small-1-1 uk-width-medium-1-1 uk-overlay uk-overlay-hover">
<?php
            the_post_thumbnail();
            ?>            <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center">
                <div>
                <a href="<?php echo esc_url( get_permalink()); ?>"><i class="uk-icon-plus uk-icon-large"></i></a>
                <br>
                <br>
                <?php
                sharing_display( '', true );
                if ( class_exists( 'Jetpack_Likes' ) ) {
                    $custom_likes = new Jetpack_Likes;
                    echo $custom_likes->post_likes( '' );
                }
                ?>                
                </div>
            </figcaption>
        </figure>
        <div class="uk-panel uk-panel-box uk-width-small-1-1 uk-width-medium-1-1 uk-article uk-text-center no-sharing">

            <?php
          echo "<div class='uk-hidden-small entry-header'>";
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'ekogito' ) );
		if ( $categories_list && ekogito_categorized_blog()) {
			printf( '<span class="uk-text-muted uk-h6 category-links">' . esc_html__( ' %1$s ', 'ekogito' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}	
		echo "</div>";
    			if ( is_single() ) {
    				the_title( '<h2 class="title entry-title uk-h2">', '</h2>' );
    			} else {
    				the_title( '<h3 class="title entry-title uk-h3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
    			}
    echo "<div class='uk-hidden-small excerpt'>";
		the_excerpt();
		echo "</div>";
          //echo '<div class="action-ctn entry-header">';
          //echo '<span class="uk-text-muted uk-h5 category-links"> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">Lire l&#39;article</a> </span>';
          //echo '</div>';
    		?>
        </div>
    </div>
</div><!-- #post-## -->

