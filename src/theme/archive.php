<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fahrschuelteam
 */

get_header(); ?>

	<?php 
	if (is_post_type_archive( 'feedback' )) {
		fahrschuelteam_testimonial('testimonial'); 
	} elseif (is_post_type_archive( 'faq' )) {
		fahrschuelteam_faq('faq');
	} else {

	?>
	<div id="primary" class="grid-container grid-x grid-padding-y align-center-middle">
		<main id="main" class="site-main medium-8 cell">
			
		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	}

get_footer();
