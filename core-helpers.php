<?php
/**
 * Includes all files from folders passed in $args
 *
 * @param array $args List of folders to recursively include
 */
function require_all($args)
{
    $folders = func_get_args();

    foreach ($folders as $folder) {
        if (!!strpos($folder, ".")) {
            require_once (get_template_directory() . "/$folder");
            continue;
        }

        $files = glob(get_template_directory() . "/$folder/*.php");

        foreach ($files as $file) {
            require_once ($file);
        }
    }
}

/**
 * Resolves the build file name based on the given pattern
 *
 * @param string $pattern The pattern to match the build file name
 * @return string The resolved build file name
 */
function resolveBuildFileName($pattern)
{
    $directory = get_template_directory() . '/source/build/';
    $files = glob($directory . $pattern);
    return isset($files[0]) ? basename($files[0]) : '';
}

/**
 * Prints the variable in a formatted way and optionally terminates the script
 *
 * @param mixed $var The variable to be printed
 * @param bool $die Whether to terminate the script after printing the variable (default: true)
 * @return void
 */
function get_vd($var, $die = true)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($die) {
        die();
    }
}

/**
 * Retrieves the alternative text for an attachment
 *
 * @param int $id The attachment ID
 * @return string The alternative text for the attachment
 */
function get_attachment_alt($id)
{
    $wp_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    if (strlen($wp_alt) > 2) {
        return $wp_alt;
    } else {
        return get_the_title();
    }
}

/**
 * Retrieves the source URL of the custom logo
 *
 * @return string The source URL of the custom logo
 */
function get_custom_logo_src()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
    return $image[0];
}

/**
 * Retrieves the ID of the current page
 *
 * @return int The ID of the current page
 */
function get_current_post_ID()
{
    static $current_page_ID;

    global $post, $wp_query, $wpdb;

    if (!is_null($wp_query) && isset($wp_query->post) && isset($wp_query->post->ID) && !empty($wp_query->post->ID))
        $current_page_ID = $wp_query->post->ID;
    else if (function_exists('get_the_id') && !empty(get_the_id()))
        $current_page_ID = get_the_id();
    else if (!is_null($post) && isset($post->ID) && !empty($post->ID))
        $current_page_ID = $post->ID;
    else if ((isset($_GET['action']) && sanitize_text_field($_GET['action']) == 'edit') && $post = ((isset($_GET['post']) && is_numeric($_GET['post'])) ? absint($_GET['post']) : false))
        $current_page_ID = $post;
    else if ($p = ((isset($_GET['p']) && is_numeric($_GET['p'])) ? absint($_GET['p']) : false))
        $current_page_ID = $p;
    else if ($page_id = ((isset($_GET['page_id']) && is_numeric($_GET['page_id'])) ? absint($_GET['page_id']) : false))
        $current_page_ID = $page_id;
    else if (!is_admin() && $wpdb) {
        $actual_link = rtrim($_SERVER['REQUEST_URI'], '/');
        $parts = explode('/', $actual_link);
        if (!empty($parts)) {
            $slug = end($parts);
            if (!empty($slug)) {
                if (
                    $post_id = $wpdb->get_var(
                        $wpdb->prepare(
                            "SELECT ID FROM {$wpdb->posts} 
                        WHERE 
                            `post_status` = %s
                        AND
                            `post_name` = %s
                        AND
                            TRIM(`post_name`) <> ''
                        LIMIT 1",
                            'publish',
                            sanitize_title($slug)
                        )
                    )
                ) {
                    $current_page_ID = absint($post_id);
                }
            }
        }
    } else if (!is_admin() && 'page' == get_option('show_on_front') && !empty(get_option('page_for_posts'))) {
        $current_page_ID = get_option('page_for_posts');
    }

    return $current_page_ID;
}

/**
 * Retrieves image data by ID and size
 *
 * @param int $id The attachment ID
 * @param string $size The image size (default: 'full')
 * @return array|false An array containing the image data or false if the ID is empty
 */
function get_image($id, $size = 'full')
{
    if (!$id)
        return false;

    $image = wp_get_attachment_image_src($id, $size);
    $image_data = [
        'src' => $image[0],
        'width' => $image[1],
        'height' => $image[2],
        'alt' => get_attachment_alt($id),
        'full' => wp_get_attachment_image_src($id, 'full')[0],
        'srcset' => wp_get_attachment_image_srcset($id, $size),
        'sizes' => wp_get_attachment_image_sizes($id, $size)
    ];
    return $image_data;
}