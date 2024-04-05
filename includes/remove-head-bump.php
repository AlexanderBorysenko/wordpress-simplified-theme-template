<?php
/**
 * Removes the admin bar bump callback from the wp_head action hook.
 *
 * This function removes the '_admin_bar_bump_cb' callback from the 'wp_head' action hook.
 * It is hooked to the 'get_header' action, so it will be executed when the header is being retrieved.
 */
function remove_head_bump()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_head_bump');
