<?php
/*
Plugin Name: My Custom Plugin
Description: Ensures free shipping is calculated on total, not subtotal
Version: 0.1
Author: michael green
*/

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_filter('woocommerce_shipping_free_shipping_is_available', 'mcp_custom_free_shipping_calculation', 10, 3);
}

function mcp_custom_free_shipping_calculation($is_available, $package, $shipping_method) {
    if ($shipping_method->requires == 'min_amount') {
        $total = WC()->cart->get_total('edit');
        $min_amount = $shipping_method->min_amount;
        
        if ($total >= $min_amount) {
            return true;
        } else {
            return false;
        }
    }
    return $is_available;
}