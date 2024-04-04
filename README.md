# easy-level-tutroal-theme

## Images Folder

This folder contains all the static images used in the website. It helps to keep the project organized and allows for easy access to all images.

## includes Folder

This folder contains all the partials that are used in the website. It helps to keep the project organized and allows for easy access to all partials.

You can find the following default partials in the includes folder:

### `theme-support.php`

This partial contains the default wordpress theme support settings for the website.

### `ajax-main-contact-form.php`

This partial contains the server AJAX handler template for the main contact from.

### `disable-comments.php`

Disables default WordPress comments.

### `disable-posts-post-type.php`

Entirely disables the default WordPress posts post type. As usually it is not needed.

### `enque-scripts.php`

Enque your theme scripts and styles here.

### `menus.php`

Registers the theme menus here.

### `fonts-conect.php`

Connects the CDN fonts used in the theme.

### `hot-reloader.php`

Provides a hot reloader for the theme. So the page will be reloaded automatically when the `source/build/app-\*.css` file is changed.

### `post-type-blog.php`

Registers the blog post type. Cause it is often needed in the websites.

### `remove-head-bump.php`

Removes the WordPress html padding used for admin bar.

### `scroll-saver.php`

Adds a JavaScript script to the wp_head action hook. The script checks if there is a value stored in the sessionStorage with the key 'shouldScroll'. If there is, it scrolls the window to the specified position. After scrolling, the value is removed from the sessionStorage.

### `table-of-contents-data.php`

This file contains a function that adds unique IDs to headings in the content and generates a global `$tableOfContentsData` array.
