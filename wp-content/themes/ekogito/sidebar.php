<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ekogito_Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<style>
	.widget{    padding: 20px 0 20px 0;
    border-bottom: 1px solid #ccc;
		margin: 0;
}
	.widget_recent_entries ul{
		margin: 0
	}
	.widget-title{
		    font-size: 18px;
	}
	.widget .mc4wp-alert p {
    color: #333;
    padding-top: 10px;
}
	.widget .newsletter-form .submit {
    padding-left: 10px;
    text-shadow: none!important;
    color: #333!important;
		border-color: #ccc!important;}
	.widget .uk-form input[type="email"] {    
		border: 1px solid #dddddd !important;
    background: #ffffff !important;
    color: #444444;}
	.sharedaddy{
		float:left;
		padding-left: 5px;
    margin-top: -8px;
	}
	</style>

<aside id="secondary" class="widget-area  uk-width-medium-3-10 entry-header" role="complementary" style="border-left: 1px solid #ccc;margin-top: 0px; ">
								<section class="widget" style=" padding-top: 0;">
									<?php echo do_shortcode('[post_author]'); ?>
	</section>
					   
								<section class="widget">
                <?php
        		    ekogito_entry_footer();
                ?>
	</section>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
