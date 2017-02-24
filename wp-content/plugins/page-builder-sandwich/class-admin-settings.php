<?php
/**
 * Display our settings page.
 *
 * @since 3.4
 *
 * @package Page Builder Sandwich
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'PBSAdminSettings' ) ) {

	/**
	 * This is where all the admin page creation happens.
	 */
	class PBSAdminSettings {

		/**
		 * Hook into WordPress.
		 */
		function __construct() {
			add_action( 'admin_menu', array( $this, 'create_admin_menu' ), 11 );
			add_action( 'admin_init', array( $this, 'migrate_and_unify_old_settings' ), 0 );

			if ( PBS_IS_LITE || true ) {
				add_action( 'admin_init', array( $this, 'lite_settings_init' ) );
				add_action( 'wp_footer', array( $this, 'hide_premium_flags' ) );
			}
		}


		/**
		 * The old settings used `pbs_lite_options`, now we're unifying them
		 * all to `pbs_options`. This is to move the old ones into the new one.
		 *
		 * @since 4.0
		 */
		public function migrate_and_unify_old_settings() {

			// Check if we have some old settings.
			$has_old_settings = false;
			$options = get_option( 'pbs_lite_options' );
			if ( $options ) {
				if ( ! empty( $options['pbs_show_premium_flag'] ) ) {
					$has_old_settings = true;
				}
				delete_option( 'pbs_lite_options' );
			}

			if ( $has_old_settings ) {
				$options = get_option( 'pbs_options' );
				if ( ! $options ) {
					$options = array();
				}
				$options['pbs_show_premium_flag'] = true;
				update_option( 'pbs_options', $options );
			}
		}


		/**
		 * Initialize our settings page.
		 *
		 * @since 3.4
		 */
		public function lite_settings_init() {

		    // Register a new setting for lite options.
		    register_setting(
				'pbs_options_group', // Group name.
				'pbs_options' // Option name.
			);

		    // Register the lite settings section.
		    add_settings_section(
		        'pbs_lite_section', // ID.
		        __( 'Lite Settings', PAGE_BUILDER_SANDWICH ), // Title.
				'__return_false', // Callback.
		        'pbs_options_group' // Group name.
		    );

		    // Register the premium flags field.
		    add_settings_field(
		        'pbs_show_premium_flag', // ID.
				__( 'Hide Premium Feature Flags', PAGE_BUILDER_SANDWICH ), // Title.
		        array( $this, 'pbs_premium_flag_field' ), // Callback
		        'pbs_options_group', // Group name.
		        'pbs_lite_section', // Section.
		        array(
		            'name' => 'pbs_show_premium_flag',
		        ) // Args.
		    );
		}


		/**
		 * Creates the PBS admin settings.
		 *
		 * @since 3.4
		 *
		 * @param array $args The arguments passed from add_settings_field.
		 */
		public function pbs_premium_flag_field( $args ) {
		    $options = get_option( 'pbs_options' );

		    ?>
			<label>
				<input
					type="checkbox"
					name="pbs_options[<?php echo esc_attr( $args['name'] ); ?>]"
					value="1"
					<?php checked( ! empty( $options[ $args['name'] ] ) && $options[ $args['name'] ], '1' ) ?>
				/>
				<?php esc_html_e( 'Hide all elements, tools and options that are only available in the premium version.', PAGE_BUILDER_SANDWICH ) ?>
			</label>
			<p class="description">
				<?php esc_html_e( 'The premium version has a lot of stuff to offer, we\'ve added flags on the areas which are only available in the premium version so that you can see what\'s in store for you. You can choose to hide those by checking this option.', 'PAGE_BUILDER_SANDWICH' ) ?>
			</p>
		    <?php
		}


		/**
		 * Creates the PBS admin settings menu item.
		 *
		 * @since 3.4
		 */
		public function create_admin_menu() {
			add_submenu_page(
				'page-builder-sandwich', // Parent slug.
				esc_html__( 'Page Builder Sandwich Settings', PAGE_BUILDER_SANDWICH ), // Page title.
				esc_html__( 'Settings', PAGE_BUILDER_SANDWICH ), // Menu title.
				'manage_options', // Permissions.
				'page-builder-sandwich-settings', // Slug.
				array( $this, 'create_admin_settings_page' ) // Page creation function.
			);
		}


		/**
		 * Creates the contents of the settings page.
		 *
		 * @since 3.4
		 */
		public function create_admin_settings_page() {

			// Add settings saved message with the class of "updated".
			if ( isset( $_GET['settings-updated'] ) ) { // Input var: okay.
				add_settings_error( 'pbs_messages', 'pbs_message', esc_html__( 'Settings Saved', PAGE_BUILDER_SANDWICH ), 'updated' );
			}

			// Show error/update messages.
			settings_errors( 'pbs_messages' );

			?>
			<div class="wrap">
				<h1><?php esc_html_e( get_admin_page_title() ) ?></h1>
				<form action="options.php" method="post">
					<?php
					// Output security fields.
					settings_fields( 'pbs_options_group' );

					// Output setting sections and fields.
					do_settings_sections( 'pbs_options_group' );

					// Output save settings button.
					submit_button();
					?>
				</form>
			</div>
			<?php
		}


		/**
		 * Hides the premium elements if the setting is turned on.
		 */
		public function hide_premium_flags() {
			if ( PageBuilderSandwich::is_editable_by_user() ) {
				$options = get_option( 'pbs_options' );
				if ( ! empty( $options['pbs_show_premium_flag'] ) ) {
					?>
					<style>
					.pbs-premium-flag, .pbs-premium-flag-container {
						display: none !important;
					}
					</style>
					<?php
				}
			}
		}
	}
}

new PBSAdminSettings();
