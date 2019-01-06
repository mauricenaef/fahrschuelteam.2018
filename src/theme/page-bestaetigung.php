<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fahrschuelteam
 * 
 * Template Name: Bestätigung
 * 
 */

$fahrlehrer = isset($_GET['fahrlehrer']) ? $_GET['fahrlehrer'] : '';
$paket = isset($_GET['paket']) ? $_GET['paket'] : '';
$preis = isset($_GET['preis']) ? $_GET['preis'] : '';

$patric = apply_filters( 'the_content', carbon_get_theme_option('bank_patric') );
$thomas = apply_filters( 'the_content', carbon_get_theme_option('bank_thomas') );
$egal = apply_filters( 'the_content', carbon_get_theme_option('bank_gemeinschaft') );

get_header(); ?>

	<div id="primary" class="grid-container grid-x grid-padding-y align-center-middle section-padding">
		<div class="cell text-center"><p><a href="#" onclick="goBack()" class="center-align"><?php svg_icon('arrow-left'); ?> Zurück</a></p></div>
		<main id="main" class="site-main anmeldung medium-8 cell shadow element-padding">
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				?>
				<header class="entry-header">
				<?php
				the_title( '<h1 class="page-title">', '</h1>' );
				?>
				</header><!-- .entry-header -->
				<div class="entry-content">
				<?php
				echo apply_filters( 'the_content', carbon_get_theme_option('bestaetigung_intro') );

				echo '<ul>';
				echo '<li><strong>Dein Fahrlehrer:</strong> ' . $fahrlehrer . '</li>';
				echo '<li><strong>Dein Paket:</strong> ' . $paket . '</li>';
				echo '<li><strong>Preis:</strong> ' .  $preis  . '</li>';
				if( $fahrlehrer == 'Patric Della Rossa' ) {
					echo '<li><strong>Bankangaben</strong> ' . $patric . '</li>';
				} elseif( $fahrlehrer == 'Thomas Rüegsegger' ) {
					echo '<li><strong>Bankangaben</strong> ' .  $thomas. '</li>';
				} else {
					echo '<li><strong>Bankangaben</strong> ' .  $egal. '</li>';
				} 
				echo '</ul>';

				echo apply_filters( 'the_content', carbon_get_theme_option('bestaetigung_outro') );
				?>
				</div><!-- .entry-content -->
				<?php
			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
