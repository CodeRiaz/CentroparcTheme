<?php

/**
 * PreScouter functions and definitions
 *
 * The short keyword "cp" is used as prefix to function names to make them unique.
 *
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function cp_setup()
{

	/* Let WordPress manage the document title. */
	add_theme_support('title-tag');

	/* Allow featured image */
	add_theme_support('post-thumbnails');

	/* Add default posts and comments RSS feed links to head */
	add_theme_support('automatic-feed-links');

	/* Allow HTML5 markup */
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

	/* Register Navigation Menus */
	register_nav_menus(array(
		'header' => __('Header', 'cp')
	));

	/* Custom image sizes */
	add_image_size('thumbnail-858x732', 858, 732, true);
	add_image_size('thumbnail-628x898', 628, 898, true);
	add_image_size('thumbnail-631x640', 631, 640, true);
	add_image_size('thumbnail-583x898', 583, 898, true);
}
add_action('after_setup_theme', 'cp_setup');

/**
 * Enqueue scripts and styles
 */
function cp_assets()
{
	$theme_version = wp_get_theme()->get('Version');

	/* Google Fonts */
	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700|Open+Sans:400,600,700');

	/* Theme stylesheet */
	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version);

	/* Load jQuery in footer */
// 	wp_deregister_script('jquery');
// 	wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, null, true);
// 	wp_enqueue_script('jquery');

    /* Odometer */
	// wp_enqueue_script('odometer', get_template_directory_uri() . '/assets/js/odometer.min.js', false, null, true);

    /* Magnific popup */
	wp_enqueue_script('magnific', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array('jquery'), null, true);

	/* Theme JS */
    wp_enqueue_script('theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery', 'magnific'), $theme_version, true);

    /* Google Maps */
	wp_enqueue_script('maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBkEk-cL74u1FvvcwMAXEbERx7rZjYKQQ8&callback=initMap', array('theme'), null, true);
}
add_action('wp_enqueue_scripts', 'cp_assets', 20);

/**
 * Removes bloat
 * Meta tags, styles, scripts
 */
function cp_remove_bloat()
{

	/* Remove emoji support */
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');

	/* Removes Emoji support from TinyMCE */
	add_filter('tiny_mce_plugins', 'cp_disable_emoji_tinymce');

	/* Other junk */
	remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
	remove_action('wp_head', 'wp_generator'); // remove wordpress version

	remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

	remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('template_redirect', 'rest_output_link_header', 11);
}
add_action('init', 'cp_remove_bloat');

/**
 * Removes Emoji support form TinyMCE
 *
 * @param  array $plugins Loaded plugins
 * @return array          Plugins list, wpemjoi removeod
 */
function cp_disable_emoji_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

/**
 * ACF theme options pages
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));
}

/**
 * Custom template tags and layout/styling helpers
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Cusotm post type definions
 */
require get_parent_theme_file_path('/inc/custom-post-types/init.php');

/**
 * Theme shortcodes
 */
add_action('template_redirect', function () {
	if (get_page_template_slug(get_the_ID()) == 'page-templates/page-old-print.php') {
		require get_parent_theme_file_path('/inc/shortcodes.php');
	}
});

/**
 * Changes ACF JSON directory
 *
 * @param  string $path Default ACF JSON direcotry
 * @return string
 */
function cp_acf_json_save_point($path)
{
	return get_stylesheet_directory() . '/inc/acf-json';
}
add_filter('acf/settings/save_json', 'cp_acf_json_save_point');

/**
 * Loads ACF JSON
 *
 * @param array $paths ACF JSON directory paths
 * @return array
 */
function cp_acf_json_load_point($paths)
{

	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/inc/acf-json';;

	return $paths;
}
add_filter('acf/settings/load_json', 'cp_acf_json_load_point');

/**
 * Enqueue admin specific styles
 */
function cp_admin_styles()
{
	// wp_enqueue_style('cp-admin-styles', get_template_directory_uri() . '/assets/css/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'cp_admin_styles');

/**
 * Check if ACF Flexible Content has FAQ Block
 *
 * @param int $post_id Post ID to check FAQ Block in
 * @return boolean
 */
function cp_fc_has_layout($layout = '', $fields = array(), $post_id = 0)
{

	if (!is_array($fields) || !count($fields)) {
		return false;
	}

	if (!$post_id) {
		$post_id = get_the_ID();
	}

	foreach ($fields as $field) {
		$field_data = get_field($field, $post_id);

		if ($field_data && array_search($layout, array_column($field_data, 'acf_fc_layout')) !== false) {
			return true;
		}
	}

	return false;
}

/**
 * Disable srcset output
 */
add_filter('max_srcset_image_width', function () {
	return 1;
});

function cp_excerpt_length($length)
{
	return 28;
}
add_filter('excerpt_length', 'cp_excerpt_length', 999);

function cp_excerpt_more($more)
{
	return '...';
}
add_filter('excerpt_more', 'cp_excerpt_more');

function cp_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cp_mime_types');

// Remove width and height attributes from wp_get_attachment_image
add_filter( 'wp_constrain_dimensions', '__return_empty_array' );

add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    return $content;
});