=== Plugin Name ===
Contributors: Fractalia - Applications lab
Tags: custom, post type, taxonomy, plugin, fractalia, wordpress
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: trunk

== Description ==

This plugin helps you to create, use and manage custom post types and custom taxonomies. Also it allows to add custom fields to custom post type and custom taxonomies.

== Installation ==

1. Download the plugin from [here](http://wordpress.org/extend/plugins/flexible-custom-post-type/ "Flexible Custom Post Type").
1. Extract all the files. 
1. Upload everything (keeping the directory structure) to the `/wp-content/plugins/` directory.
1. There should be a `/wp-content/plugins/flexible-custom-post-type` directory now with `custom-post-type.php` in it.
1. Activate the plugin through the 'Plugins' menu in WordPress. An item called "Post types" will be added to the left menu.

== Frequently Asked Questions ==

= When create a custom post type ot a custom taxonomy it returns a fwrite error =

The theme directory should be writable (0777 permision) for writing the custom templates for these custom post type.

= How do I make it multilanguage? =

For multilanguage support you should use:

1. qTranslate (http://wordpress.org/extend/plugins/qtranslate/)
2. qTranslate extended (http://wordpress.org/extend/plugins/qtranslate-extended/)

== Screenshots ==

1. The main menu of the plugin
2. The add form for a custom post type.
3. The edit form for a existing custom post type
4. The main menu of the custom post type

== Changelog ==
- 0.1 Initial release
- 0.1.3 Fixed some bugs
- 0.1.4 Added a set of icons (thanks to http://randyjensenonline.com/thoughts/wordpress-custom-post-type-fugue-icons/)
- 0.1.5 Added custom fields to custom taxonomies
- 0.1.7 Security risk fixed
- 0.1.8 Added labels
