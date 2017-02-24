<?php
/**
 * Ask rating after a long time of usage.
 *
 * Ask when:
 * - After 5 hours of editing time.
 * - After editing 5 pages/posts.
 *
 * @package Page Builder Sandwich
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'PBSAskRating' ) ) {

	/**
	 * This is where all the tracking functionality happens.
	 */
	class PBSAskRating {

		/**
		 * Hook into WordPress.
		 */
		function __construct() {

			$asked_editing_time = get_option( 'pbs_asked_rate_editing_time' );
			$asked_edited_posts = get_option( 'pbs_asked_rate_edited_posts' );
			$has_rated = get_option( 'pbs_has_rated' );

			if ( $has_rated ) {
				return;
			}
			if ( $asked_editing_time && $asked_edited_posts ) {
				return;
			}

			// Display the rating notice.
			add_action( 'admin_notices', array( $this, 'ask_for_rating' ) );

			// Checks whether we need to ask for a rating.
			add_filter( 'heartbeat_received', array( $this, 'check_if_need_to_ask_for_rating' ), 10, 2 );

			// Handler for when the user clicked on "no thanks".
			add_action( 'wp_ajax_pbs_rating_no', array( $this, 'no_thanks' ) );

			// Handler for when the user clicked on "rate".
			add_action( 'wp_ajax_pbs_rating_yes', array( $this, 'rated' ) );
		}


		/**
		 * Triggered during normal heartbeat nonce checking, track the amount of
		 * time editing.
		 *
		 * @since 3.2
		 *
		 * @param array $response The heartbeat response.
		 * @param array $data The heartbeat data sent to the server.
		 *
		 * @return array The heartbeat response
		 */
		public function check_if_need_to_ask_for_rating( $response, $data ) {

			if ( ! empty( $data['tracking_interval'] ) && ! empty( $data['post_id'] ) ) {

				$asked_editing_time = get_option( 'pbs_asked_rate_editing_time' );
				$asked_edited_posts = get_option( 'pbs_asked_rate_edited_posts' );
				$has_rated = get_option( 'pbs_has_rated' );

				if ( $has_rated ) {
					return $response;
				}
				if ( $asked_editing_time && $asked_edited_posts ) {
					return $response;
				}

				// Update the number of seconds PBS has been used.
				if ( ! $asked_editing_time ) {
					$seconds = (int) get_option( 'pbs_ask_total_editing_time' ) + (int) $data['tracking_interval'];
					update_option( 'pbs_ask_total_editing_time', $seconds );
				}

				// Update the number of posts that we have edited.
				if ( ! $asked_edited_posts ) {
					$posts_edited = get_option( 'pbs_ask_posts_edited' );
					if ( ! $posts_edited ) {
						$posts_edited = array();
					}
					if ( ! in_array( $data['post_id'], $posts_edited, true ) ) {
						$posts_edited[] = $data['post_id'];
						update_option( 'pbs_ask_posts_edited', $posts_edited );
					}
				}
			}
			return $response;
		}


		/**
		 * Rated click ajax handler.
		 *
		 * @since 2.8.2
		 */
		public function rated() {
			if ( empty( $_POST['nonce'] ) || empty( $_POST['type'] ) ) { // Input var: okay.
				die();
			}
			$nonce = sanitize_key( $_POST['nonce'] ); // Input var: okay.
			if ( ! wp_verify_nonce( $nonce, 'pbs' ) ) {
				die();
			}

			$type = sanitize_text_field( wp_unslash( $_POST['type'] ) ); // Input var: okay.
			if ( 'edit_time' === $type ) {
				update_option( 'pbs_asked_rate_editing_time', '1' );
			} else {
				update_option( 'pbs_asked_rate_edited_posts', '1' );
			}

			update_option( 'pbs_has_rated', true );

			die();
		}


		/**
		 * No thanks was clicked.
		 *
		 * @since 4.0.1
		 */
		public function no_thanks() {
			if ( empty( $_POST['nonce'] ) || empty( $_POST['type'] ) ) { // Input var: okay.
				die();
			}
			$nonce = sanitize_key( $_POST['nonce'] ); // Input var: okay.
			if ( ! wp_verify_nonce( $nonce, 'pbs' ) ) {
				die();
			}

			$type = sanitize_text_field( wp_unslash( $_POST['type'] ) ); // Input var: okay.
			if ( 'edit_time' === $type ) {
				update_option( 'pbs_asked_rate_editing_time', '1' );
			} else {
				update_option( 'pbs_asked_rate_edited_posts', '1' );
			}

			die();
		}


		/**
		 * Displays an admin notice to rate PBS.
		 *
		 * @since 4.0.1
		 */
		public function ask_for_rating() {
			$has_rated = get_option( 'pbs_has_rated' );

			if ( ! empty( $has_rated ) ) {
				return;
			}

			$notice = '';
			$notice_type = '';

			$asked_editing_time = get_option( 'pbs_asked_rate_editing_time' );
			if ( ! $asked_editing_time ) {
				$seconds = (int) get_option( 'pbs_ask_total_editing_time' );
				if ( $seconds > 18000 ) {
					$notice_type = 'edit_time';
					$notice = __( 'Hey, I\'ve noticed that you\'ve been using Page Builder Sandwich for 5 hours now! Could you do us a huge favor and give our plugin a rating on WordPress? We\'re continually enhancing PBS, bringing you more and more features. Rate PBS to help spread the word and inspire us so we can bring you more cool stuff.', PAGE_BUILDER_SANDWICH );
				}
			}

			$asked_edited_posts = get_option( 'pbs_asked_rate_edited_posts' );
			if ( ! $asked_edited_posts ) {
				$posts_edited = get_option( 'pbs_ask_posts_edited' );
				if ( ! empty( $posts_edited ) && count( $posts_edited ) >= 5 ) {
					$notice_type = 'edit_post';
					$notice = __( 'Hey, I\'ve noticed that you\'ve now designed 5 pages using Page Builder Sandwich! Could you do us a huge favor and give our plugin a rating on WordPress? We\'re continually enhancing PBS, bringing you more and more features. Rate PBS to help spread the word and inspire us so we can bring you more cool stuff.', PAGE_BUILDER_SANDWICH );
				}
			}

			$no_label = $asked_editing_time || $asked_edited_posts ? __( 'No, don\'t ask me again', PAGE_BUILDER_SANDWICH ) : __( 'No, maybe later', PAGE_BUILDER_SANDWICH );

			if ( $notice ) {
				?>
				<div class="notice notice-info is-dismissible pbs-rate-notice" data-pbs-rate-type="<?php echo esc_attr( $notice_type ) ?>">
					<img src="<?php echo esc_url( plugins_url( 'page_builder_sandwich/images/pbs-logo.png', PBS_FILE ) ) ?>" alt="PBS Logo" height="70" width="70"/>
				    <p><?php echo esc_html( $notice ) ?></p>
					<p>
						<a class="button button-primary pbs-rate-yes" href="https://wordpress.org/plugins/page-builder-sandwich/" target="_blank"><?php esc_html_e( 'Rate us on WordPress', PAGE_BUILDER_SANDWICH ) ?></a>
						<a class="button button-default pbs-rate-no"><?php echo esc_html( $no_label ) ?></a>
					</p>
				</div>
				<?php
			}
		}
	}
}

new PBSAskRating();
