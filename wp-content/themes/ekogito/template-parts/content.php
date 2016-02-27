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
    <div class="frontpage-grid" data-uk-grid>
        <?php 
        if (has_post_video()) {
            $video_url = get_the_post_video_url();
            $video_id = str_replace("http://youtu.be/","",$video_url);
            print_r($video_id);
            $video_embed = "http://www.youtube.com/embed/".$video_id."?vq=hd720&autoplay=0&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;enablejsapi=1&amp;api=1";
        ?>
        <div class=" uk-width-small-1-1 uk-width-medium-1-1">
            <div class="uk-cover" style="height: 200px;">
                <iframe data-uk-cover="" src="<?php echo $video_embed; ?>" height="315" frameborder="0" allowfullscreen="" "></iframe>            </div>
            </div>
        </div>
        <?php
        }
        elseif ( has_post_thumbnail() ) { 
        $thumb_id = get_post_thumbnail_id(get_the_ID());
        $small_screen = wp_get_attachment_image_src($thumb_id,'large-screen', true);
        $image_url = $small_screen[0];
        ?>
        <figure class="uk-width-small-1-1 uk-width-medium-1-1 uk-overlay uk-overlay-hover" style="height:170px">
            <img class="uk-overlay-scale" src="<?php echo($image_url) ?>" alt="Image">
            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-text-middle">
                <div class="uk-overlay-panel uk-overlay-icon"></div>
            </div>
            <a class="uk-position-cover" href="<?php echo(get_permalink())  ?>"></a>
        </figure>
        <?php } ?>
        <div class="uk-panel uk-panel-box uk-width-small-1-1 uk-width-medium-1-1 uk-article uk-text-left">

            <?php
    			if ( is_single() ) {
    				the_title( '<h2 class="title entry-title uk-h2">', '</h2>' );
    			} else {
    				the_title( '<h2 class="title entry-title uk-h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    			}
    		?>
    		<hr class="small-hr">
            <p class="uk-article-meta">
            <?php 
    		$categories_list = get_the_category_list( esc_html__( ', ', 'ekogito' ) );
    		if ( $categories_list && ekogito_categorized_blog()) {
    			printf( '<h6>' . esc_html__( ' %1$s - ', 'ekogito' ) . '', $categories_list ); // WPCS: XSS OK.
    		}
    		the_modified_date( 'l, F j', '', '</h6>' ); 
    		?>
            </p>
            
            <p class="uk-article-lead">
            <?php
            if(has_excerpt()) {
    		    the_excerpt();   
    		} 
    		echo do_shortcode( '[jpshare]' );
    		?>
    		
            </p>
        </div>
    </div>
</article><!-- #post-## -->

