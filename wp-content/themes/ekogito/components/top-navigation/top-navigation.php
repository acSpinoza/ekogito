<nav id="site-navigation" class="main-navigation" role="navigation">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php esc_html_e( 'Top Menu', 'ekogito' ); ?></button>
	<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_id' => 'top-menu' ) ); ?>
</nav><!-- #site-navigation -->

<div class="overlay overlay-scale">
	<button type="button" class="overlay-close">Close</button>
	<nav>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Work</a></li>
			<li><a href="#">Clients</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
	</nav>
</div>
<p><button id="trigger-overlay" type="button">Open Overlay</button></p>
