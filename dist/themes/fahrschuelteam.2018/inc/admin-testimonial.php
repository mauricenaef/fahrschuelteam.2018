<?php

function fahrschuelteam_testimonial( $datahash = null ) {
    global $post;

	$args = array(
		'post_type' 	=> array( 'feedback' ),
		'numberposts'	=> -1,
		'order'			=> 'ASC',
		'orderby'		=> 'menu_order'
    );
    
    $feedback = get_posts($args);
	
	if ($feedback) {
    ?>
    <div data-hash="<?php echo $datahash; ?>">
    <section class="testimonial-section bg-lighter section-padding">
        <div class="grid-container">
            <div class="grid-x align-justify align-middle small-align-center-middle">
                <div class="cell small-6 medium-3 medium-offset-1">
                    <img src="<?php bloginfo( 'template_url' ) ?>/images/icon/icon-testimonial.svg" class="section-icon testimonial-section-icon" alt="Testimonial">
                </div>
                <div class="cell small-10 medium-5 large-4 medium-offset-pull-1">
                    <div class="card testimonial-card shadow">
                        <div class="card-header text-center">
                            <h2 class="card-header-title"><?php echo carbon_get_theme_option('home_testimonial_title'); ?></h2>
                            <?php echo apply_filters( 'the_content', carbon_get_theme_option('home_testimonial_content') ); ?>
                        </div>
                        <div class="card-content shadow">


                            <div class="slider" data-slick='{
                                "slidesToShow": 1, 
                                "slidesToScroll": 1,
                                "dots": true,
                                "adaptiveHeight": true,
                                "arrows": false
                            }'>
                            <?php
                            //loop 1
                            foreach($feedback as $post) : setup_postdata($post);

                            $subline = get_post_meta( $post->ID, '_feedback_subline' , true );
                            $rating = get_post_meta( $post->ID, '_feedback_rating' , true );
                            echo '<div class="item">';
                            echo the_post_thumbnail( 'thumbnail', ['class' => 'avatar'] );
                            echo wpautop( get_the_content() );
                            echo '<div class="title">' . get_the_title() . '</div>';
                            if($subline) {
                            echo '<div class="subline">' . esc_html( $subline ) . '</div>';    
                            }
                            if ( $rating ) {
                                for ($i=0; $i < $rating ; $i++) { 
                                    echo '<span class="rating">★</span>';
                                }
                            }
                            echo '</div>';

                            endforeach;
                            ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

		
    </section>
    </div>
    <?php
    }
}