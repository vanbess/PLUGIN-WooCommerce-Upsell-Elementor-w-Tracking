<?php

/**
 * Plugin Name: SBWC Combined Upsell w Tracking [ELEMENTOR/RIODE/BOOTSTRAP COMPATIBLE]
 * Description: Reworked & modernized version of SBWC Combined Upsell plugin with upsells tracking and optional discount percentage.
 * Author: WC Bessinger
 * Version: 2.1.5
 * @package sbwc-upsell-v2
 */
!defined('ABSPATH') ? exit() : '';

/**
 * CONSTANTS
 */
define('UPSELL_V2_URI', plugin_dir_url(__FILE__));
define('UPSELL_V2_PATH', plugin_dir_path(__FILE__));

/**
 * INIT BACKEND SETTINGS
 */
include UPSELL_V2_PATH . 'Settings/admin-settings.php';
include UPSELL_V2_PATH . 'Settings/save-settings.php';

/**
 * If Polylang not installed, bail
 */
add_action('plugins_loaded', function () {
    if (!function_exists('pll_current_language')) :

        add_action('admin_notices', function () {
            $class = 'notice notice-error';
            $message = __('<b><u>PLEASE NOTE:</u> Polylang needs to be installed and tracking custom post types added to <i>Language -> Settings -> Custom post types and Taxonomies page</i> in order for Upsell V2 plugin and associated tracking to work properly.</b>', 'woocommerce');

            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), $message);
        });

        return;

    endif;
});

/**
 * Scripts and CSS
 */
add_action('admin_enqueue_scripts', 'uv2_admin_scripts');

function uv2_admin_scripts() {

    // css
    wp_enqueue_style('uv2-admin-css', UPSELL_V2_URI . 'Settings/upsellv2.admin.css', [], false);

    // jquery ui tabs js
    wp_enqueue_script('jquery-ui-tabs');

    // js
    wp_enqueue_script('uv2-admin-js', UPSELL_V2_URI . 'Settings/upsellv2.admin.js', ['jquery'], false, true);
}

add_action('wp_enqueue_scripts', 'uv2_magnific_enqueue');

function uv2_magnific_enqueue() {
    wp_enqueue_script('pu-magnific', UPSELL_V2_URI . 'Assets/JS/magnific.js', ['jquery'], '1.1.0');
}

/**
 * INIT MODULES
 */
// 1. Product Upsells
include UPSELL_V2_PATH . 'Product-Upsells/Functions/init.php';

// 2. Product Upsells
include UPSELL_V2_PATH . 'Product-Bundle/Functions/init.php';

// 3. Minicart Upsells
include UPSELL_V2_PATH . 'Mini-Cart-Addons/Functions/init.php';

// 4. Checkout Popup
include UPSELL_V2_PATH . 'Checkout-Popup/Functions/init.php';

// 5. Checkout Addons
include UPSELL_V2_PATH . 'Checkout-Addons/Functions/init.php';

// 6. Cart Addons
include UPSELL_V2_PATH . 'Cart-Addons/Functions/init.php';

// 7. Upsell tracking
include UPSELL_V2_PATH . 'Tracking/init.php';
