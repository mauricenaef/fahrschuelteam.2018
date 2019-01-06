<?php
// Register Custom Post Type
function custom_post_type_faq() {

	$labels = array(
		'name'                  => _x( 'FAQs', 'Post Type General Name', 'fahrschuelteam' ),
		'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'fahrschuelteam' ),
		'menu_name'             => __( 'FAQ', 'fahrschuelteam' ),
		'name_admin_bar'        => __( 'FAQ', 'fahrschuelteam' ),
		'archives'              => __( 'Element Archiv', 'fahrschuelteam' ),
		'attributes'            => __( 'Element Attribute', 'fahrschuelteam' ),
		'parent_item_colon'     => __( 'Eltern Element:', 'fahrschuelteam' ),
		'all_items'             => __( 'Alle Elemente', 'fahrschuelteam' ),
		'add_new_item'          => __( 'Neues Element', 'fahrschuelteam' ),
		'add_new'               => __( 'Hinzufügen', 'fahrschuelteam' ),
		'new_item'              => __( 'Neues Element', 'fahrschuelteam' ),
		'edit_item'             => __( 'Bearbeiten', 'fahrschuelteam' ),
		'update_item'           => __( 'Aktualisieren', 'fahrschuelteam' ),
		'view_item'             => __( 'Anschauen', 'fahrschuelteam' ),
		'view_items'            => __( 'Elemente Anschauen', 'fahrschuelteam' ),
		'search_items'          => __( 'Suchen', 'fahrschuelteam' ),
		'not_found'             => __( 'Nichts gefunden', 'fahrschuelteam' ),
		'not_found_in_trash'    => __( 'Im Abfall Eimer nichts gefunden', 'fahrschuelteam' ),
		'featured_image'        => __( 'Beitragsbild', 'fahrschuelteam' ),
		'set_featured_image'    => __( 'Beitragsbild setzen', 'fahrschuelteam' ),
		'remove_featured_image' => __( 'Beitragsbild entfernen', 'fahrschuelteam' ),
		'use_featured_image'    => __( 'Als Beitragsbild benutzen', 'fahrschuelteam' ),
		'insert_into_item'      => __( 'Einfügen', 'fahrschuelteam' ),
		'uploaded_to_this_item' => __( 'Zum element hochladen', 'fahrschuelteam' ),
		'items_list'            => __( 'Elemente Liste', 'fahrschuelteam' ),
		'items_list_navigation' => __( 'Elemente Liste in Navigation', 'fahrschuelteam' ),
		'filter_items_list'     => __( 'Elemente Filtern', 'fahrschuelteam' ),
	);
	$args = array(
		'label'                 => __( 'FAQ', 'fahrschuelteam' ),
		'description'           => __( 'Frequently Asked Questions', 'fahrschuelteam' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'revisions' ),
		'taxonomies'            => array( 'faq_kategorie' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'faq', $args );

}
add_action( 'init', 'custom_post_type_faq', 0 );



// Register Custom Taxonomy
function custom_taxonomy_faq_kategorie() {

	$labels = array(
		'name'                       => _x( 'FAQ Kategorien', 'Taxonomy General Name', 'fahrschuelteam' ),
		'singular_name'              => _x( 'FAQ Kategorie', 'Taxonomy Singular Name', 'fahrschuelteam' ),
		'menu_name'                  => __( 'Kategorie', 'fahrschuelteam' ),
		'all_items'                  => __( 'Alle Kategorien', 'fahrschuelteam' ),
		'parent_item'                => __( 'Eltern Kategorie', 'fahrschuelteam' ),
		'parent_item_colon'          => __( 'Eltern Element:', 'fahrschuelteam' ),
		'new_item_name'              => __( 'Neue Kategorie', 'fahrschuelteam' ),
		'add_new_item'               => __( 'Kategorie hinzufügen', 'fahrschuelteam' ),
		'edit_item'                  => __( 'Kategorie bearbeiten', 'fahrschuelteam' ),
		'update_item'                => __( 'Kategorie aktualisieren', 'fahrschuelteam' ),
		'view_item'                  => __( 'Kategorie anschauen', 'fahrschuelteam' ),
		'separate_items_with_commas' => __( 'Mit Kommas trennen', 'fahrschuelteam' ),
		'add_or_remove_items'        => __( 'Hinzufügen oder entfernen', 'fahrschuelteam' ),
		'choose_from_most_used'      => __( 'Wähle von den meistbenutzten Kategorien aus', 'fahrschuelteam' ),
		'popular_items'              => __( 'Oft benutzte', 'fahrschuelteam' ),
		'search_items'               => __( 'Suchen', 'fahrschuelteam' ),
		'not_found'                  => __( 'Nichts gefunden', 'fahrschuelteam' ),
		'no_terms'                   => __( 'Keine Elemente', 'fahrschuelteam' ),
		'items_list'                 => __( 'Elemente Liste', 'fahrschuelteam' ),
		'items_list_navigation'      => __( 'Elemente Liste Navigation', 'fahrschuelteam' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'faq_kategorie', array( 'faq' ), $args );

}
add_action( 'init', 'custom_taxonomy_faq_kategorie', 0 );

function fahrschuelteam_faq( $datahash = null ) {
    global $post;

	$args = array(
		'post_type' 	=> array( 'faq' ),
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
                    <img src="<?php bloginfo( 'template_url' ) ?>/images/icon/icon-faq.svg" class="section-icon faq-section-icon" alt="Testimonial">
                </div>
                <div class="cell small-10 medium-5 large-4 medium-offset-pull-1">
                    <div class="card testimonial-card faq-card shadow">
                        <div class="card-header text-center">
                            <h2 class="card-header-title"><?php echo carbon_get_theme_option('home_faq_title'); ?></h2>
                            <?php echo apply_filters( 'the_content', carbon_get_theme_option('home_faq_content') ); ?>
                        </div>
                        <div class="card-content shadow">
							<?php 
							svg_icon('search'); 
							?>
							<div id="card-content" >
							<?php
								$args = array(
									'numberposts'	=> 6,
									'post_type'		=> 'faq',
									'orderby' 		=> 'menu_order', 
									'order' 		=> 'ASC', 
								);
								$custom_posts = get_posts($args);
								foreach($custom_posts as $post) : setup_postdata($post);

								the_title('<h6>','</h6>');
								the_content();
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