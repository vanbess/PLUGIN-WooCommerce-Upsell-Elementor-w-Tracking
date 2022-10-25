<?php

/**
 * Produc Upsells init scripts and functions
 * 
 * @version 1.0.0
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */
add_action('init', function () {

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
