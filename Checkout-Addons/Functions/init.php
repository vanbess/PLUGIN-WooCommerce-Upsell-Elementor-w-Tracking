<?php

/**
 * Checkout Addons init
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */

add_action('plugins_loaded', 'uv2_co_addons_init');

function uv2_co_addons_init() {

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

        // general AJAX action
        include UPSELL_V2_PATH . 'Checkout-Addons/Functions/Front/AJAX/general.php';

        // add to cart AJAX action
        include UPSELL_V2_PATH . 'Checkout-Addons/Functions/Front/AJAX/atc.php';

        // categories
        include UPSELL_V2_PATH . 'Checkout-Addons/Functions/Front/Checkout/categories.php';

        // category meta
        include UPSELL_V2_PATH . 'Checkout-Addons/Functions/Front/Checkout/category-meta.php';

        // simple products
        include UPSELL_V2_PATH . 'Checkout-Addons/Functions/Front/Checkout/simple.php';

        // variable products
        include UPSELL_V2_PATH . 'Checkout-Addons/Functions/Front/Checkout/variable.php';

        // info modal
        include UPSELL_V2_PATH . 'Checkout-Addons/Functions/Front/Checkout/modal.php';

        // main/core function
        include UPSELL_V2_PATH . 'Checkout-Addons/Functions/Front/Checkout/checkout.php';

        // scripts
        add_action('wp_enqueue_scripts', 'uv2_co_addons_scripts');

        function uv2_co_addons_scripts() {

            if (is_checkout()) :

                // retrieve adming ajax url
                $aj_url = admin_url('admin-ajax.php');

                // css front
                wp_enqueue_style('coao-css-front', UPSELL_V2_URI . 'Checkout-Addons/Assets/CSS/front.css?8', [], false);

                // general js
                wp_enqueue_script('coao-general', UPSELL_V2_URI . 'Checkout-Addons/Assets/JS/general.js', ['jquery'], false);

                // localize general js
                wp_localize_script('coao-general', 'coao_general', [
                    'ajax_url' => $aj_url,
                    'nonce'    => wp_create_nonce('checkout addon general js'),
                ]);

                // modal js
                wp_enqueue_script('coao-modal', UPSELL_V2_URI . 'Checkout-Addons/Assets/JS/modal.js?2', ['jquery'], false);

                // add to cart js
                wp_enqueue_script('coao-atc', UPSELL_V2_URI . 'Checkout-Addons/Assets/JS/atc.js', ['jquery'], false);

                // localize add to cart js
                wp_localize_script('coao-atc', 'coao_atc', [
                    'ajax_url'      => $aj_url,
                    'atc_nonce'     => wp_create_nonce('add checkout addons to cart')
                ]);

            endif;
        }

    endif;
}
