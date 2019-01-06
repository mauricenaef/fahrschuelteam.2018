<?php

// Register Custom Post Type
function custom_post_type_angebote() {

	$labels = array(
		'name'                  => _x( 'Angebote', 'Post Type General Name', 'fahrschuelteam' ),
		'singular_name'         => _x( 'Angebot', 'Post Type Singular Name', 'fahrschuelteam' ),
		'menu_name'             => __( 'Angebot', 'fahrschuelteam' ),
		'name_admin_bar'        => __( 'Angebot', 'fahrschuelteam' ),
		'archives'              => __( 'Angebote', 'fahrschuelteam' ),
		'parent_item_colon'     => __( 'Parent Item:', 'fahrschuelteam' ),
		'all_items'             => __( 'Alle Angebote', 'fahrschuelteam' ),
		'add_new_item'          => __( 'Neues Angebot', 'fahrschuelteam' ),
		'add_new'               => __( 'Neues Angebot hinzufügen', 'fahrschuelteam' ),
		'new_item'              => __( 'Neues Angebot', 'fahrschuelteam' ),
		'edit_item'             => __( 'Angebot berabeiten', 'fahrschuelteam' ),
		'update_item'           => __( 'Angebot aktualisieren', 'fahrschuelteam' ),
		'view_item'             => __( 'Angebot details', 'fahrschuelteam' ),
		'search_items'          => __( 'Angebot suchen', 'fahrschuelteam' ),
		'not_found'             => __( 'Nichts gefunden', 'fahrschuelteam' ),
		'not_found_in_trash'    => __( 'Nichts gefunden im Papierkorb', 'fahrschuelteam' ),
		'featured_image'        => __( 'Hauptbild', 'fahrschuelteam' ),
		'set_featured_image'    => __( 'Hauptbild setzen', 'fahrschuelteam' ),
		'remove_featured_image' => __( 'Hauptbild entfernen', 'fahrschuelteam' ),
		'use_featured_image'    => __( 'Benutzte Bild als Hauptbild', 'fahrschuelteam' ),
		'insert_into_item'      => __( 'Einfügen', 'fahrschuelteam' ),
		'uploaded_to_this_item' => __( 'Hochladen', 'fahrschuelteam' ),
		'items_list'            => __( 'Angebot liste', 'fahrschuelteam' ),
		'items_list_navigation' => __( 'Angebot liste navigation', 'fahrschuelteam' ),
		'filter_items_list'     => __( 'Angebot liste filtern', 'fahrschuelteam' ),
	);
	$args = array(
		'label'                 => __( 'Angebot', 'fahrschuelteam' ),
		'description'           => __( 'L-Team Angebote', 'fahrschuelteam' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'			=> array( 'angebot_kategorie' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 2,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'angebot', $args );

}
add_action( 'init', 'custom_post_type_angebote', 0 );

// Register Custom Taxonomy
function custom_taxonomy_angebot_kategorie() {

	$labels = array(
		'name'                       => 'Kategorien',
		'singular_name'              => 'Kategorie',
		'menu_name'                  => 'Kategorien',
		'all_items'                  => 'Alle Kategorien',
		'parent_item'                => 'Kategorien',
		'parent_item_colon'          => 'Kategorien',
		'new_item_name'              => 'Neue Kategorie',
		'add_new_item'               => 'Kategorie hinzufügen',
		'edit_item'                  => 'Kategorie bearbeiten',
		'update_item'                => 'Kategorie aktualisieren',
		'view_item'                  => 'Kategorie ansehen',
		'separate_items_with_commas' => 'Trenne Kategorien mit kommas',
		'add_or_remove_items'        => 'hinzufügen oder entfernen',
		'choose_from_most_used'      => 'Wähle aus den meistbenutzten Kategorien',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'angebot_kategorie', array( 'angebote' ), $args );

}
// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy_angebot_kategorie', 0 );


#------------------------------------------------------------------------------------
# Angebot Carousel
#------------------------------------------------------------------------------------

function fahrschuelteam_angebot() {

	$args = array(
		'post_type'			=> 'angebot',
		'posts_per_page'	=> -1,
		'orderby'			=> 'menu_order',
		'order'				=> 'DESC'
	);
	$angebote = get_posts( $args );
	if ($angebote) {
		echo '<section class="angebot-section site-section section-padding">';
		echo '<div class="grid-container">';
		echo '<div class="grid-x align-center">';
		echo '<div class="angebot-intro text-center large-6 cell section-padding">';
		echo '<h2 class="angebot-title h3">' . carbon_get_theme_option( 'home_angebote_title') . "</h2>";
		echo wpautop(carbon_get_theme_option( 'home_angebote_content'));
		echo '</div>';
		echo '</div>';
		echo '<div class="angebot-content">';
		
		foreach ($angebote as $angebot) {
				
			$subline = get_post_meta($angebot->ID, '_angebote_kat', true );

			echo '<a href="' . get_permalink($angebot->ID)  . '" class="angebot-link text-center" title="' . get_the_title( $angebot->ID ) . '">';
			if(has_post_thumbnail( $angebot->ID )) {
				echo get_the_post_thumbnail( $angebot->ID, 'portrait', array( 'class' => 'portrait' ) );
			}
			echo '<h3 class="h6 angebot-title">' . get_the_title( $angebot->ID ) . '</h3>';
			if($subline) {
				echo '<div class="angebot-subline">' . $subline . '</div>';
			}
			
			echo '</a>';
		}
		echo '</div>';

		echo '</div>';

		echo '<div id="parallax-lvl-0" ">';
			echo '<div id="b0-1" class="bubble size1">&nbsp;</div>';
			echo '<div id="b0-2" class="bubble size2">&nbsp;</div>';
		echo '</div>';

		echo '<div id="parallax-lvl-1" ">';
			echo '<div id="b1-1" class="bubble size3">&nbsp;</div>';
			echo '<div id="b1-2" class="bubble size4">&nbsp;</div>';
		echo '</div>';

		echo '</section>';
	}
}


#------------------------------------------------------------------------------------
# Angebot Packages
#------------------------------------------------------------------------------------

function fahrschuelteam_bundles( $datahash, $page_id ) {

    ?>
    <section class="bundles-section" data-hash="<?php echo $datahash; ?>">
        <div class="grid-container">
            <div class="grid-x align-right">

                <?php angebot_packages($page_id); ?>

            </div>
        </div>
    </section>
    <?php
}


function angebot_packages_section() {
	
	$packages = carbon_get_the_post_meta( 'angebot_packages' );
	if($packages) {
		?>
		<section class="angebot-section section-padding bundles-wrapper">
			<div class="grid-container">
				<div class="grid-x align-right">
				
				<?php angebot_packages(); ?>
	
				</div>
			</div>
		</section>
		<?php
	}
}

function angebot_packages( $post_id = NULL ) {
	$post_id = isset($post_id) ? $post_id : get_the_ID();
	$packages = carbon_get_post_meta( $post_id, 'angebot_packages' );
	if($packages) {
		foreach ( $packages as $package ) {
			?><div class="card bundle-card cell medium-6 large-3"><?php
			angebot_single_package( $package );
			?></div><?php
		}
	}
}

function angebot_single_package( $package ) {
	?>
	<div class="text-center card-content shadow" >
    	<div class="card-header">
        	<?php echo '<h3>' . $package['title'] . '</h3>'; ?>
        </div>
        <div class="card-details">
        	<?php echo apply_filters( 'the_content', $package['content'] ); ?>
			<?php echo '<p class="price">CHF ' . $package['price'] . '</p>'; ?>
            <?php echo '<p class="price-savings">' . $package['sub_price'] . '</p>'; ?>
        </div>
        <div class="card-action">
			<?php
			echo '<a href="' . esc_url( add_query_arg( array( 'form' => $package['formular'], 'page_title' =>  $package['title']) , get_permalink( get_page_by_title( 'Anmeldung' ) ) ) ) .'" class="button icon-button">' . $package['title'] . ' wählen ' . get_svg_icon('arrow-right') . '</a>';
			?>
        </div>
    </div>
	<?php

}

#------------------------------------------------------------------------------------
# Angebot Gallery
#------------------------------------------------------------------------------------

function angebot_gallery() {

	$data = carbon_get_post_meta(  get_the_ID() ,'angebot_gallery' );

	if($data) {
		echo '<section class="align-middle bg-dark">';
		echo '<div class="grid-container grid-x text-center">';
		thumbnail_gallery( $data );
		echo '</div>';
		echo '</section>';
	}
	
}

#------------------------------------------------------------------------------------
# Angebot Details Content
#------------------------------------------------------------------------------------

function angebot_details() {
	
	$data = carbon_get_post_meta(  get_the_ID() ,'angebot_details' );

	if($data) {
		
		echo '<section class="grid-container grid-x section-padding details-section">';
		echo '<div class="site-main medium-8 cell">';
		echo apply_filters( 'the_content', $data );
		echo '</div>';
		echo '</section>';
	}
}