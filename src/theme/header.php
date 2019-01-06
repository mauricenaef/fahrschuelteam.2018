<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fahrschuelteam
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">	
	<meta name="author" content="MAURICE NAEF webdesign" />
	<meta name="Copyright" content="Copyright <?php echo date('Y') ?>, alle Rechte vorbehalten | Konzept, Design und Umsetzung von MAURICE NAEF webdesign, https://mauricenaef.ch" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('site'); ?>>
	<div class="wrap">
	<a class="skip-link show-for-sr" href="#content"><?php esc_html_e( 'Skip to content', 'fahrschuelteam' ); ?></a>

	<header class="site-header" role="banner">
		<div class="grid-container grid-x grid-padding-x grid-padding-y align-bottom">
			<div class="site-branding small-4 cell">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
					<img src="<?php bloginfo('template_url'); ?>/images/logo.svg" alt="<?php bloginfo( 'name' ); ?>">
				</a>
			</div><!-- .site-branding -->
			<div class="auto cell header-nav">
				<?php get_call_us(); ?>
			</div>
		</div>
	</header>
	<div id="content" class="site-content">