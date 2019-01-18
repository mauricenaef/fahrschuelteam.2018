<?php
#------------------------------------------------------------------------------------
# Custom Partner Logos List
#------------------------------------------------------------------------------------

function fahrschuelteam_sponsoren() {
	
	$data = carbon_get_theme_option( 'home_sponsoren' );

	if ($data) {
		echo '<section class="sponsoren-section">';
			echo '<div class="grid-container">';
			echo '<h6 class="sponsoren-intro-title">Unsere Sponsoren</h6>';
			echo '<ul class="sponsoren-list no-bullet align-middle grid-x grid-padding-x small-up-2 medium-up-4 large-up-6">';
		
				foreach ($data as $entry) {
					
					$url = $entry['url'];
					$logo = $entry['logo'];
					$image_url = wp_get_attachment_image_url( $logo, 'full' );

					if ($logo) {
					
						echo '<li class="sponsoren-list-item cell">';
	
						echo '<a href="' . $url . '" target="_blank" rel="noreferrer" class="sponsoren-link" title="Logo"><img src="' . $image_url . '" class="sponsoren-logo" alt="Logo von '. parse_url($url) .'" /></a>';
	
						echo '</li>';
	
					}
	
				}
			echo '</ul>';
			echo '</div>';
		echo '</section>';
	}
}