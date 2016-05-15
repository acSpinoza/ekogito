<?php
/**
 * Html Element class.
 *
 * @package Page Builder Sandwich
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'PBSElementHtml' ) ) {

	/**
	 * This is where all the html element functionality happens.
	 */
	class PBSElementHtml {

		/**
		 * Hook into WordPress.
		 */
		function __construct() {
			add_action( 'wp_footer', array( $this, 'add_html_frame_template' ) );
		}


		/**
		 * Add the widget picker frame.
		 *
		 * @since 2.12
		 */
		public function add_html_frame_template() {
			if ( ! PageBuilderSandwich::is_editable_by_user() ) {
				return;
			}

			include 'page_builder_sandwich/templates/frame-html-editor.php';
		}
	}
}

new PBSElementHtml();
