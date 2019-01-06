<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fahrschuelteam
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area medium-3 medium-offset-1 cell">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
