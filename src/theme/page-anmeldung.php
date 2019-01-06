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
 * Template Name: Anmeldung
 * 
 */

$page_title = isset($_GET['page_title']) ? $_GET['page_title'] : '';
$form_id = isset($_GET['form']) ? $_GET['form'] : '';

get_header(); ?>

	<div id="primary" class="grid-container grid-x grid-padding-y align-center-middle section-padding">
		<div class="cell text-center"><p><a href="#" onclick="goBack()" class="center-align"><?php svg_icon('arrow-left'); ?> Zurück</a></p></div>
		<main id="main" class="site-main anmeldung medium-8 cell shadow element-padding">
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				//echo '<h1 class="page-title">' . $page_title . '</h1>';

				gravity_form( $form_id, true, true, false, '', true );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
