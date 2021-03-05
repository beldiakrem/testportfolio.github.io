<?php

/**
 * @author: PaulThemes
 * @version: 1.0
 */

define( 'RICHARD_THEME_DIRECTORY', trailingslashit( get_template_directory_uri() ) );
define( 'RICHARD_REQUIRE_DIRECTORY', trailingslashit( get_template_directory() ) );
define( 'RICHARD_DEVELOPMENT', false );

/**
 * After setup theme
 */
if ( ! function_exists( 'richard_setup' ) ) {
	function richard_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ducky, use a find and replace
		 * to change 'richard' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'richard', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1920, 9999 );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array(
			'gallery',
			'link',
			'quote',
			'video',
			'audio'
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		add_theme_support( 'dark-editor-style' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => esc_html__( 'Small', 'richard' ),
					'shortName' => esc_html__( 'S', 'richard' ),
					'size' => 12,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__( 'Normal', 'richard' ),
					'shortName' => esc_html__( 'M', 'richard' ),
					'size' => 14,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__( 'Large', 'richard' ),
					'shortName' => esc_html__( 'L', 'richard' ),
					'size' => 28,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__( 'Huge', 'richard' ),
					'shortName' => esc_html__( 'XL', 'richard' ),
					'size' => 38,
					'slug' => 'huge',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// register nav menus
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'richard' ),
			'onepage-menu' => esc_html__( 'Onepage Menu', 'richard' ),
		) );

		// 800x600
		add_image_size( 'richard-800x600_crop', 800, 600, true );
		add_image_size( 'richard-800x600', 800 );

		// 1040
		add_image_size( 'richard-1280x1040_crop', 1280, 1040, true );
		add_image_size( 'richard-1280x1040', 1280 );

		// 1920x1080
		add_image_size( 'richard-1920x1080_crop', 1920, 1080, true );
		add_image_size( 'richard-1920x1080', 1920 );

		// 1920x960
		add_image_size( 'richard-1920x960_crop', 1920, 960, true );

	}
}
add_action( 'after_setup_theme', 'richard_setup' );

/**
 * Content width
 */
if ( ! function_exists( 'richard_content_width' ) ) {
	function richard_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'richard/content_width', 1140 );
	}
}
add_action( 'after_setup_theme', 'richard_content_width', 0 );

/**
 * Import ACF fields
 */
if ( ! RICHARD_DEVELOPMENT ) {
	function richard_acf_show_admin_panel() {
		return apply_filters( 'richard/acf_show_admin_panel', false );
	}
	add_filter( 'acf/settings/show_admin', 'richard_acf_show_admin_panel' );
}

if ( ! RICHARD_DEVELOPMENT ) {
	require_once RICHARD_REQUIRE_DIRECTORY . 'inc/helper/custom-fields/custom-fields.php';
}

if ( ! function_exists( 'richard_acf_save_json' ) ) {
	function richard_acf_save_json( $path ) {
		$path = RICHARD_REQUIRE_DIRECTORY . 'inc/helper/custom-fields';
		return $path;
	}
}
add_filter( 'acf/settings/save_json', 'richard_acf_save_json' );

if ( RICHARD_DEVELOPMENT ) {
	if ( ! function_exists( 'richard_acf_load_json' ) ) {
		function richard_acf_load_json( $paths ) {
			unset( $paths[0] );
			$paths[] = RICHARD_REQUIRE_DIRECTORY . 'inc/helper/custom-fields';
			return $paths;
		}
	}
	add_filter( 'acf/settings/load_json', 'richard_acf_load_json' );
}

/**
 * Include Kirki fields
 */
require_once RICHARD_REQUIRE_DIRECTORY . 'inc/framework/customizer-helper.php';
require_once RICHARD_REQUIRE_DIRECTORY . 'inc/framework/customizer.php';

/**
 * Required files
 */
$richard_theme_includes = array(
	'required-plugins',
	'enqueue',
	'includes',
	'functions',
	'actions',
	'filters',
	'menus',
);

foreach ( $richard_theme_includes as $file ) {
	require_once RICHARD_REQUIRE_DIRECTORY . 'inc/theme-' . $file . '.php';
}

// Unset the global variable.
unset( $richard_theme_includes );