<?php
#------------------------------------------------------------------------------------
# Disable unwanted Dashboard Widgets
#------------------------------------------------------------------------------------
function disable_default_dashboard_widgets() {
//	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
//	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	
//	remove_meta_box('woocommerce_dashboard_recent_reviews', 'dashboard', 'core');
	
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

// Add some CSS to Style the list
function dashboard_print_styles() {

	wp_register_style( 'admin_styles', get_template_directory_uri() .'/inc/style/admin.css');
	
 	wp_enqueue_style('admin_styles');
}
add_action( 'admin_print_styles', 'dashboard_print_styles' );
#------------------------------------------------------------------------------------
# Custom Support Dashboard Widget
#------------------------------------------------------------------------------------

if (current_user_can('edit_posts')) :
	add_action('wp_dashboard_setup', 'support_add_dashboard_widgets' );
endif;

function support_add_dashboard_widgets() {
	wp_add_dashboard_widget('support_dashboard_widget', 'Webseiten Admin', 'custom_admin_support');
	global $wp_meta_boxes;

	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	
	$example_widget_backup = array('support_dashboard_widget' => $normal_dashboard['support_dashboard_widget']);
	unset($normal_dashboard['support_dashboard_widget']);

	$sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);

	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
} 

// Dashboard Function

function custom_admin_support() {
	global $wintivision, $current_user, $release_date, $days_to_add;	
	// Set timezone
	  //date_default_timezone_set("UTC");
	  setlocale(LC_TIME, "de_DE");
	  // Time format is UNIX timestamp or
	  // PHP strtotime compatible strings
	  function dateDiff($time1, $time2, $precision = 6) {
	    // If not numeric then convert texts to unix timestamps
	    if (!is_int($time1)) {
	      $time1 = strtotime($time1);
	    }
	    if (!is_int($time2)) {
	      $time2 = strtotime($time2);
	    }
	 
	    // If time1 is bigger than time2
	    // Then swap time1 and time2
	    if ($time1 > $time2) {
	      $ttime = $time1;
	      $time1 = $time2;
	      $time2 = $ttime;
	    }
	 
	    // Set up intervals and diffs arrays
	    $intervals = array('year','month','day','hour','minute','second');
	    $interval_names = array('year' => 'Jahr','years' => 'Jahre','month' => 'Monat','months' => 'Monate','day' => 'Tag','days' => 'Tage','hour' => 'Stunde','minute' => 'Min','second' => 'Sec');
	    $diffs = array();
	 
	    // Loop thru all intervals
	    foreach ($intervals as $interval) {
	      // Set default diff to 0
	      $diffs[$interval] = 0;
	      // Create temp time from time1 and interval
	      $ttime = strtotime("+1 " . $interval, $time1);
	      // Loop until temp time is smaller than time2
	      while ($time2 >= $ttime) {
		$time1 = $ttime;
		$diffs[$interval]++;
		// Create new temp time from time1 and interval
		$ttime = strtotime("+1 " . $interval, $time1);
	      }
	    }
	 
	    $count = 0;
	    $times = array();
	    // Loop thru all diffs
	    foreach ($diffs as $interval => $value) {
	      // Break if we have needed precission
	      if ($count >= $precision) {
		break;
	      }
	      // Add value and interval 
	      // if value is bigger than 0
	      if ($value > 0) {
		// Add s if value is not 1
		if ($value != 1) {
		  $interval .= "s";
		}
		// Add value and interval to times array
		$times[] = $value . " " . $interval_names[$interval];
		$count++;
	      }
	    }
	 
	    // Return string with times
	    return implode(", ", $times);
	  }
	
	$trans = array(
	    'Monday'    => 'Montag',
	    'Tuesday'   => 'Dienstag',
	    'Wednesday' => 'Mittwoch',
	    'Thursday'  => 'Donnerstag',
	    'Friday'    => 'Freitag',
	    'Saturday'  => 'Samstag',
	    'Sunday'    => 'Sonntag',
	    'Mon'       => 'Mo',
	    'Tue'       => 'Di',
	    'Wed'       => 'Mi',
	    'Thu'       => 'Do',
	    'Fri'       => 'Fr',
	    'Sat'       => 'Sa',
	    'Sun'       => 'So',
	    'January'   => 'Januar',
	    'February'  => 'Februar',
	    'March'     => 'März',
	    'May'       => 'Mai',
	    'June'      => 'Juni',
	    'July'      => 'Juli',
	    'October'   => 'Oktober',
	    'December'  => 'Dezember'
	);
		
		$today_date_calc = date('U');
		$today_date = date('Y-m-d');
		
		$start_date_calc = date('Y-m-d', strtotime($release_date));
		
		$end_date = strtotime(date("Y-m-d", strtotime($start_date_calc)) . " +".$days_to_add." days");
		$end_date_calc = date("Y-m-d", $end_date);
		
		$future_date_new = strtr(date("l, d. F Y",$end_date), $trans);
				
		echo '<h1>Hallo ' . $current_user->display_name .'</h1>
			<p>Willkommen zum '. $wintivision .' Admin Bereich!</p>';
			
		echo	"<ul>";
		if ( current_user_can( 'delete_pages' ) ) {		
			if ($end_date_calc > $today_date) {
			
			echo 	'<li><a href=""></a>Dein Web Support lauft am '. $future_date_new .' ab <strong>(noch '. dateDiff($today_date,$end_date_calc) .' Verbleiben)</strong>.</li>';
			} else {
			echo '<li>Dein Kostenloser Support ist abgelaufen</li>';
			}
		}
		
		echo '</ul>';
}

#------------------------------------------------------------------------------------
# Add Custom Post Type to Right Now Dashboard widget
#------------------------------------------------------------------------------------

add_action( 'dashboard_glance_items', 'cor_right_now_content_table_end' );
function cor_right_now_content_table_end() {
	$args = array(
	    'public' => true,
	    '_builtin' => false
	);
	$output = 'object';
	$operator = 'and';

	$post_types = get_post_types( $args, $output, $operator );
	foreach ( $post_types as $post_type ) {
	    $num_posts = wp_count_posts( $post_type->name );
	    $num = number_format_i18n( $num_posts->publish );
	    $text = _n( $post_type->labels->singular_name, $post_type->labels->name, intval( $num_posts->publish ) );
	    if ( current_user_can( 'edit_posts' ) ) {
	        $output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . '&nbsp;' . $text . '</a>';
	    }
	    echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
	}
	$taxonomies = get_taxonomies( $args, $output, $operator );
	foreach ( $taxonomies as $taxonomy ) {
	    $num_terms = wp_count_terms( $taxonomy->name );
	    $num = number_format_i18n( $num_terms );
	    $text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, intval( $num_terms ) );
	    if ( current_user_can( 'manage_categories' ) ) {
	        $output = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '">' . $num . '&nbsp;' . $text . '</a>';
	    }
	    echo '<li class="taxonomy-count ' . $taxonomy->name . '-count">' . $output . '</li>';
	}
}