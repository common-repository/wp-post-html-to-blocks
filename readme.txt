=== WP Post HTML to Blocks === 
Contributors: zeshanb
Tags: html tags, surround, Gutenberg , html block
Requires at least: 5.0
Tested up to: 6.1
Requires PHP: 7.0
Stable tag: 1.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


=== Description ===
 
This plugin is for content that is copy pasted into Gutenberg editor edited as html in classic block editor.

Purpose of this plugin is to allow a Wordpress publisher administrator to manually surround html tags such as p, div, br for interpretation by Gutenberg editor as html blocks.

This plugin also allows parsing and surrounding of line spaced content in classic editor.
 
A Wordpress admin can use this plugin as a manual way to parse for line spaces (\n), <code><p> </p></code>, <code><div> </div></code>, and <code> <br> </code>. Turning them into html blocks.
 
=== Installation ===
 
1. Download the plugin 
1. Unzip and Upload the wp-post-html-to-blocks.zip folder to your site's wp-content/plugins directory 
1. Activate the plugin in the WordPress Admin Panel 
1. Visit plugin's config page under settings side menu in your WordPress dashboard
1. On config page in admin. Locate a post based on it's title by typing in keywords from a post's title. Minimum of two words are required to do a proper search.
1. Select number of desired results from Top drop down
1. Press search
 
== Changelog == 

= 1.0 = 
* First version of the plugin. 

= 1.0.1 =
* added default dashbaord styles to table and search form

= 1.1 =
* Fixed undefined index bugs
* new screenshots for readme

= 1.2 =
* Welcome panel color to grey
* Use the word markup in welcome message

== Frequently Asked Questions == 
 
= Why there isn't a option to search contents of all posts? =

Although all searches of posts are user initiated. Searching for key phrases in contents of each post would compromise the performance of a WordPress installation.

= Does this parse tags within tags? =

Sorry, This plugin allows parsing of external surrounding tags. Not tags inside of tags. Tags inside tags will be treated by Gutenberg as requiring repairs and Gutenberg editor will alert post editor.

= Does this plugin edit posts with publish status by default? =

You have a choice to select the post with status you prefer.

 
== Screenshots == 

1. Suppose you have a Wordpress post with paragraph lines from a classic editor
2. Using this plugin you search for post title select paragraph tags and press encapsulate html tags
3. This plugin converts html tags into html blocks in Gutenberg editor.
4. Location of plugin's configuration page.
5. Configuration page selecting a tag for searching through.
