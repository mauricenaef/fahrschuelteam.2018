<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fahrschuelteam
 */

?>

	</div>

	<footer id="colophon" class="site-footer">
		<div class="powered-by">
			<div class="grid-container grid-x grid-padding-x powered-by-container">
				<p><small>Angetrieben von</small></p>
				<img src="<?php bloginfo('template_url'); ?>/images/hyundai-logo.svg" alt="Hyundai" class="hyundai">
			</div>
		</div>
		<div class="grid-container site-footer-main">
			<div class="grid-x grid-padding-x grid-padding-y small-up-2 medium-up-5 large-up-6">
				<div class="cell">
					<?php wp_nav_menu( array( 'theme_location' => 'footer_1' ,'menu_class' => 'menu vertical')); ?>
				</div>
				<div class="cell auto">
					<?php wp_nav_menu( array( 'theme_location' => 'footer_2' ,'menu_class' => 'menu vertical')); ?>
				</div>
				<div class="cell">
					<?php wp_nav_menu( array( 'theme_location' => 'footer_3' ,'menu_class' => 'menu vertical')); ?>
				</div>
				<div class="cell auto">
					<?php wp_nav_menu( array( 'theme_location' => 'footer_4' ,'menu_class' => 'menu vertical')); ?>
				</div>
				<div class="cell grid-x align-right">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
						<img src="<?php bloginfo('template_url'); ?>/images/logo.svg" alt="<?php bloginfo( 'name' ); ?>">
					</a>
					<p class="copyright">© <?php bloginfo( 'name' ); ?> - <?php echo date('Y'); ?></p>
					<a href="https://mauricenaef.ch" rel="noreferrer" class="credits-logo" title="Webdesign by mauricenaef.ch" target="_blank"><img src="https://mauricenaef.ch/externaldata/logo_icon.svg" width="24" height="24" title="Web Design by MAURICE NAEF webdesign" alt="Web Design by MAURICE NAEF webdesign" /></a>
				</div>
			</div>

			
		</div>
	</footer>
</div>

<button class="nav-trigger hamburger hamburger--elastic" type="button">
	<span class="hamburger-box">
		<span class="hamburger-inner"></span>
	</span>
</button>

<div id="nav" class="nav">
	<div class="navigation-wrapper">
		<div class="grid-container grid-x">
			<div class="medium-4 cell">
				<?php wp_nav_menu( array( 'theme_location' => 'footer_2' ,'menu_class' => 'menu vertical')); ?>
				<?php wp_nav_menu( array( 'theme_location' => 'footer_3' ,'menu_class' => 'menu vertical')); ?>
			</div>
			<div class="medium-4 cell">
			<?php wp_nav_menu( array( 'theme_location' => 'footer_1' ,'menu_class' => 'menu vertical')); ?>
				
				<?php wp_nav_menu( array( 'theme_location' => 'footer_4' ,'menu_class' => 'menu vertical')); ?>
			</div>
				
			<div class="medium-4 cell">
				<?php 
					$angebot_id = carbon_get_theme_option('navigation_angebot_package');
					$packages = carbon_get_post_meta( $angebot_id[0]['id'], 'angebot_packages' );
					if($angebot_id) {
						echo '<h3 class="h5 text-center">' . get_the_title( $angebot_id[0]['id'] ) . ' Bundles</h3>';

						foreach ( $packages as $package ) { 
							angebot_single_package( $package );
						}
					}
					
				?>
			</div>
			
		</div>
	</div>

<div class="loading-overlay">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" fill="#000">
		<path opacity=".25" d="M16 0 A16 16 0 0 0 16 32 A16 16 0 0 0 16 0 M16 4 A12 12 0 0 1 16 28 A12 12 0 0 1 16 4"/>
		<path d="M16 0 A16 16 0 0 1 32 16 L28 16 A12 12 0 0 0 16 4z">
		    <animateTransform attributeName="transform" type="rotate" from="0 16 16" to="360 16 16" dur="0.8s" repeatCount="indefinite" />
		</path>
	</svg>
</div>
<?php wp_footer(); ?>

</body>
</html>
