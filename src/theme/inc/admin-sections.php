<?php

function fahrschuelteam_section( $data ) {

    if($data) {

    $data = carbon_get_the_post_meta($data);
    foreach($data as $item) {
        $order = ($item['layout'] == 'left') ? 'medium-order-2' : '';
        $image_id = $item['icon'];
        $title = $item['title'];
        $content = $item['content'];
        $video = $item['video_url'];
        $gallery = $item['gallery'];
    ?>
    <article class="bg-white monster-padding" >
        <div class="grid-container">
            <div class="grid-x align-spaced align-middle">
                <div class="cell small-6 medium-3 section-padding <?php echo $order; ?>">
                    <?php echo wp_get_attachment_image( $image_id, 'portrait_large', "", ['class' => 'section-icon avatar shadow'] ); ?>
                </div>
                <div class="cell small-10 medium-5">
                    <header class="entry-header">
                        <?php echo '<h2 class="section-title">' . $title . '</h2>'; ?>
                    </header><!-- .entry-header -->
                    <div class="entry-content">
                        <?php 
                        echo apply_filters( 'the_content', $content );
                        if($video) {
                            echo '<div class="video-player"><a href="' . $video . '" class="intro-video">' . get_svg_icon('play') . '</a></div>';
                            echo '<p class="play-intro"><small>Video Abspielen</small></p>';
                        }
                        if($gallery) {
                            thumbnail_gallery( $gallery, 'small' );
                        }
                        ?>
                    </div><!-- .entry-content -->
                </div>
            </div>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->
        <?php
        } // end foreach
    }
    
}