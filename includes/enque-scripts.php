<?php
/**
 * Enqueue scripts and styles here
 *
 * @return void
 */
function wp_theme_scripts()
{
    wp_enqueue_style('wp_theme-main-style', get_template_directory_uri() . '/source/build/' . resolve_source_build_filename('app-*.css'), array());
    wp_enqueue_script('wp_theme-main-script', get_template_directory_uri() . '/source/build/' . resolve_source_build_filename('app-*.js'), array(), null, true);
}

add_action('wp_enqueue_scripts', 'wp_theme_scripts', 101);