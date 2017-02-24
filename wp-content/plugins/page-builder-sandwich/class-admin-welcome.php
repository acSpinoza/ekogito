<?php
/**
 * Display a welcome admin page.
 *
 * @since 3.2
 *
 * @package Page Builder Sandwich
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'PBSAdminWelcome' ) ) {

	/**
	 * This is where all the admin page creation happens.
	 */
	class PBSAdminWelcome {

		/**
		 * Hook into WordPress.
		 */
		function __construct() {
			add_action( 'admin_menu', array( $this, 'create_admin_menu' ) );
			add_action( 'activated_plugin', array( $this, 'redirect_to_welcome_page' ) );
		}


		/**
		 * Creates the PBS admin menu item.
		 *
		 * @since 3.2
		 */
		public function create_admin_menu() {
			add_menu_page(
				esc_html__( 'Page Builder Sandwich', PAGE_BUILDER_SANDWICH ), // Page title.
				esc_html__( 'PBSandwich', PAGE_BUILDER_SANDWICH ), // Menu title.
				'manage_options', // Permissions.
				'page-builder-sandwich', // Slug.
				array( $this, 'create_admin_page' ) // Page creation function.
			);

			add_submenu_page(
				'page-builder-sandwich', // Parent slug.
				esc_html__( 'Page Builder Sandwich', PAGE_BUILDER_SANDWICH ), // Page title.
				esc_html__( 'Home', PAGE_BUILDER_SANDWICH ), // Menu title.
				'manage_options', // Permissions.
				'page-builder-sandwich', // Slug.
				array( $this, 'create_admin_page' ) // Page creation function.
			);
		}


		/**
		 * Creates the contents of the welcome admin page.
		 *
		 * @since 3.2
		 */
		public function create_admin_page() {
			?>
			<div class="wrap about-wrap">
				<img class="pbs-logo" src="<?php echo esc_url( plugins_url( 'page_builder_sandwich/images/pbs-logo.png', __FILE__ ) ) ?>"/>
				<h1><?php esc_html_e( 'Welcome to Page Builder Sandwich', PAGE_BUILDER_SANDWICH ) ?> v<?php esc_html_e( VERSION_PAGE_BUILDER_SANDWICH ) ?></h1>
				<p class="pbs-subheading"><?php esc_html_e( 'Creating Stunning Webpages Is Now as Easy as Making a Sandwich', PAGE_BUILDER_SANDWICH ) ?></p>
				<div class="welcome-panel">
					<div class="welcome-panel-column">
						<div class="pbs-welcome-column-wrapper">
							<h3><?php esc_html_e( "Let's Get Started", PAGE_BUILDER_SANDWICH ) ?></h3>
							<a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ) ?>"><?php esc_html_e( 'Create New Page', PAGE_BUILDER_SANDWICH ) ?></a>
							<p><?php esc_html_e( 'To start, create a new page then click on the awesome "Edit with Page Builder Sandwich" button.', PAGE_BUILDER_SANDWICH ) ?></p>
						</div>
					</div>
					<div class="welcome-panel-column">
						<div class="pbs-welcome-column-wrapper">
							<h3><?php esc_html_e( 'Join The Community', PAGE_BUILDER_SANDWICH ) ?></h3>
							<p><?php esc_html_e( 'Join fellow PBSandwich aficionados in our community, ask questions, give feedback, suggest features, and discuss your projects!', PAGE_BUILDER_SANDWICH ) ?></p>
							<ul>
								<li><a href="https://pbsandwich.herokuapp.com/" target="_pbsadmin"><span class="dashicons dashicons-admin-comments"></span> <?php esc_html_e( 'Join our new community in Slack', PAGE_BUILDER_SANDWICH ) ?></a></li>
								<li><a href="https://twitter.com/WP_PBSandwich" target="_pbsadmin"><span class="dashicons dashicons-twitter"></span> <?php esc_html_e( 'Follow @WP_PBSandwich in Twitter', PAGE_BUILDER_SANDWICH ) ?></a></li>
							</ul>
						</div>
					</div>
					<div class="welcome-panel-column welcome-panel-last">
						<div class="pbs-welcome-column-wrapper">
							<h3><?php esc_html_e( 'Need Help?', PAGE_BUILDER_SANDWICH ) ?></h3>
							<p>
								<?php
								printf(
									__( 'Stuck with something? Check out our %sknowledge base%s. You can also contact us for %sbug reports%s here in your dashboard.', PAGE_BUILDER_SANDWICH ),
								 	'<a href="http://docs.pagebuildersandwich.com/" target="_pbsadmin">',
									'</a>',
								 	'<a href="' . esc_url( admin_url( 'admin.php?page=page-builder-sandwich-contact' ) ) . '" target="_pbsadmin">',
									'</a>'
								);
								?>
							</p>
							<?php
							if ( PBS_IS_LITE ) {
								?>
								<p>
									<?php
									printf(
										'If you need more extensive help, please consider %sgoing premium%s to get support.',
										'<a href="' . esc_url( admin_url( 'admin.php?page=page-builder-sandwich-pricing' ) ) . '">',
										'</a>'
									);
									?>
								</p>
								<?php
							}
							?>
						</div>
					</div>
				</div>
				<div class="welcome-panel">
					<div class="welcome-panel-column" style="width: 50%;">
						<div class="pbs-welcome-column-wrapper">
							<h3><?php esc_html_e( "What's New", PAGE_BUILDER_SANDWICH ) ?></h3>
							<div class="pbs-whats-new">
								<div>
									<p><strong>Same Page Links</strong><br>
										Use the ".class" or "#ID" of an element in a link and the page will smoothly scroll to it. (Premium)</p>
								</div>
								<div>
									<p><strong>Better Formatting Bar</strong><br>
										We've reworked a few of the buttons to make them easier to use. We added in prettier colors options too.</p>
								</div>
								<div>
									<p><strong>Page Templates</strong><br>
										We have 10 page templates that you can use as a starting point for your designs. (Premium)</p>
								</div>
								<div>
									<p><strong>Responsive Views</strong><br>
										Switch between desktop, tablet and mobile phone views while editing.</p>
								</div>
								<div>
									<p><strong>New Row Backgrounds</strong><br>
										Add image parallax, video backgrounds and Ken Burns background sliders to your rows. (Premium)</p>
								</div>
								<div>
									<p><strong>Lote of New Elements</strong><br>
										Count up, page heading, icon label, pricing tables, social icons and more! (Premium)</p>
								</div>
								<div>
									<p><strong>More Responsive</strong><br>
										Enhanced responsiveness, we now perform a lot of tweaks to make your site look good.</p>
								</div>
								<div>
									<p><strong>Edit Post Titles</strong><br>
										Now you can change page and post titles when editing. Just click on your title and type away.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="welcome-panel-column welcome-panel-last" style="width: 50%;">
						<div class="pbs-welcome-column-wrapper">
							<h3><?php esc_html_e( 'Watch the Tour', PAGE_BUILDER_SANDWICH ) ?></h3>
							<div class="pbs-tour">
								<iframe src="https://www.youtube.com/embed/dSU2l1Vhp50?rel=0&showinfo=0&autohide=1&controls=0" width="800" height="450" frameborder="0" allowfullscreen="1"></iframe>
							</div>
						</div>
					</div>
				</div>
				<div class="welcome-panel pbs-welcome-changelog">
					<h3><?php esc_html_e( "A Stickler for details? Here's everything's that changed in this version", PAGE_BUILDER_SANDWICH ) ?></h3>
					<ul>
<li style="color: #f39c12"><code>Enhanced</code> Updated Freemius SDK to v1.2.1.5</li>
<li style="color: #e74c3c"><code>Fixed</code> Some themes forced paragraphs & headings to have a fixed width inside columns, we now get around this.</li>
<li style="color: #e74c3c"><code>Fixed</code> Added page-template-sample to prevent php errors upon deactivation.</li>
					</ul>
				</div>
			</div>
			<?php
		}


		/**
		 * Redirect to our welcome page after activation.
		 *
		 * @since 3.2
		 *
		 * @param string $plugin The path to the plugin that was activated.
		 */
		public function redirect_to_welcome_page( $plugin ) {
			if ( plugin_basename( PBS_FILE ) === $plugin ) {
				wp_redirect( esc_url( admin_url( 'admin.php?page=page-builder-sandwich' ) ) );
				die();
			}
		}
	}
}

new PBSAdminWelcome();
