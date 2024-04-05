<?php
/**
 * Registers the theme menus here
 */

add_action('after_setup_theme', function () {
    register_nav_menus([
        'header_menu' => 'Main menu',
        'footer_menu' => 'Footer menu',
    ]);
});
