<?php
/*
 Plugin Name: Slick Gallery
 Plugin URI: http://wordpress.org/plugins/slick-gallery/
 Description: Mobile touch slider with recent posts featured-image.
 Author: sysbird
 Author URI: http://www.sysbird.jp/wptips
 Version: 1.0
 License: GPLv2 or later
*/

//////////////////////////////////////////////////////
// Wordpress 3.6+
global $wp_version;
if ( version_compare( $wp_version, "3.8", "<" ) ){
	return false;
}

//////////////////////////////////////////////////////
// Start the plugin
class SlickGallery {

	//////////////////////////////////////////
	// construct
	function __construct() {
		add_shortcode('slick-gallery', array( &$this, 'shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'add_script' ) );
		add_action( 'wp_print_styles', array( &$this, 'add_style' ) );
	}

	//////////////////////////////////////////
	// add JavaScript
	function add_script() {
		wp_enqueue_script( 'jquery-masonry' );

		$filename = plugins_url( dirname( '/' .plugin_basename( __FILE__ ) ) ).'/justifiedGallery/jquery.justifiedGallery.min.js';
		wp_enqueue_script( 'slick-gallery-justifiedGallery', $filename, array( 'jquery' ), '1.0' );

		$filename = plugins_url( dirname( '/' .plugin_basename( __FILE__ ) ) ).'/Boxer/jquery.fs.boxer.js';
		wp_enqueue_script( 'slick-gallery-Boxer', $filename, array( 'jquery' ), '1.0' );

		$filename = plugins_url( dirname( '/' .plugin_basename( __FILE__ ) ) ).'/slick-gallery.js';
		wp_enqueue_script( 'slick-gallery', $filename, array( 'jquery' ), '1.0' );
	}

	//////////////////////////////////////////
	// add css
	function add_style() {
		$filename = plugins_url( dirname( '/' .plugin_basename( __FILE__ ) ) ).'/justifiedGallery/justifiedGallery.min.css';
		wp_enqueue_style( 'slick-gallery-justifiedGallery', $filename, false, '1.0' );

		$filename = plugins_url( dirname( '/' .plugin_basename( __FILE__ ) ) ).'/Boxer/jquery.fs.boxer.min.css';
		wp_enqueue_style( 'slick-gallery-Boxer', $filename, false, '1.0' );

		$filename = plugins_url( dirname( '/' .plugin_basename( __FILE__ ) ) ).'/slick-gallery.css';
		wp_enqueue_style( 'slick-gallery', $filename, false, '1.0' );
	}

	//////////////////////////////////////////
	// ShoetCode
	function shortcode( $atts ) {

		global $post;

		$output = '';
		$args = array( 'post_type'       => 'attachment',
						'posts_per_page' => -1,
						'post_parent'    => $post->ID,
						'post_mime_type' => 'image',
						'orderby'        => 'menu_order',
						'order'          => 'ASC' );
		$images = get_posts( $args );
		if ( $images ) {
			foreach( $images as $image ){
				$src = wp_get_attachment_url( $image->ID );
				$thumbnail = wp_get_attachment_image_src( $image->ID, 'thumbnail' );
				$file = get_attached_file( $image->ID );
				$output .= '<div class="item"><a href="' .$src .'" data-gallery="gallery"><img src="' .$thumbnail[0] .'" alt="' .$image->post_title .'"></a></div>';
  			}
		}

		$mobile = '';
		if ( !wp_is_mobile() ){
			$mobile = ' mobile';
		}

		if( !empty( $output ) ){
			$output = '<div class="slick-gallery' .$mobile .'">' .$output .'</div>';
		}

		return $output;
	}
}
$SlickGallery = new SlickGallery();
?>