<?php

/**
 * Error reporting [Forced]
 */
#ini_set('display_errors', 1);
#error_reporting(E_ALL);

/**
 * Constants
 */
require( get_template_directory() . '/inc/constants.php' );

/**
 * Custom post types
 */
require( get_template_directory() . '/inc/custom-post-people.php' );

/**
 * Theme setup
 * 
 * * These are placed after setting up custom post typess
 * * because most of them requires function calls after 
 * * CPT setup
 */
require( get_template_directory() . '/inc/theme-setup-helpers.php' );
require( get_template_directory() . '/inc/theme-setup.php' );
require( get_template_directory() . '/inc/theme-setup-scripts.php' );
require( get_template_directory() . '/inc/theme-setup-menus.php' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Translations [WPML]
 */
//require( get_template_directory() . '/inc/wpml-setup.php' );

/**
 * ACF
 */
//require( get_template_directory() . '/inc/acf-setup.php' );

