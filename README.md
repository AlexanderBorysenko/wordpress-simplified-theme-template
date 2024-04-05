# easy-level-tutroal-theme

## `functions.php`

Connects all following theme logic together

## helpers Folder

Contains following useful functions:

### `require-all.php`

#### `require_all(...$args)`

Implements the `require_all` function that requires all files in a given directory. It is used to auto load other helpers, and includes in the `functions.php` file.

Can be used in other files as well.

### `debugging-tools.php`

#### `dump(...$args)`

Creates a window with the dump of passed values. It is used for debugging purposes.

### `resolve-source-build-file-name.php`

#### `resolve_source_build_filename($pattern)`

Resolves the source build file name by the given pattern. It is used to get the source build file name as long as on each build it has a unique hash.

Example of usage:

-   after the source build file is created, it will have a name like `app-1234567890.css`
-   the function `resolve_source_build_filename('app-*.css')` will return the name of the file -> `app-1234567890.css`

### `get-current-post-id.php`

#### `get_current_post_id()`

Try to get the current post ID in all possible ways if the classic Wordpress functions do not work.

### `get-image-data.php`

#### `get_image_data($image_id, $size = 'full')`

Useful function to get the following image data by the image ID.

-   'src' - image source
-   'width' - image original width
-   'height' - image original height
-   'alt' - image alt text from the media library
-   'full' - image full size source
-   'srcset' - image srcset attribute content
-   'sizes' - image sizes attribute content

## includes Folder

This folder contains all the partials that are used in the website. It helps to keep the project organized and allows for easy access to all partials.

You can find the following default partials in the includes folder:

### `ajax-main-contact-form.php`

### `ajax-main-contact-form.php`

Handles the submission of the main contact form via AJAX.

This function is hooked to the 'wp_ajax_main_contact_form_submit' and 'wp_ajax_nopriv_main_contact_form_submit' actions. It validates the form fields and sends an email with the form data if there are no errors. If there are errors, it returns a JSON response with the error messages in form of an array `['field_name' => 'error_message'][]`.

### `disable-comments.php`

Disables default WordPress comments as they are rarely used.

### `disable-posts-post-type.php`

Entirely disables the default WordPress posts post type. As usually it is not needed.

### `enque-scripts.php`

Enque your theme scripts and styles here.

### `fonts-conect.php`

Connects the CDN fonts used in the theme.

### `hot-reloader.php`

Provides a hot reloader for the theme. So the page will be reloaded automatically when the `source/build/app-\*.css` file is changed.

### `menus.php`

Registers the theme menus here.

### `post-type-blog.php`

Registers the blog post type. Cause it is often needed in the websites.

### `remove-head-bump.php`

Removes the WordPress html padding used for admin bar.

### `scroll-saver.php`

Adds a JavaScript script to the wp_head action hook. The script checks if there is a value stored in the sessionStorage with the key 'shouldScroll'. If there is, it scrolls the window to the specified position. After scrolling, the value is removed from the sessionStorage.

### `table-of-contents-data.php`

This file contains a function that adds unique IDs to headings in the content and generates a global `$tableOfContentsData` array.

### `theme-support.php`

This partial contains the default wordpress theme support settings for the website.

## images Folder

This folder contains all the static images used in the website. It helps to keep the project organized and allows for easy access to all images.

## source Folder

Contains all the assets, scripts, and styles used in the website. Creates the final build files.

Responsible for components building and storing the final build files.

### build folder

Final output of the build process. Contains the final build files.

### components Folder

Contains all the components used in the website. It helps to keep the project organized and allows for easy access to all components.

-
