<?php
/**
 * Plugin Name: Hide Add to Cart Button
 * Description: A simple plugin that hides the Add to Cart button on WooCommerce products.
 * Version: 1.0
 * Author: Santosh Baral
 * Author URI: https://www.linkedin.com/in/santosh-baral-a94019233/
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('admin_menu', 'hide_add_to_cart_menu');

function hide_add_to_cart_menu(){
    add_options_page('Hide Add to Cart Settings', 'Hide Add to Cart', 'manage_options', 'hide-add-to-cart', 'hide_add_to_cart_settings_page');
}

function hide_add_to_cart_settings_page(){
    ?>
    <div class="wrap">
        <h1>Hide Add to Cart Settings</h1>
        <form method="post" action="options.php">
            <?php
                settings_fields('hide-add-to-cart-settings');
                do_settings_sections('hide-add-to-cart');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'hide_add_to_cart_settings');

function hide_add_to_cart_settings(){
    register_setting('hide-add-to-cart-settings', 'hide_add_to_cart');
    add_settings_section('hide-add-to-cart-section', 'Settings', null, 'hide-add-to-cart');
    add_settings_field('hide-add-to-cart-field', 'Hide Add to Cart button', 'hide_add_to_cart_field_display', 'hide-add-to-cart', 'hide-add-to-cart-section');
}

function hide_add_to_cart_field_display(){
    ?>
    <input type="checkbox" name="hide_add_to_cart" value="1" <?php checked(1, get_option('hide_add_to_cart'), true); ?> />
    <?php
}

function hide_add_to_cart() {
    if(get_option('hide_add_to_cart')) {
        ?>
        <style>
            /* For product list and product category pages */
            .woocommerce-page .add_to_cart_button,
            /* For single product pages */
            .woocommerce-page button.single_add_to_cart_button,
            /* For grouped and variable products */
            .woocommerce-page .single_add_to_cart_button,
            /* For product widgets */
            .widget.woocommerce .add_to_cart_button {
                display: none !important;
            }
        </style>
        <?php
    }
}

add_action('wp_head', 'hide_add_to_cart');
