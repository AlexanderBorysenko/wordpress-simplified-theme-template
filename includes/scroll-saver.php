<?php
/**
 * This code adds a JavaScript script to the wp_head action hook. The script checks if there is a value stored in the sessionStorage with the key 'shouldScroll'. If there is, it scrolls the window to the specified position. After scrolling, the value is removed from the sessionStorage.
 */
add_action('wp_head', function () {
    ?>
    <script>
        window.addEventListener('DOMContentLoaded', function ()
        {
            var shouldScroll = sessionStorage.getItem('shouldScroll');
            if (shouldScroll)
            {
                console.log('scrolling to', shouldScroll);
                window.scrollTo({
                    top: parseInt(shouldScroll, 10),
                    left: 0,
                    behavior: 'instant'
                });
                sessionStorage.removeItem('shouldScroll');
            }
        });
    </script>
    <?php
}, 1);