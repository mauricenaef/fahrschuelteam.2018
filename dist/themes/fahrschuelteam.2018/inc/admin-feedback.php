<?php

#------------------------------------------------------------------------------------
# Feedback
#------------------------------------------------------------------------------------
// Register Custom Post Type
function custom_post_type_feedback() {

	$labels = array(
		'name'                => _x( 'Feedback', 'Post Type General Name', 'fahrschuelteam' ),
		'singular_name'       => _x( 'Feedback', 'Post Type Singular Name', 'fahrschuelteam' ),
		'menu_name'           => __( 'Feedback', 'fahrschuelteam' ),
		'name_admin_bar'      => __( 'Feedback', 'fahrschuelteam' ),
		'parent_item_colon'   => __( 'Feedback:', 'fahrschuelteam' ),
		'all_items'           => __( 'Alle Feedback', 'fahrschuelteam' ),
		'add_new_item'        => __( 'Neues Feedback', 'fahrschuelteam' ),
		'add_new'             => __( 'Neues Feedback hinzufügen', 'fahrschuelteam' ),
		'new_item'            => __( 'Neues Feedback', 'fahrschuelteam' ),
		'edit_item'           => __( 'Feedback bearbeiten', 'fahrschuelteam' ),
		'update_item'         => __( 'Feedback aktualisieren', 'fahrschuelteam' ),
		'view_item'           => __( 'Feedback ansehen', 'fahrschuelteam' ),
		'search_items'        => __( 'Feedback suchen', 'fahrschuelteam' ),
		'not_found'           => __( 'Nichts gefunden', 'fahrschuelteam' ),
		'not_found_in_trash'  => __( 'Im Papierkorb wurde nichts gefunden', 'fahrschuelteam' ),
	);
	$args = array(
		'label'               => __( 'Feedback', 'fahrschuelteam' ),
		'description'         => __( 'Feedback', 'fahrschuelteam' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' , 'editor', 'revisions', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-chat',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'rewrite'			  => array( 'slug' => 'feedbacks' ),
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'feedback', $args );

}
add_action( 'init', 'custom_post_type_feedback', 0 );



#------------------------------------------------------------------------------------
# Feedback Meta Data
#------------------------------------------------------------------------------------

add_action( 'cmb2_init', 'fahrschuelteam_feedback_metaboxes' );

function fahrschuelteam_feedback_metaboxes() {

	$prefix = '_feedback_';

	$meta_boxes = new_cmb2_box( array(
		'id'			=> 'feedback_metabox',
		'title'			=> 'Feedback',
		'object_types'	=> array( 'feedback' ),
		'contex'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
	) );

	$meta_boxes->add_field( array(
	    'name'		=> 'Sublinie',
	    'desc' 		=> 'Wähle optional einen Passenden Sublinie',
		'id'		=> $prefix . 'subline',
		'type' 		=> 'text',
	) );

	$meta_boxes->add_field( array(
	    'name'		=> 'Sublinie',
	    'desc' 		=> 'Wähle optional einen passende Sublinie',
		'id'		=> $prefix . 'subline',
		'type' 		=> 'text',
	) );
	$meta_boxes->add_field( array(
	    'name'      => 'Bewertung',
	    'id'		=> $prefix . 'rating',
	    'type'      => 'radio_inline',
	    'show_option_none' => true,
	    'options'          => array(
	        '1' 	=> '1 ★',
	        '2'   	=> '2 ★',
	        '3'  	=> '3 ★',
	        '4'  	=> '4 ★',
	        '5'  	=> '5 ★'
	    ),
	) );

}

#------------------------------------------------------------------------------------
# Change Title
#------------------------------------------------------------------------------------

function fahrschuelteam_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'feedback' == $screen->post_type ) {
          $title = 'Name des Feedback gebers';
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'fahrschuelteam_change_title_text' );

#------------------------------------------------------------------------------------
# Custom Columns Feedback 
#------------------------------------------------------------------------------------


add_filter("manage_edit-feedback_columns", "feedback_edit_columns");
add_action("manage_feedback_posts_custom_column",  "feedback_custom_columns");

function feedback_edit_columns($columns){
  $columns = array(
    'cb' 			=> '<input type="checkbox" />',
    'thumbnail'		=> 'Bild',
    'title' 		=> 'Name',
    'rating'		=> 'Bewertung',
    'date'			=> 'Datum',
    
  );
 
  return $columns;
}

function feedback_custom_columns($column) {
  	
  	global $post;


    switch ($column) {
    
    case 'thumbnail':

    	the_post_thumbnail( 'tiny' );

    	break;

    case 'rating':
    	    	
    	$rating = get_post_meta( get_the_ID(), '_feedback_rating' , true );

		if ( $rating ) {
			
			for ($i=0; $i < $rating ; $i++) { 
				echo '<span class="rating"></span>';
			}

	
		}

    	break;
     
  }
}

#------------------------------------------------------------------------------------
# Testimonial Section
#------------------------------------------------------------------------------------

function fahrschuelteam_feedback() {

	global $post;

	$args = array(
		'post_type' 	=> array( 'feedback' ),
		'numberposts'	=> -1,
		'order'			=> 'ASC',
		'orderby'		=> 'menu_order'
	); 
	
	$feedback = get_posts($args);
	
	if ($feedback) {
		
		echo	'<section class="testimonial-section site-section">';
		echo		'<div class="row">';
		echo			'<div class="small-12 columns">';

		echo				'<div class="testimonials-wrapper container">';
		echo					'<div class="testimonials owl-carousel">';

		//loop 1
		foreach($feedback as $post) : setup_postdata($post);

		$subline = get_post_meta( $post->ID, '_feedback_subline' , true );
		$rating = get_post_meta( $post->ID, '_feedback_rating' , true );
		
		echo 						'<div>';
		echo 								the_content();
		echo 								'<div class="author">';
		echo 								the_post_thumbnail( 'tiny' );
		echo 								'<ul class="author-info">';
		echo 							 		'<li>' . get_the_title() . '</li>';
		
		if($subline) {
		
		echo									'<li>' . esc_html( $subline ) . '</li>';
		
		}
		
		echo 								'</ul>';
		echo 								'</div>';
		echo 						'</div>';
				
		endforeach;

		echo 					'</div>';
		echo					'<a href="javascript:void(0);" class="testimonials-see-all button tiny">Alle Anzeigen</a>';
		echo 				'</div>';


		echo 				'<div class="testimonials-all">';
		echo 					'<div class="testimonials-all-wrapper">';
		echo 						'<ul>';
		//loop 2
		foreach($feedback as $post) : setup_postdata($post);
		
		$subline = get_post_meta( $post->ID, '_feedback_subline' , true );
		$rating = get_post_meta( $post->ID, '_feedback_rating' , true );
		
		echo 						'<li class="testimonials-item" >';
		echo 								the_content();
		echo 								'<div class="author">';
		echo 								the_post_thumbnail( 'tiny' );
		echo 								'<ul class="author-info">';
		echo 							 		'<li>' . get_the_title() . '</li>';
		
		if($subline) {
		
		echo									'<li>' . esc_html( $subline ) . '</li>';
		
		}
		
		echo 								'</ul>';
		echo 								'</div>';
		echo 						'</li>';
	
		endforeach;
	
		echo					'</ul>';
		echo				'</div>';
		echo				'<a href="javascript:void(0);" class="close-btn">Schliessen</a>';
		echo				'</div>';
		echo			'</div>';
		echo		'</div>';
		echo	'</section>';

	}
	wp_reset_postdata();

}

