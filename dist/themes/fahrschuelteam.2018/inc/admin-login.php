<?php

#------------------------------------------------------------------------------------
# Load Login Style
#------------------------------------------------------------------------------------

// load css into the login page
function mytheme_enqueue_login_style() {
    wp_enqueue_style( 'mytheme-options-style', get_template_directory_uri() . '/inc/style/login.css' ); 
}
add_action( 'login_enqueue_scripts', 'mytheme_enqueue_login_style' );


#------------------------------------------------------------------------------------
# Logo URL
#------------------------------------------------------------------------------------

function change_login_page_url( $url ) {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'change_login_page_url' );

#------------------------------------------------------------------------------------
# Set Remember me to always true
#------------------------------------------------------------------------------------

function login_checked_remember_me() {
	add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
	echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

#------------------------------------------------------------------------------------
# Change redirect URL
#------------------------------------------------------------------------------------

function admin_login_redirect( $redirect_to, $request, $user ) {
	global $user;
	
	if( isset( $user->roles ) && is_array( $user->roles ) ) {
		if( in_array( "administrator", $user->roles ) ) {
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter('login_redirect', 'admin_login_redirect', 10, 3);