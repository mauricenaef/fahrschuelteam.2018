<?php

#------------------------------------------------------------------------------------
# Formulare für die angebotkurse
#------------------------------------------------------------------------------------

function angebot_forms( $type ) {

	$has_kurs = carbon_get_the_post_meta('angebot_kurs');
	$forms = RGFormsModel::get_forms();
    
	if ($forms && $has_kurs) {
		
        ?>
        <section class="section-padding bg-light">
		<div class="angebot-liste-wrap grid-container section-padding">	
            <h3>Buche direkt unsere Angebote</h3>			
			<ul class="angebot-liste no-bullet">
                <li class="grid-x medium-8 align-justify align-middle liste-title">
                    <div class="small-3 medium-3 cell"><strong>Kurs</strong></div>
                    <div class="small-8 medium-3 cell"><strong>Datum</strong></div>
                    <div class="small-12 medium-5 cell"><strong>Plätze</strong></div>
                </li>
		<?php

		

		foreach($forms as $form){

				$form_id = $form->id;
				$title = $form->title; 											// VKU 0000
				$status = $form->is_active;										// Status
				$time = custom_form_meta( $form_id, 'tf_form_time' ); 			// day
				$online = custom_form_meta( $form_id, 'tf_form_type' ); 		// online
				$subtitle = custom_form_meta( $form_id, 'tf_form_subtitle' );	// Di - Fr, 8. - 11. September 2015
				$entries = entries_left($form_id); 								// Number
				$plaetze = ($entries == '1') ? 'Platz' : 'Plätze';				// Plätze

			if (substr($title, 0, 2) === $type && $status == '1' ) {


				?>
				<li class="grid-x medium-8 align-justify align-middle <?php echo ($entries == '0') ? 'fullybooked' : '' ; ?>">
					<div class="small-3 medium-3 cell">
						<div class="item-title"><?php echo $title; ?></div>
					</div>
					
					<div class="small-8 medium-3 cell">
						<div class="item-description"><?php echo $subtitle; ?></div>
					</div>
					<div class="small-6 medium-2 cell">
						<div class="item-remaining"><?php echo $entries . ' ' . $plaetze;  ?></div>
					</div>
					<div class="small-6 medium-3 cell text-right">
					<?php 
						if ($entries == '0') {
							echo '<a href="" class="button small expanded disabled">Ausgebucht</a>';
						} else {
							echo '<a href="' . esc_url( add_query_arg( array( 'form' => $form_id, 'date' => $subtitle ) , get_permalink( get_page_by_title( 'Anmeldung' ) ) ) ) .'" class="button">Anmelden</a>';
						}
					?>
						
					</div>
				</li>
				<?php			
			} 
		}
		if (substr($title, 0, 3) === $type && $status == '0' ) {
			echo '<li class="row collapse vku-liste-item"><div class="small-12 columns"><h3 class="item-title">//Momentan Leider keine Kurse</h3></div></li>';
		}
		?>
			</ul>
        </div>
        </section>
		<?php
	}

	//return ob_get_clean();

}




#------------------------------------------------------------------------------------
# Entries Left
#------------------------------------------------------------------------------------

function entries_left( $form_id ) {
	
	$format = NULL;

	if( ! $form_id )
		return '';

	$form = RGFormsModel::get_form_meta( $form_id );

	if( ! rgar( $form, 'limitEntries' ) || ! rgar( $form, 'limitEntriesCount' ) )
	        return '';

	$entry_count = GFAPI::count_entries( $form['id'] );
	$entries_left = rgar( $form, 'limitEntriesCount' ) - $entry_count;
	$output = $entries_left;
	
	if( $format ) {
	    $format = $format == 'decimal' ? '.' : ',';
	    $output = number_format( $entries_left, 0, false, $format );
	}
	
	return $entries_left > 0 ? $output : 0;


}

#------------------------------------------------------------------------------------
# Get Form Title
#------------------------------------------------------------------------------------

function custom_form_title( $form_id ) {
	
	if( ! $form_id )
		return ''; 

	$forms = RGFormsModel::get_forms();

	foreach($forms as $form){

		
		$title = $form->title;

		if ($form_id == $form->id) {
			echo $title;
		}


	}
}

#------------------------------------------------------------------------------------
# Get Custom Form Meta
#------------------------------------------------------------------------------------

function custom_form_meta( $form_id, $meta ) {  

	if( ! $form_id )
		return ''; 

	$form = RGFormsModel::get_form_meta($form_id);

	if( ! rgar( $form, $meta ))
	    return '';


	$form_meta = $form[ $meta ];

    return $form_meta != '' ? $form_meta : '';
}

#------------------------------------------------------------------------------------
# Custom Form Settings Form Subtitle
#------------------------------------------------------------------------------------

add_filter( 'gform_form_settings', 'thomys_form_subtitle', 10, 2 );
function thomys_form_subtitle( $settings , $form ) {
    
	$custom_settings = '
        <tr>
            <th><label for="tf_form_subtitle">Kurs Datum</label></th>
            <td><input value="' . rgar($form, 'tf_form_subtitle') . '" name="tf_form_subtitle" class="fieldwidth-3"></td>
        </tr>';

    $settings['angebot Einstellungen']['tf_form_subtitle'] = $custom_settings ;

    return $settings;

}

// save your custom form setting
add_filter( 'gform_pre_form_settings_save', 'save_thomys_form_subtitle' );
function save_thomys_form_subtitle($form) {

    $form['tf_form_subtitle'] = rgpost( 'tf_form_subtitle' );

    return $form;

}


#------------------------------------------------------------------------------------
# Custom Form Merge Tags
#------------------------------------------------------------------------------------
add_action("gform_admin_pre_render", "add_merge_tags");
function add_merge_tags($form) { ?>
    <script type="text/javascript">
    gform.addFilter('gform_merge_tags', 'add_merge_tags');

    function add_merge_tags(mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option) {
        mergeTags["custom"].tags.push({
            tag: '{Site_Name}',
            label: 'Site Name'
        });
        return mergeTags;
	} </script> 
	<?php
    //return the form object from the php hook  
    return $form;
}

add_filter('gform_replace_merge_tags', 'replace_site_name', 10, 7);
function replace_site_name($text, $form, $entry, $url_encode, $esc_html, $nl2br, $format) {
    $custom_merge_tag = '{Site_Name}';
    if (strpos($text, $custom_merge_tag) === false) {
        return $text;
    }
    $siteName = get_bloginfo('name');
    $text = str_replace($custom_merge_tag, $siteName, $text);
    return $text;
}