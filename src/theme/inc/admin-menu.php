<?php

#------------------------------------------------------------------------------------
# Custom Menu Add Search Icon
#------------------------------------------------------------------------------------

add_filter('wp_nav_menu_1-hauptmenu_items', 'add_search_to_nav', 10, 2);
function add_search_to_nav($items, $args){

		$search_icon = '<li class="menu-item"><a href="">' . get_svg_icon('search') . '</a></li>';

    	$search = '<li class="menu-item hide-for-small">
    				<a href="javascript:void(0)" class="search-trigger tcon tcon-search--xcross" aria-label="toggle search">
    				<span class="tcon-search__item" aria-hidden="true"></span>
    				<span class="tcon-visuallyhidden">toggle search</span>
    				</a></li>';

		$newitems = $items . $search_icon;	
		
    	return $newitems;
}

#------------------------------------------------------------------------------------
# Call us Section
#------------------------------------------------------------------------------------

function get_call_us() {

    $data =  carbon_get_theme_option( 'home_fahrlehrer' );

    if ($data) {

        foreach ($data as $fahrlehrer) {
			$image_id = $fahrlehrer['avatar'];
            $phone = preg_replace("/[^0-9]/","", $fahrlehrer['telefon']);
			$phone_number = preg_replace('/0/', '', $phone, 1);
			$link = esc_url( get_permalink( $fahrlehrer['link'][0]['id'] ));
            ?>
            <div class="call-us">
				<?php echo wp_get_attachment_image( $image_id, 'thumbnail', "", array( "class" => "call-us-avatar avatar" )  ); ?>
				<div>
					<h4 class="call-us-name"><a href="<?php echo $link; ?>"><?php echo $fahrlehrer['name']; ?></a></h4>
		        	<a href="tel:+41<?php echo $phone_number; ?>" class="call-us-phone"><?php echo $fahrlehrer['telefon']; ?></a>
				</div>
			</div>
            <?php
        }

    }

}