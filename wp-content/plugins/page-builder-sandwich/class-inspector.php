<?php
/**
 * Inspector class. The inspector performs some ajax calls, those are
 * handled in this class.
 *
 * @package Page Builder Sandwich
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'PBSInspector' ) ) {

	/**
	 * This is where all the inspector ajax functionality happens.
	 */
	class PBSInspector {


		/**
		 * Hook into WordPress.
		 */
		function __construct() {
			add_action( 'wp_ajax_pbs_inspector_dropdown_post', array( $this, 'dropdown_post' ) );
		}


		/**
		 * Handle dropdown post values.
		 *
		 * @since 2.18
		 *
		 * @return void
		 */
		public function dropdown_post() {
			if ( empty( $_POST['nonce'] ) ) { // Input var: okay.
				die();
			}
			$nonce = sanitize_key( $_POST['nonce'] ); // Input var: okay.
			if ( ! wp_verify_nonce( $nonce, 'pbs_shortcode' ) ) {
				die();
			}
			if ( empty( $_POST['post_type'] ) ) { // Input var: okay.
				die();
			}
			$post_type = trim( sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) ); // Input var: okay.

			$args = array(
				'post_type' => $post_type,
				// @codingStandardsIgnoreLine
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'orderby' => 'title',
				'order' => 'asc',
				'suppress_filters' => false,
			);

			// @codingStandardsIgnoreLine
			$posts = get_posts( $args );

			$ret = array(
				'' => '— ' . esc_html__( 'Select one', PAGE_BUILDER_SANDWICH ) . ' —',
			);
			foreach ( $posts as $post ) {
				$title = $post->post_title;
				if ( empty( $title ) ) {
					$title = sprintf( __( 'Untitled %s', TF_I18NDOMAIN ), '(ID #' . $post->ID . ')' );
				}

				$ret[ $post->ID ] = $title;
			}

			if ( 1 === count( $ret ) ) {
				$ret[''] = '— ' . sprintf( esc_html__( 'Create a %s first', PAGE_BUILDER_SANDWICH ), ucwords( preg_replace( '/[_-]/', ' ', $post_type ) ) ) . ' —';
			}

			echo wp_json_encode( $ret );
			die();
		}
	}
}

new PBSInspector();
