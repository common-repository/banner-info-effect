<?php
/*
Plugin Name: Banner Info Effect
Plugin URL: http://beautiful-module.com/demo/banner-info-effect/
Description: A simple Responsive Banner Info Effect
Version: 1.0
Author: Module Express
Author URI: http://beautiful-module.com
Contributors: Module Express
*/
/*
 * Register CPT bie_gallery.slider
 *
 */
if(!class_exists('Banner_Info_Effect')) {
	class Banner_Info_Effect {

		function __construct() {
		    if(!function_exists('add_shortcode')) {
		            return;
		    }
			add_action ( 'init' , array( $this , 'bie_responsive_gallery_setup_post_types' ));

			/* Include style and script */
			add_action ( 'wp_enqueue_scripts' , array( $this , 'bie_register_style_script' ));
			
			/* Register Taxonomy */
			add_action ( 'init' , array( $this , 'bie_responsive_gallery_taxonomies' ));
			add_action ( 'add_meta_boxes' , array( $this , 'bie_rsris_add_meta_box_gallery' ));
			add_action ( 'save_post' , array( $this , 'bie_rsris_save_meta_box_data_gallery' ));
			register_activation_hook( __FILE__, 'bie_responsive_gallery_rewrite_flush' );


			// Manage Category Shortcode Columns
			add_filter ( 'manage_responsive_bie_slider-category_custom_column' , array( $this , 'bie_responsive_gallery_category_columns' ), 10, 3);
			add_filter ( 'manage_edit-responsive_bie_slider-category_columns' , array( $this , 'bie_responsive_gallery_category_manage_columns' ));
			require_once( 'bie_gallery_admin_settings_center.php' );
		    add_shortcode ( 'bie_gallery.slider' , array( $this , 'bie_responsivegallery_shortcode' ));
		}


		function bie_responsive_gallery_setup_post_types() {

			$responsive_gallery_labels =  apply_filters( 'bie_gallery_slider_labels', array(
				'name'                => 'Banner Info Effect',
				'singular_name'       => 'Banner Info Effect',
				'add_new'             => __('Add New', 'bie_gallery_slider'),
				'add_new_item'        => __('Add New Image', 'bie_gallery_slider'),
				'edit_item'           => __('Edit Image', 'bie_gallery_slider'),
				'new_item'            => __('New Image', 'bie_gallery_slider'),
				'all_items'           => __('All Images', 'bie_gallery_slider'),
				'view_item'           => __('View Image', 'bie_gallery_slider'),
				'search_items'        => __('Search Image', 'bie_gallery_slider'),
				'not_found'           => __('No Image found', 'bie_gallery_slider'),
				'not_found_in_trash'  => __('No Image found in Trash', 'bie_gallery_slider'),
				'parent_item_colon'   => '',
				'menu_name'           => __('Banner Info Effect', 'bie_gallery_slider'),
				'exclude_from_search' => true
			) );


			$responsiveslider_args = array(
				'labels' 			=> $responsive_gallery_labels,
				'public' 			=> true,
				'publicly_queryable'		=> true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'capability_type' 	=> 'post',
				'has_archive' 		=> true,
				'hierarchical' 		=> false,
				'menu_icon'   => 'dashicons-format-gallery',
				'supports' => array('title','editor','thumbnail')
				
			);
			register_post_type( 'bie_gallery_slider', apply_filters( 'sp_faq_post_type_args', $responsiveslider_args ) );

		}
		
		function bie_register_style_script() {
		    wp_enqueue_style( 'bie_responsiveimgslider',  plugin_dir_url( __FILE__ ). 'css/responsiveimgslider.css' );
			/*   REGISTER ALL CSS FOR SITE */
			wp_enqueue_style( 'bie_main',  plugin_dir_url( __FILE__ ). 'css/sangarSlider.css' );			
			wp_enqueue_style( 'bie_demo',  plugin_dir_url( __FILE__ ). 'css/banner-info-effect.css' );
			wp_enqueue_style( 'bie_default',  plugin_dir_url( __FILE__ ). 'themes/default/default.css' );

			/*   REGISTER ALL JS FOR SITE */	
			wp_enqueue_script( 'bie_sangarBase', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarBaseClass.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarSetup', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarSetupLayout.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarSize', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarSizeAndScale.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarShift', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarShift.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarSetupBullet', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarSetupBulletNav.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarSetupNavigation', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarSetupNavigation.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarSetupSwipeTouch', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarSetupSwipeTouch.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarSetupTimer', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarSetupTimer.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarBeforeAfter', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarBeforeAfter.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarLock', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarLock.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarResponsiveClass', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarResponsiveClass.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarResetSlider', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarResetSlider.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarTextbox', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarTextbox.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarVideo', plugin_dir_url( __FILE__ ) . 'js/sangarSlider/sangarVideo.js', array( 'jquery' ));
			
			wp_enqueue_script( 'bie_touchSwipe', plugin_dir_url( __FILE__ ) . 'js/touchSwipe.min.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_imagesloaded', plugin_dir_url( __FILE__ ) . 'js/imagesloaded.min.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_sangarSlider', plugin_dir_url( __FILE__ ) . 'js/sangarSlider.js', array( 'jquery' ));
			wp_enqueue_script( 'bie_velocity', plugin_dir_url( __FILE__ ) . 'js/velocity.min.js', array( 'jquery' ));
			
		}
		
		
		function bie_responsive_gallery_taxonomies() {
		    $labels = array(
		        'name'              => _x( 'Category', 'taxonomy general name' ),
		        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		        'search_items'      => __( 'Search Category' ),
		        'all_items'         => __( 'All Category' ),
		        'parent_item'       => __( 'Parent Category' ),
		        'parent_item_colon' => __( 'Parent Category:' ),
		        'edit_item'         => __( 'Edit Category' ),
		        'update_item'       => __( 'Update Category' ),
		        'add_new_item'      => __( 'Add New Category' ),
		        'new_item_name'     => __( 'New Category Name' ),
		        'menu_name'         => __( 'Gallery Category' ),
		    );

		    $args = array(
		        'hierarchical'      => true,
		        'labels'            => $labels,
		        'show_ui'           => true,
		        'show_admin_column' => true,
		        'query_var'         => true,
		        'rewrite'           => array( 'slug' => 'responsive_bie_slider-category' ),
		    );

		    register_taxonomy( 'responsive_bie_slider-category', array( 'bie_gallery_slider' ), $args );
		}

		function bie_responsive_gallery_rewrite_flush() {  
				bie_responsive_gallery_setup_post_types();
		    flush_rewrite_rules();
		}


		function bie_responsive_gallery_category_manage_columns($theme_columns) {
		    $new_columns = array(
		            'cb' => '<input type="checkbox" />',
		            'name' => __('Name'),
		            'gallery_bie_shortcode' => __( 'Gallery Category Shortcode', 'bie_slick_slider' ),
		            'slug' => __('Slug'),
		            'posts' => __('Posts')
					);

		    return $new_columns;
		}

		function bie_responsive_gallery_category_columns($out, $column_name, $theme_id) {
		    $theme = get_term($theme_id, 'responsive_bie_slider-category');

		    switch ($column_name) {      
		        case 'title':
		            echo get_the_title();
		        break;
		        case 'gallery_bie_shortcode':
					echo '[bie_gallery.slider cat_id="' . $theme_id. '"]';			  	  

		        break;
		        default:
		            break;
		    }
		    return $out;   

		}

		/* Custom meta box for slider link */
		function bie_rsris_add_meta_box_gallery() {
			add_meta_box('custom-metabox',__( 'LINK URL', 'link_textdomain' ),array( $this , 'bie_rsris_gallery_box_callback' ),'bie_gallery_slider');			
		}
		
		function bie_rsris_gallery_box_callback( $post ) {
			wp_nonce_field( 'bie_rsris_save_meta_box_data_gallery', 'rsris_meta_box_nonce' );
			$value = get_post_meta( $post->ID, 'rsris_bie_link', true );
			echo '<input type="url" id="rsris_bie_link" name="rsris_bie_link" value="' . esc_attr( $value ) . '" size="80" /><br />';
			echo 'ie http://www.google.com';
		}
		
		function bie_truncate($string, $length = 100, $append = "&hellip;")
		{
			$string = trim($string);
			if (strlen($string) > $length)
			{
				$string = wordwrap($string, $length);
				$string = explode("\n", $string, 2);
				$string = $string[0] . $append;
			}

			return $string;
		}
			
		function bie_rsris_save_meta_box_data_gallery( $post_id ) {
			if ( ! isset( $_POST['rsris_meta_box_nonce'] ) ) {
				return;
			}
			if ( ! wp_verify_nonce( $_POST['rsris_meta_box_nonce'], 'bie_rsris_save_meta_box_data_gallery' ) ) {
				return;
			}
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			if ( isset( $_POST['post_type'] ) && 'bie_gallery_slider' == $_POST['post_type'] ) {

				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				}
			} else {

				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}
			if ( ! isset( $_POST['rsris_bie_link'] ) ) {
				return;
			}
			$link_data = sanitize_text_field( $_POST['rsris_bie_link'] );
			update_post_meta( $post_id, 'rsris_bie_link', $link_data );
		}
		
		/*
		 * Add [bie_gallery.slider] shortcode
		 *
		 */
		function bie_responsivegallery_shortcode( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				"limit"  => '',
				"cat_id" => '',
				"autoplay" => ''
			), $atts));
			
			if( $limit ) { 
				$posts_per_page = $limit; 
			} else {
				$posts_per_page = '-1';
			}
			if( $cat_id ) { 
				$cat = $cat_id; 
			} else {
				$cat = '';
			}
			
			if( $autoplay ) { 
				$autoplay_slider = $autoplay; 
			} else {
				$autoplay_slider = 'true';
			}
						

			ob_start();
			// Create the Query
			$post_type 		= 'bie_gallery_slider';
			$orderby 		= 'post_date';
			$order 			= 'DESC';
						
			 $args = array ( 
		            'post_type'      => $post_type, 
		            'orderby'        => $orderby, 
		            'order'          => $order,
		            'posts_per_page' => $posts_per_page,  
		           
		            );
			if($cat != ""){
		            	$args['tax_query'] = array( array( 'taxonomy' => 'responsive_bie_slider-category', 'field' => 'id', 'terms' => $cat) );
		            }        
		      $query = new WP_Query($args);

			$post_count = $query->post_count;
			$i = 1;

			if( $post_count > 0) :
			
			$list_collection = array(); 
			?>
			<div class='bie_gallery_slider'>
				<?php			
					  while ($query->have_posts()) : $query->the_post();
							include('designs/template.php');
							$content = get_the_title();
							$content = strip_tags($content);
							$title = $this->bie_truncate($content, 20);
							$list_collection[$i-1] = '"'.$title.'"';
					  $i++;
					  endwhile;	

				  ?>
			</div>
			
			<?php
				endif;
				// Reset query to prevent conflicts
				wp_reset_query();
			?>							
			<script type="text/javascript">
				jQuery(document).ready(function($) {				
					var sangar = $('.bie_gallery_slider').sangarSlider({
						timer : <?php if($autoplay_slider == "false") { echo 'false';} else { echo 'true'; } ?>, // true or false to have the timer
						width : 850, // slideshow width
						height : 500, // slideshow height
						directionalNav : 'show',
						pagination : 'content-horizontal', // bullet, content-horizontal, content-vertical, none
						paginationContent : [<?php echo implode(',',$list_collection)?>],
						paginationContentWidth : 200, // slideshow width
						carousel : false
					});
				});

			</script>
			<?php
			return ob_get_clean();
		}		
	}
}
	
function bie_master_gallery_images_load() {
        global $mfpd;
        $mfpd = new Banner_Info_Effect();
}
add_action( 'plugins_loaded', 'bie_master_gallery_images_load' );
?>