<?php
/**
 * Retrieves the version of the CSS file used for hot reloading.
 *
 * @return int|false The version of the CSS file, or false if the file is not found.
 */
function get_version()
{
    $fileName = resolve_source_build_filename('app-*.css');
    if (!$fileName) {
        return false;
    }

    $version = filemtime(get_template_directory() . '/source/build/' . resolve_source_build_filename('app-*.css'));
    return $version;
}

/**
 * Sends the current version of the CSS file as a JSON response.
 */
function ajax_get_version()
{
    wp_send_json(get_version());
    wp_die();
}

add_action('wp_ajax_get_current_version', 'ajax_get_version');
add_action('wp_ajax_nopriv_get_current_version', 'ajax_get_version');

/**
 * Handles the hot reloading functionality by periodically checking for a new version of the CSS file.
 * If a new version is found, the page is reloaded.
 */
function handleHotReload()
{
    ?>
    <script>
        var currentVersion = <?= get_version() ?>;
        setInterval(function ()
        {
            fetch('/wp-admin/admin-ajax.php?action=get_current_version')
                .then(response => response.json())
                .then(version =>
                {
                    if (!version) return;

                    if (version !== currentVersion)
                    {
                        sessionStorage.setItem('shouldScroll', window.scrollY);
                        location.reload();
                    }
                });
        }, 500);
    </script>
    <?php
}

if (current_user_can('administrator')) {
    add_action('wp_head', 'handleHotReload', 1);
}
