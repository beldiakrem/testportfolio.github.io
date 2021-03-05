<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo richard_add_html_class(); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<link rel="profile" href="//gmpg.org/xfn/11" />
	<meta name="theme-color" content="<?php echo esc_attr( richard_get_theme_mod( 'mobile_status_bar_color' ) ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php

richard_body_open();

do_action( 'richard/before_site_wrapper' );

// Elementor `header` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	get_template_part( 'template-parts/header/header' );
}