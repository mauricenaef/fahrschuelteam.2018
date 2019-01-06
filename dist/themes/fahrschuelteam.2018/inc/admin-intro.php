<?php

function fahrschuelteam_intro( $page_id = NULL, $image_only = NULL ) {

    $page_id = isset($post_id) ? get_option( 'page_on_front' ) : $page_id;
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'hero' );
    $url = $thumb['0'];
    

    ?>
    <div id="primary" class="grid-container section-padding">
        
        <main id="main" class="grid-x intro align-center-middle intro-container" style="background-image: url('<?php echo $url; ?>');">

            <?php while ( have_posts() ) : the_post(); ?>
            <?php if($image_only != true) { ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('medium-4 medium-order-2 cell'); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title h5">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content();  ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->
            <?php } ?>
            <aside class="medium-4 medium-order-1 cell align-center-middle">
                <?php 
                    $home_video = carbon_get_the_post_meta('home_video_url');
                    $home_intro_icon = carbon_get_the_post_meta('home_intro_icon');
                    $home_gallery = carbon_get_the_post_meta('home_gallery');

                    if($home_video) {
                        echo '<div class="video-player"><a href="' . $home_video . '" class="intro-video">' . get_svg_icon('play') . '</a></div>';
                        echo '<p class="play-intro"><small>Intro Abspielen</small></p>';
                    } elseif ($home_intro_icon) {
                        echo '<div class="intro-icon">' . wp_get_attachment_image( $home_intro_icon , 'full') . '</div>';
                    }

                    if($home_gallery) {
                        thumbnail_gallery($home_gallery, 'small');
                    }


                ?>
                
            </aside>
            <?php endwhile; // End of the loop. ?>
		</main><!-- #main -->

	</div><!-- #primary -->
    <?php
}