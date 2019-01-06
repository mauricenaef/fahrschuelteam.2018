<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fahrschuelteam
 */

get_header(); ?>

	<?php fahrschuelteam_intro(); ?>

	<?php
	$bundles_data = carbon_get_theme_option( 'home_angebot_package' );
	if($bundles_data) {
		echo '<div class="section-tab-nav double button-group align-center">';
		foreach( $bundles_data as $item) {

			$page_title = get_the_title( $item['id'] );
			$slug = get_post_field( 'post_name', $item['id'] );

			echo '<a href="#' . $slug . '" class="section-slider-tab button hollow tiny primary_2">' . $page_title . '</a>';
			
		}
		echo '</div>';
		
		echo '<div class="bundles-wrapper">';
			echo '<div class="section-slider owl-carousel">';

		foreach( $bundles_data as $item) {
			
			$page_title = get_the_title( $item['id'] );
			$slug = get_post_field( 'post_name', $item['id'] );

			fahrschuelteam_bundles($slug, $item['id'] );

		}
			echo '</div>';
		echo '</div>';
	} // end if have bundles

	?>
	
	<?php fahrschuelteam_angebot(); ?>

	<div class="section-tab-nav button-group align-center">
		<a href="#testimonial" class="section-slider-tab button hollow tiny primary_2">Testimonial</a>
		<a href="#faq" class="section-slider-tab button hollow tiny primary_2">FAQ</a>
	</div>
	<div class="section-slider owl-carousel">
		<?php fahrschuelteam_testimonial('testimonial'); ?>
		<?php fahrschuelteam_faq('faq'); ?>
	</div>

	<?php fahrschuelteam_sponsoren(); ?>

<?php
get_footer();
