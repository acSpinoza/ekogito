<?php
/**
 * Meta box in the post/page editor in the backend.
 *
 * @package Page Builder Sandwich
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'PBSMetaBox' ) ) {

	/**
	 * This is where all the meta box functionality happens.
	 */
	class PBSMetaBox {

		/**
		 * Hook into the backend.
		 */
		function __construct() {
			if ( ! is_admin() ) {
				return;
			}

			add_filter( 'pbs_localize_admin_scripts', array( $this, 'localize_admin_scripts' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_side_meta_box' ), 0 );
			add_filter( 'redirect_post_location', array( $this, 'redirect_after_save' ) );
		}


		/**
		 * Add the JS params we need for the meta box to work.
		 *
		 * @since 2.9
		 *
		 * @param array $params Localization parameters.
		 *
		 * @return array The modified parameters.
		 */
		public function localize_admin_scripts( $params ) {

			$screen = get_current_screen();
			if ( 'post' !== $screen->base ) {
				return $params;
			}

			$params['is_editing'] = true;
			$params['meta_is_page'] = 'page' === $screen->id;
			$params['meta_not_saved'] = get_post_status() === 'auto-draft';
			$params['meta_permalink'] = apply_filters( 'pbs_meta_box_permalink', get_permalink() );

			global $post;
			if ( $post ) {
				$params['post_id'] = $post->ID;
			}
			return $params;
		}


		/**
		 * Adds the sidebar meta box in pages and posts.
		 *
		 * @since 2.9
		 */
		public function add_side_meta_box() {
			add_meta_box( 'pbs-meta-box', 'Page Builder Sandwich', array( $this, 'meta_box_content_saved' ), 'post', 'side', 'high' );
			add_meta_box( 'pbs-meta-box', 'Page Builder Sandwich', array( $this, 'meta_box_content_saved' ), 'page', 'side', 'high' );
		}


		/**
		 * The meta box contents for saved posts.
		 *
		 * @since 2.9
		 */
		public function meta_box_content_saved() {
			$post_type = get_post_type_object( get_post_type() );
			?>
			<p>
				<em>
					<?php
					printf(
						esc_html__( 'Visit this %s in your front-end to begin editing.', PAGE_BUILDER_SANDWICH ),
						esc_html__( strtolower( $post_type->labels->singular_name ) )
					);
					?>
				</em>
			</p>
			<input value='<?php echo esc_attr( __( 'Edit with Page Builder Sandwich', PAGE_BUILDER_SANDWICH ) ) ?>' type='button' id='pbs-admin-edit-with-pbs' class='button button-large'/>
			<?php
		}


		/**
		 * Redirect URL after saving a post. Triggered by the backend edit button.
		 *
		 * @since 3.4
		 *
		 * @param string $location The URL to direct to.
		 *
		 * @return string The modified URL to redirect to.
		 */
		public function redirect_after_save( $location ) {
			if ( isset( $_POST['pbs-save-redirect'] ) ) { // Input var okay. WPCS: CSRF ok.
				$location = wp_unslash( $_POST['pbs-save-redirect'] ); // Input var okay. WPCS: CSRF ok. sanitization ok.

				$location = apply_filters( 'pbs_redirect_after_save', $location );
			}

			return $location;
		}
	}
}

new PBSMetaBox();
