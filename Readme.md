# WordPress Barebone Theme

This is a collection of helper functions and minor fixes to help you jump start WordPress theme development. The files included here can be used with any starter theme, but are tested with Underscores, which is the ideal route to take while starting WordPress theme development.

### Installation

Requires [Underscores](https://github.com/automattic/_s) theme as a base theme (files provided here are just add ons)

-- Click on [this link](https://underscores.me/) to generate a new theme using Underscores

-- Clone/Download the files from this repo and place them inside your generated theme (from Underscores) directory 

-- Include the helper files (note you do not need to include all the files, go through the files to see which ones you require e.g. WPML would not be required if you are not using WPML plugin). Add the following code to the bottom of your theme's `functions.php` file

```sh
/**
 * Include drop-ins
 */
require get_template_directory() . '/inc/acf-setup.php';
require get_template_directory() . '/inc/constants.php';
require get_template_directory() . '/inc/custom-post-people.php';
require get_template_directory() . '/inc/theme-setup-helpers.php';
require get_template_directory() . '/inc/theme-setup-menus.php';
require get_template_directory() . '/inc/wpml-setup.php';
```

