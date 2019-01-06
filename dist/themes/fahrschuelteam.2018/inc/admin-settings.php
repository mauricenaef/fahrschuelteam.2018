<?php
// Carbon Copy Settings Page

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Default options page
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_settings' );
function custom_carbon_fields_settings() {

    $basic_options_container = Container::make( 'theme_options', 'Basic Options' )
        ->set_icon( 'dashicons-carrot' )
        ->set_page_menu_title( 'Front Page' )
        ->set_page_menu_position( 80 )
        ->add_fields( array(
            Field::make( 'separator', 'home_0', 'Fahrlehrer' ),
            Field::make( 'complex', 'home_fahrlehrer', 'Fahrlehrer für die Kopfzeile' )
                ->add_fields( array(
                    Field::make( 'text', 'name', 'Name' ),
                    Field::make( 'association', 'link', 'Link (Seite)' )
                        ->set_max( 1 )
                        ->set_types( array(
                            array(
                                'type' => 'post',
                                'post_type' => 'page',
                            )
                        ) ),
                    Field::make( 'image', 'avatar', 'Bild' ),
                    Field::make( 'text', 'telefon', 'Telefon' ),
                ) ),
            Field::make( 'separator', 'home_1', 'Packages' ),
            Field::make( 'association', 'home_angebot_package', 'Packages für die Front Seite' )
                ->set_max( 5 )
                ->set_types( array(
                    array(
                        'type' => 'post',
                        'post_type' => 'angebot',
                    )
                ) ),
            Field::make( 'association', 'navigation_angebot_package', 'Packages für die Navigation' )
                ->set_max( 1 )
                ->set_types( array(
                    array(
                        'type' => 'post',
                        'post_type' => 'angebot',
                    )
                ) ),
            Field::make( 'separator', 'home_2', 'Angebote' ),
            Field::make( 'text', 'home_angebote_title', 'Angebot Titel' ),
            Field::make( 'rich_text', 'home_angebote_content', 'Angebot Inhalt' ),
            Field::make( 'separator', 'home_3', 'Sponsoren' ),
            Field::make( 'complex', 'home_sponsoren', 'Sponsoren für die Home Seite' )
                ->set_layout( 'tabbed-horizontal' )
                ->add_fields( array(
                    Field::make( 'text', 'url', 'URL des Sponsors' ),
                    Field::make( 'image', 'logo', 'Logo des Sponsors' )
                ) ),
            Field::make( 'separator', 'home_4', 'Testimonial' ),
            Field::make( 'text', 'home_testimonial_title', 'Testimonial Titel' ),
            Field::make( 'rich_text', 'home_testimonial_content', 'Testimonial Inhalt' ),
            Field::make( 'separator', 'home_5', 'FAQ' ),
            Field::make( 'text', 'home_faq_title', 'FAQ Titel' ),
            Field::make( 'rich_text', 'home_faq_content', 'FAQ Inhalt' ),
            Field::make( 'separator', 'home_6', 'Bestätigung (Paket)' ),
            Field::make( 'rich_text', 'bestaetigung_intro', 'Einleitung Bestätigung' ),
            Field::make( 'rich_text', 'bestaetigung_outro', 'Ausleitung Bestätigung' ),
            Field::make( 'rich_text', 'bank_patric', 'Bankangaben Patric' ),
            Field::make( 'rich_text', 'bank_thomas', 'Bankangaben Thomas' ),
            Field::make( 'rich_text', 'bank_gemeinschaft', 'Bankangaben Gemeinschaft' ),

        ) );

    // Add second options page under 'Basic Options'
/*     Container::make( 'theme_options', 'Navigation' )
        ->set_page_parent( $basic_options_container ) // reference to a top level container
        ->add_fields( array(
            
        ) ); */
}