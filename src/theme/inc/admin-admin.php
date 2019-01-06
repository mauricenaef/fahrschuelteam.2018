<?php

#------------------------------------------------------------------------------------
# Custom Branding
#------------------------------------------------------------------------------------

function mauricenaef_admin_head() {
	echo '<style>
	#wphead-info  {
		margin: 0 !important
	}
	#footer-left {
		display:table;
	}
	#createdby {
		display: table-cell;
		vertical-align: middle;
	}
	#createdby a {
		margin-left: 1em;
	}
	.credits:hover {opacity: .7}
	</style>';
	echo '<link rel="icon" href="'.get_bloginfo('template_directory').'/favicon.ico" type="image/x-icon">';

}
add_action('admin_head', 'mauricenaef_admin_head');

function remove_footer_admin () {
	echo '<span id="createdby"><a href="https://mauricenaef.ch" class="credits" title="Webdesign by mauricenaef.ch" target="_blank"><img class="m" style="background-color:transparent" src="https://mauricenaef.ch/externaldata/credits_light.png" title="Web Design by mauricenaef.ch" alt="Webdesign by mauricenaef.ch" /></a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

#------------------------------------------------------------------------------------
# function remove default menu
#------------------------------------------------------------------------------------
function custom_remove_admin_bar_wp_menu() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'custom_remove_admin_bar_wp_menu' );

function custom_add_admin_bar_wp_menu() {
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'id'    => 'my-logo',
		'title' => '<span class="ab-icon"><svg version="1.1" id="Maurice_Naef_logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
			 y="0px" viewBox="0 0 61.5 61.6" enable-background="new 0 0 61.5 61.6" xml:space="preserve" style="width: 20px; height: 20px;">
		<g id="Content">
			<g id="Brandmark">
				<g>
					<path fill="#4C3E1A" d="M52,54c-0.5,0-1-0.2-1.4-0.6L8.1,11c-0.8-0.8-0.8-2.1,0-2.8c0.8-0.8,2-0.8,2.8,0l42.4,42.5
						c0.8,0.8,0.8,2.1,0,2.8C53,53.8,52.5,54,52,54z"/>
				</g>
				<g>
					<path fill="#E4BE00" d="M30.8,54c-0.3,0-0.6-0.1-0.9-0.2c-1-0.5-1.4-1.7-0.9-2.7L50.2,8.7c0.5-1,1.7-1.4,2.7-0.9
						c1,0.5,1.4,1.7,0.9,2.7L32.5,52.9C32.2,53.6,31.5,54,30.8,54z"/>
				</g>
				<g>
					<g>
						<path fill="#61966A" d="M30.8,54c-0.7,0-1.4-0.4-1.8-1.1L7.8,10.5c-0.5-1-0.1-2.2,0.9-2.7c1-0.5,2.2-0.1,2.7,0.9l21.2,42.5
							c0.5,1,0.1,2.2-0.9,2.7C31.4,54,31.1,54,30.8,54z"/>
					</g>
				</g>
				<g>
					<g>
						<path fill="#5EB6D5" d="M9.6,54c-1.1,0-2-0.9-2-2V9.6c0-1.1,0.9-2,2-2c1.1,0,2,0.9,2,2V52C11.6,53.1,10.7,54,9.6,54z"/>
					</g>
				</g>
				<g>
					<path fill="#C63B33" d="M52,54c-1.1,0-2-0.9-2-2V9.6c0-1.1,0.9-2,2-2c1.1,0,2,0.9,2,2V52C54,53.1,53.1,54,52,54z"/>
				</g>
			</g>
		</g>
		</svg></span>',
		'href'  => admin_url( 'about.php' ),
		'meta'  => array(
			'title' => __('Info'),
			'class' => 'wp-admin-bar-logo',
		),
	) );
	// Add Portfolio Link
	$wp_admin_bar->add_menu( array(
		'parent' => 'my-logo',
		'id'     => 'portfolio',
		'title'  => __('MAURICE NAEF webdesigner'),
		'href'   => 'https://mauricenaef.ch',
	) );
	// Teamviewer
	$wp_admin_bar->add_menu( array(
		'parent' => 'my-logo',
		'id'	=> 'teamviewer',
		'title' => __('Teamviewer'),
		'href'	=> 'http://www.teamviewer.com/de/',	
	));
}
add_action( 'admin_bar_menu', 'custom_add_admin_bar_wp_menu', 10 );

#------------------------------------------------------------------------------------
# Remove admin bar for logged in users on front end
#------------------------------------------------------------------------------------

add_filter('show_admin_bar', '__return_false'); 


#------------------------------------------------------------------------------------
# Remove some unused links from Menu / Kommentare
#------------------------------------------------------------------------------------

//remove menu item
add_action( 'admin_menu', 'geburtschaft_remove_menus', 999 );
function geburtschaft_remove_menus() {

	remove_menu_page( 'link-manager.php' );
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' );
	
	if (!current_user_can('edit_users')) {
		remove_menu_page( 'tools.php' );
	}

}

#------------------------------------------------------------------------------------
# Change Post Type Post Label
#------------------------------------------------------------------------------------

function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	$submenu['edit.php'][10][0] = 'add a new News';
	echo '';
}
function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'add new News';
	$labels->add_new_item = 'add News';
	$labels->edit_item = 'edit News';
	$labels->new_item = 'News';
	$labels->view_item = 'view News';
	$labels->search_items = 'search News';
	$labels->not_found = 'no News item found';
	$labels->not_found_in_trash = 'no News in Trash';
}
//add_action( 'init', 'change_post_object_label' );
//add_action( 'admin_menu', 'change_post_menu_label' );


