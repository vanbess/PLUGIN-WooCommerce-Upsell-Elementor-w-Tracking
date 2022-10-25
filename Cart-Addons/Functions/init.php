<?php

/**
 * Cart Addons init
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */

add_action('plugins_loaded', 'uv2_cart_addons_init');

function uv2_cart_addons_init() {

    // check for existence of woocommerce
    if (class_exists('WooCommerce')) :

        // general AJAX action
        include UPSELL_V2_PATH . 'Cart-Addons/Functions/Ajax/general.php';

        // add to cart AJAX action
        include UPSELL_V2_PATH . 'Cart-Addons/Functions/Ajax/atc.php';

        // simple products
        include UPSELL_V2_PATH . 'Cart-Addons/Functions/Front/simple.php';

        // variable products
        include UPSELL_V2_PATH . 'Cart-Addons/Functions/Front/variable.php';

        // info modal
        include UPSELL_V2_PATH . 'Cart-Addons/Functions/Front/modal.php';

        // main/core function
        include UPSELL_V2_PATH . 'Cart-Addons/Functions/Front/cart.php';

        // scripts
        add_action('wp_enqueue_scripts', 'uv2_cart_addon_scripts');

        function uv2_cart_addon_scripts() {

            if (is_cart()) :

                // retrieve adming ajax url
                $aj_url = admin_url('admin-ajax.php');

                // css front
                wp_enqueue_style('cao-css-front', UPSELL_V2_URI . 'Cart-Addons/Assets/CSS/front.css?v1239');

                // general js
                wp_enqueue_script('cao-general', UPSELL_V2_URI . 'Cart-Addons/Assets/JS/general.js', ['jquery']);

                // localize general js
                wp_localize_script('cao-general', 'cao_general', [
                    'ajax_url' => $aj_url,
                    'nonce'    => wp_create_nonce('cart addons general js'),
                ]);

                // modal js
                wp_enqueue_script('cao-modal', UPSELL_V2_URI . 'Cart-Addons/Assets/JS/modal.js?elem', ['jquery', 'pu-magnific']);

                // add to cart js
                wp_enqueue_script('cao-atc', UPSELL_V2_URI . 'Cart-Addons/Assets/JS/atc.js', ['jquery']);

                // localize add to cart js
                wp_localize_script('cao-atc', 'cao_atc', [
                    'ajax_url'      => $aj_url,
                    'atc_nonce'     => wp_create_nonce('cart addons to cart')
                ]);

            endif;
        }

    endif;
}
