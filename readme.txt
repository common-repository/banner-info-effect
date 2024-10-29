=== Banner Info Effect ===
Contributors: Module Express
Donate link: http://beautiful-module.com/
Tags: responsive Banner Info Effect,Banner Info Effect,mobile touch Banner Info Effect,image slider,responsive header gallery slider,responsive banner slider,responsive header banner slider,header banner slider,responsive slideshow,header image slideshow
Requires at least: 3.5
Tested up to: 4.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add an Responsive header Banner Info Effect OR Responsive Banner Info Effect inside wordpress page OR Template. Also mobile touch Banner Info Effect

== Description ==

This plugin add a Responsive Banner Info Effect in your website. Also you can add Responsive Banner Info Effect page and mobile touch slider in to your wordpress website.

View [DEMO](http://beautiful-module.com/demo/banner-info-effect/) for additional information.

= Installation help and support =

The plugin adds a "Responsive Banner Info Effect" tab to your admin menu, which allows you to enter Image Title, Content, Link and image items just as you would regular posts.

To use this plugin just copy and past this code in to your header.php file or template file 
<code><div class="headerslider">
 <?php echo do_shortcode('[bie_gallery.slider]'); ?>
 </div></code>

You can also use this Banner Info Effect inside your page with following shortcode 
<code>[bie_gallery.slider] </code>

Display Banner Info Effect catagroies wise :
<code>[bie_gallery.slider cat_id="cat_id"]</code>
You can find this under  "Banner Info Effect-> Gallery Category".

= Complete shortcode is =
<code>[bie_gallery.slider cat_id="9" autoplay="true"]</code>
 
Parameters are :

* **limit** : [bie_gallery.slider limit="-1"] (Limit define the number of images to be display at a time. By default set to "-1" ie all images. eg. if you want to display only 5 images then set limit to limit="5")
* **cat_id** : [bie_gallery.slider cat_id="2"] (Display Image slider catagroies wise.) 
* **autoplay** : [bie_gallery.slider autoplay="true"] (Set autoplay or not. value is "true" OR "false")

= Features include: =
* Mobile touch slide
* Responsive
* Shortcode <code>[bie_gallery.slider]</code>
* Php code for place image slider into your website header  <code><div class="headerslider"> <?php echo do_shortcode('[bie_gallery.slider]'); ?></div></code>
* Banner Info Effect inside your page with following shortcode <code>[bie_gallery.slider] </code>
* Easy to configure
* Smoothly integrates into any theme
* CSS and JS file for custmization

== Installation ==

1. Upload the 'banner-info-effect' folder to the '/wp-content/plugins/' directory.
2. Activate the 'Banner Info Effect' list plugin through the 'Plugins' menu in WordPress.
3. If you want to place Banner Info Effect into your website header, please copy and paste following code in to your header.php file  <code><div class="headerslider"> <?php echo do_shortcode('[bie_gallery.slider limit="-1"]'); ?></div></code>
4. You can also display this Images slider inside your page with following shortcode <code>[bie_gallery.slider limit="-1"] </code>


== Frequently Asked Questions ==

= Are there shortcodes for Banner Info Effect items? =

If you want to place Banner Info Effect into your website header, please copy and paste following code in to your header.php file  <code><div class="headerslider"> <?php echo do_shortcode('[bie_gallery.slider limit="-1"]'); ?></div>  </code>

You can also display this Banner Info Effect inside your page with following shortcode <code>[bie_gallery.slider limit="-1"] </code>



== Screenshots ==
1. Designs Views from admin side
2. Catagroies shortcode

== Changelog ==

= 1.0 =
Initial release