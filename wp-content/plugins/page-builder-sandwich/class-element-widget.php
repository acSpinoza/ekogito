<?php
/**
 * Widget Element class.
 *
 * @package Page Builder Sandwich
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'PBSElementWidget' ) ) {

	/**
	 * This is where all the widget element functionality happens.
	 */
	class PBSElementWidget {

		/**
		 * Holds the list of widgets available in WordPress.
		 * Only contains some information about the widgets.
		 *
		 * @var array
		 */
		public static $widget_slugs = array();

		/**
		 * Hook into WordPress.
		 */
		function __construct() {
			add_filter( 'pbs_localize_scripts', array( $this, 'add_widget_list' ) );
			add_action( 'wp_footer', array( $this, 'add_picker_frame_template' ) );
			add_action( 'wp_ajax_pbs_get_widget_templates', array( $this, 'get_widget_templates' ) );
		}


		/**
		 * Gather all the widgets available in WordPress.
		 *
		 * @since 2.11
		 *
		 * @return array a list of all widgets found.
		 */
		public static function gather_all_widgets() {
			if ( empty( self::$widget_slugs ) ) {
				global $wp_widget_factory;
				foreach ( $wp_widget_factory->widgets as $widget_slug => $widget_data ) {

					$widget_class = get_class( $widget_data );
					$widget_instance = new $widget_class( $widget_data->id_base, $widget_data->name, $widget_data->widget_options );

					// Sometimes descriptions do not work.
					$description = '';
					if ( ! empty( $widget_data->widget_options['description'] ) ) {
						$description = $widget_data->widget_options['description'];
					}

					self::$widget_slugs[ $widget_slug ] = array(
						'name' => $widget_data->name,
						'description' => $description,
						'id_base' => $widget_data->control_options['id_base'],
					);
				}
			}

			return self::$widget_slugs;
		}


		/**
		 * Add the list of available widgets for JS.
		 *
		 * @since 2.11
		 *
		 * @param array $params Localization parameters.
		 *
		 * @return array The modified parameters.
		 */
		public function add_widget_list( $params ) {
			$params['widget_list'] = self::gather_all_widgets();
			$params['widget_nonce'] = wp_create_nonce( 'pbs_widget_templates' );
			return $params;
		}


		/**
		 * Echo templates for rendering widget settings. We need to do this in an
		 * ajax handler since some widgets enqueue scripts and we cannot
		 * dequeue them afterwards. We can safely get only the form elements
		 * with ajax.
		 *
		 * @since 2.11.2
		 *
		 * @see _pbs-widget-templates.js
		 */
		public function get_widget_templates() {
			$nonce = sanitize_text_field( trim( $_POST['nonce'] ) );
			if ( ! wp_verify_nonce( $nonce, 'pbs_widget_templates' ) ) {
				die();
			}

			$all_widgets = self::gather_all_widgets();

			global $wp_widget_factory;
			foreach ( $all_widgets as $widget_slug => $widget_info ) {
				$factory_instance = $wp_widget_factory->widgets[ $widget_slug ];
				$widget_class = get_class( $factory_instance );
				$widget_instance = new $widget_class( $factory_instance->id_base, $factory_instance->name, $factory_instance->widget_options );

				ob_start();
				$widget_instance->form( array() );
				$form = ob_get_clean();

				// Strip all harmful scripts.
				$form = preg_replace( '/<script[^>]*>[\s\S]*?<\/script>/', '', $form );

				?>
				<script type="text/html" id="tmpl-pbs-widget-<?php echo esc_attr( $widget_slug ) ?>">
					<?php echo $form ?>
				</script>
				<?php

			}

			die();
		}


		/**
		 * Add the widget picker frame.
		 *
		 * @since 2.11
		 */
		public function add_picker_frame_template() {
			if ( ! PageBuilderSandwich::is_editable_by_user() ) {
				return;
			}

			include 'page_builder_sandwich/templates/frame-widget-picker.php';
		}
	}
}

new PBSElementWidget();
