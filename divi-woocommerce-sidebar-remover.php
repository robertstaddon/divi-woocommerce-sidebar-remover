<?php
/*
	Plugin Name: Divi WooCommerce Sidebar Remover
	Description: A better way to remove the Divi sidebar from all WooCommerce product pages
	Version: 1.0
	Author: Abundant Designs LLC
	Author URI: https://www.abundantdesigns.com/2019/03/06/a-better-way-to-remove-the-divi-sidebar-from-all-woocommerce-product-pages/
	License: GPLv2 or later
	Text Domain: divi-woocommerce-sidebar-remover
 */
 
 
/**
 * Remove Divi sidebar from all WooCommerce Product pages (as well as Shop and Category pages)
 */
function dwsr_divi_output_content_wrapper_end() {
	echo '
					</div> <!-- #left-area -->
				</div> <!-- #content-area -->
			</div> <!-- .container -->
		</div> <!-- #main-content -->';
}
function dwsr_remove_divi_sidebar() {
	remove_action( 'woocommerce_after_main_content', 'et_divi_output_content_wrapper_end', 10 );
	add_action( 'woocommerce_after_main_content', 'dwsr_divi_output_content_wrapper_end', 10 );	
}
add_action( 'init', 'dwsr_remove_divi_sidebar', 10 );

/**
 * Adjust the WooCommerce body classes for all WooCommerce Product pages (as well as Shop and Category pages)
 */
function dwsr_body_classes( $classes ) {
	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$remove_classes = array('et_right_sidebar', 'et_left_sidebar', 'et_includes_sidebar');
		foreach( $classes as $key => $value ) {
		      if ( in_array( $value, $remove_classes ) ) unset( $classes[$key] );
		}
		$classes[] = 'et_full_width_page';
	}
	return $classes;
}
add_filter('body_class', 'dwsr_body_classes', 20);