<?php
/**
 * Learn more about premium modal.
 *
 * @package Page Builder Sandwich
 */

?>
<script type="text/html" id="tmpl-pbs-learn-premium-elements">
	<div class="pbs-learn-premium pbs-learn-premium-elements">
		<div class="pbs-tour-close"></div>
		<h2><?php printf( esc_html__( 'Hey, Yellow Tags Are %sPremium Features!%s', PAGE_BUILDER_SANDWICH ), '<br><strong>', '</strong>' ) ?></h2>
		<div><?php esc_html_e( 'Consider going premium to get access to more awesome premium elements, formatting tools and inspector properties.', PAGE_BUILDER_SANDWICH ) ?></div>
		<p class="pbs-learn-buy-button">
			<a href='<?php echo esc_url( admin_url( '/admin.php?page=page-builder-sandwich-pricing' ) ) ?>' target="_buy"><?php esc_html_e( 'Buy now, starts at $39', PAGE_BUILDER_SANDWICH ) ?></a>
			<a href='http://demo.pagebuildersandwich.com/?pbs_iframe=1' class="pbs-trial-button" target="_buy"><?php esc_html_e( 'Try premium version demo', PAGE_BUILDER_SANDWICH ) ?></a>
		</p>
		<p class="pbs-learn-small">
			* <?php esc_html_e( 'You can hide these flags in the settings.', PAGE_BUILDER_SANDWICH ) ?>
		</p>
	</div>
</script>
