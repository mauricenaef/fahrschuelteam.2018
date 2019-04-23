<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Google Maps API
add_filter( 'carbon_fields_map_field_api_key', 'crb_get_gmaps_api_key' );
function crb_get_gmaps_api_key( $current_key ) {
    return 'AIzaSyCJXE0grOpWMCAS33OFTGdomUx-IiHm8vs';
}

// Home / Front Page Fields
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_front_page' );
function custom_carbon_fields_front_page() {
    Container::make( 'post_meta', 'Seiten Meta' )
    ->where( 'post_id', '=', get_option( 'page_on_front' ) )
    ->add_fields( array(
        Field::make( 'text', 'home_video_url', 'Intro Video URL' ),
        Field::make( 'image', 'home_intro_icon', 'Bild / Icon' ),
        Field::make( 'media_gallery', 'home_gallery', 'Bilder Galerie' )
        ->set_type( array( 'image' ) )
        ->set_duplicates_allowed( false ),
    ));
}

// About Page Fields
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_about_page' );
function custom_carbon_fields_about_page() {
    Container::make( 'post_meta', 'Seiten Meta' )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'page-ueber-uns.php' )
    ->add_fields( array(
        Field::make( 'text', 'home_video_url', 'Intro Video URL' ),
        Field::make( 'image', 'home_intro_icon', 'Bild / Icon' ),
        Field::make( 'media_gallery', 'home_gallery', 'Haupt Galerie' ),
        Field::make( 'complex', 'about_sections', 'Sektionen' )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'select', 'layout', 'Layout' )
                ->add_options( array(
                    'left' => 'Links',
                    'right' => 'Rechts',
                ) ),
                Field::make( 'image', 'icon', 'Bild / Icon' ),
                Field::make( 'text', 'title', 'Titel' ),
                Field::make( 'rich_text', 'content', 'Inhalt' ),
                Field::make( 'media_gallery', 'gallery', 'Galerie' ),
                Field::make( 'text', 'video_url', 'Video URL' ),
                Field::make( 'image', 'video_thumbnail', 'Video Thumbnail' ),
            )),
    ));
}

// Angebote Fields
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_angebot' );
function custom_carbon_fields_angebot() {
    Container::make( 'post_meta', 'Angebot Daten' )
    ->where( 'post_type', '=', 'angebot' )
    ->add_fields( array(
        Field::make( 'complex', 'angebot_packages', 'Packages für dieses Angebot' )
                ->set_layout( 'tabbed-horizontal' )
                ->add_fields( array(
                    Field::make( 'text', 'title', 'Name des Packages' ),
                    Field::make( 'rich_text', 'content', 'Inhalt' ),
                    Field::make( 'text', 'price', 'Preis' )
                    ->set_help_text( 'Preis ohne CHF' ),
                    Field::make( 'text', 'sub_price', 'Info unter dem Preis' ),
                    Field::make( 'gravity_form', 'formular', 'Wähle ein Formular' ),
                ) ),
        Field::make( 'text', 'angebot_kurs', 'Kurs Formular Kürzel' )
        ->set_help_text( 'Gib die ersten 2 Buchstaben an um entsprechende Kurse anzuzeigen.' ),
        Field::make( 'text', 'angebot_video_url', 'Video URL' )
        ->set_help_text( 'Youtube oder Vimeo Video URL für den Intro Film.' ),
        Field::make( 'image', 'video_thumbnail', 'Thumbnail Video' ),
        Field::make( 'media_gallery', 'angebot_gallery' )
        ->set_type( array( 'image' ) )
        ->set_duplicates_allowed( false ),
        Field::make( 'rich_text', 'angebot_details', 'Details' ),
    ));
}

// Rearange Angebote Columns
Carbon_Admin_Columns_Manager::modify_columns('post', array('angebot') )
    ->remove( array('date') )
    ->sort( array('cb', 'crb-thumbnail-column') )
    ->add( array(
        Carbon_Admin_Column::create('Bild')
           ->set_name( 'crb-thumbnail-column' )
           ->set_callback('crb_column_thumbnail')
           ->set_width( '80px' ),
		Carbon_Admin_Column::create('Package')
           ->set_callback('angebot_has_package'),
        Carbon_Admin_Column::create('Kurse')
           ->set_callback('angebot_has_kurs'),
        
));

function angebot_has_package() {
    $has_package = carbon_get_the_post_meta('angebot_packages');
    if ($has_package) {
        $has_package = '<span class="check">yes</span>';
        return $has_package;
    } 
}

function angebot_has_kurs() {
    $has_kurs = carbon_get_the_post_meta('angebot_kurs');
    if ($has_kurs) {
        $has_kurs = '<span class="check">yes</span>';
        return $has_kurs;
    } 
}

function crb_column_thumbnail( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, 'thumbnail' );
	}
}
