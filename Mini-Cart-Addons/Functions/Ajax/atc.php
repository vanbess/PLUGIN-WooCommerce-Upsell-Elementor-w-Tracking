<?php

/**
 * Adds Cart Addon products to cart via AJAX. Also retrieves and returns correct variation ids as required.
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */
add_action('wp_ajax_uv2_minicart_atc', 'uv2_minicart_atc');
add_action('wp_ajax_nopriv_uv2_minicart_atc', 'uv2_minicart_atc');

function uv2_minicart_atc() {

    check_ajax_referer('minicarts products to cart');

    // *****************************
    // add variable product to cart
    // *****************************
    if ($_POST['var_id']) :
        $cart_key = wc()->cart->add_to_cart($_POST['var_parent'], $_POST['var_qty'], $_POST['var_id']);

        if ($cart_key) {
            wp_send_json_success($cart_key);
        }
    endif;

    // ***************************
    // add simple product to cart
    // ***************************
    if ($_POST['simple_id']) :
        $cart_key = wc()->cart->add_to_cart($_POST['simple_id'], $_POST['simple_qty']);

        if ($cart_key) :
            wp_send_json_success($cart_key);
        endif;
    endif;

    wp_die();
}
