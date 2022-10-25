<?php

/**
 * Produc Upsells init scripts and functions
 * 
 * @version 1.0.0
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */
add_action('init', function () {

    // bail if Polylang is not installed and display error message
    if (!function_exists('pll_current_language')) :

        add_action('admin_notices', function () {
            $class = 'notice notice-error';
            $message = __('<b><u>PLEASE NOTE:</u> Polylang needs to be installed and tracking custom post types added to <i>Language -> Settings -> Custom post types and Taxonomies page</i> in order for Upsell V2 plugin and associated tracking to work properly.</b>', 'woocommerce');

            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
        });

        return;

    endif;

    // check for existence of woocommerce
    if (class_exists('WooCommerce')) :

        // functions admin
        include UPSELL_V2_PATH . 'Product-Upsells/Functions/Admin/admin.php';

        // add to cart AJAX action
        include UPSELL_V2_PATH . 'Product-Upsells/Functions/Front/AJAX/atc.php';

        // simple products
        include UPSELL_V2_PATH . 'Product-Upsells/Functions/Front/simple.php';

        // variable products
        include UPSELL_V2_PATH . 'Product-Upsells/Functions/Front/variable.php';

        // info modal
        include UPSELL_V2_PATH . 'Product-Upsells/Functions/Front/modal.php';

        // main/core function
        include UPSELL_V2_PATH . 'Product-Upsells/Functions/Front/product-upsells.php';

    endif;

    // retrieve adming ajax url
    $aj_url = admin_url('admin-ajax.php');

    // css front
    wp_register_style('pu-css-front', UPSELL_V2_URI . 'Product-Upsells/Assets/CSS/front.css?11');

    // general js
    wp_register_script('pu-general', UPSELL_V2_URI . 'Product-Upsells/Assets/JS/general.js', ['jquery']);

    // modal js
    wp_register_script('pu-modal', UPSELL_V2_URI . 'Product-Upsells/Assets/JS/modal.js?v4.5', ['jquery'], '2.1.4a');

    // add to cart js
    wp_register_script('pu-atc', UPSELL_V2_URI . 'Product-Upsells/Assets/JS/atc.js', ['jquery']);

    // localize add to cart js
    wp_localize_script('pu-atc', 'pu_atc', [
        'ajax_url'      => $aj_url,
        'atc_nonce'     => wp_create_nonce('add upsell products to cart')
    ]);
});
