<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fahrschuelteam
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-lighter section-padding'); ?>>
	<div class="grid-container">
		<div class="grid-x align-spaced align-middle">
			<div class="cell small-6 medium-3">
				<?php the_post_thumbnail( 'full', ['class' => 'section-icon'] ); ?>
            </div>
			<div class="cell small-10 medium-5">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php 
					$video = carbon_get_the_post_meta('angebot_video_url');
					$thumbnail = carbon_get_the_post_meta('video_thumbnail');
					the_content(); 
					if($video) {
						echo '<div class="video-player"><a href="' . $video . '" class="intro-video">';
						echo $thumbnail ? wp_get_attachment_image($thumbnail, 'gallery_item' ) : get_svg_icon('play') ;
                        echo '</a></div><p class="play-intro"><small>Intro Abspielen</small></p>';
                    }
					?>
				</div><!-- .entry-content -->
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
<?php angebot_gallery(); ?>
<?php angebot_packages_section(); ?>
<?php angebot_forms(carbon_get_the_post_meta('angebot_kurs')); ?>
<?php angebot_details(); ?>

