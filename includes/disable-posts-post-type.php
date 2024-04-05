<?php
/**
 * Removes the post type links from the admin menu.
 */
function remove_posts_type()
{
    remove_menu_page('edit.php');
}

/**
 * Removes the "quick drafts" post from the dashboard.
 */
function remove_posts_quickdraft()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}

/**
 * Removes the "New post" links from the admin bar.
 *
 * @param WP_Admin_Bar $wp_admin_bar The WordPress admin bar object.
 */
function remove_posts_from_menu($wp_admin_bar)
{
    $wp_admin_bar->remove_node('new-post');
}

add_action('admin_menu', 'remove_posts_type');
add_action('admin_bar_menu', 'remove_posts_from_menu', 9999);
add_action('wp_dashboard_setup', 'remove_posts_quickdraft', 9999);

/**
 * Sets a 404 status for certain post-related pages.
 *
 * @param WP_Query $qry The WordPress query object.
 */
function rr_404_my_event($qry)
{
    if (is_singular('post') || is_post_type_archive('post') || is_tax('category') || is_tax('post_tag') || is_tax('post_format')) {
        $qry->set_404();
        status_header(404);
    }
}

add_action('pre_get_posts', 'rr_404_my_event');

/**
 * Modifies the robots meta tag for certain post-related pages.
 *
 * @param array $robots The robots meta tag directives.
 * @return array The modified robots meta tag directives.
 */
add_filter('wp_robots', function ($robots) {
    if (is_singular('post') || is_post_type_archive('post') || is_tax('category') || is_tax('post_tag') || is_tax('post_format')) {
        $robots['noindex'] = true;
    }
    return $robots;
});
