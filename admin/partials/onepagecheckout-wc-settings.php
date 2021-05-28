<?php
/**
 * Provide a admin area settings view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://chiasewp.net/wcvn-onepagecheckout
 * @since      1.0.0
 *
 * @package    WCVN_OnePageCheckout
 * @subpackage WCVN_OnePageCheckout/admin/partials
 */

class WC_Settings_Tab_WCVN_OnePageCheckout {

    /**
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_wcvn_onepagcheckout', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_wcvn_onepagcheckout', __CLASS__ . '::update_settings' );

        //add custom type
        add_action( 'woocommerce_admin_field_custom_type', __CLASS__ . '::output_custom_type', 10, 1 );
    }

    public static function output_custom_type($value){
	//you can output the custom type in any format you'd like
        echo $value['desc'];
    }


    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
     */
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['wcvn_onepagcheckout'] = __( 'One Page Checkout', 'wcvn-onepagcheckout' );
        return $settings_tabs;
    }


    /**
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }


    /**
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function update_settings() {
        woocommerce_update_options( self::get_settings() );
    }


    /**
     * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings for @see woocommerce_admin_fields() function.
     */
    public static function get_settings() {

        $settings = array(
            'layouts_title' => array(
                'name'     => __( 'Layouts Setting', 'wcvn-onepagcheckout' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wcvn_onepagcheckout_layouts_title'
            ),
            'checkout_page_layout' => array(
                'name'    => __( 'Checkout Page Layout', 'wcvn-onepagcheckout' ),
                'type'    => 'select',
                'default' => 'layout-1',
                'css'      => 'width:auto;',
                'options' => array(
					'layout-1' => __( 'Layout 1', 'wcvn-onepagcheckout' ),
					'layout-2'   => __( 'Layout 2', 'wcvn-onepagcheckout' ),
				),
                'desc'    => __( 'This is a paragraph describing the setting.', 'wcvn-onepagcheckout' ),
                'id'      => 'wcvn_onepagcheckout_layout'
            ),
            'skipping_cart' => array(
                'name' => __( 'Skipping Cart', 'wcvn-onepagcheckout' ),
                'type' => 'checkbox',
                'default' => 'yes',
                'desc' => __( 'Enable', 'wcvn-onepagcheckout' ).'</ br><p class="description">'.__( 'Recommended "Checked". We recommend to skip cart page to shorten the checkout process.', 'wcvn-onepagcheckout' ).'</p>',
                'id'   => 'wcvn_onepagcheckout_skipping_cart'
            ),
            'non_changeable_quantity' => array(
                'name' => __( 'Non Changeable Quantity', 'wcvn-onepagcheckout' ),
                'type' => 'checkbox',
                'label'=>  __( 'Enable', 'wcvn-onepagcheckout' ),
                'default' => '',
                'desc' => __( 'Enable', 'wcvn-onepagcheckout' ).'</ br><p class="description">'.__( 'Product quantity will be nonchangeable if you are selling only one item or You donot want your buyers to change quantity at checkout.', 'wcvn-onepagcheckout' ).'</p>',
                'id'   => 'wcvn_onepagcheckout_non_changeable_quantity'
            ),
            'layouts_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wcvn_onepagcheckout_layouts_title_end'
            ),

            'custom_title' => array(
                'name'     => __( 'Custom Checkout Setting', 'wcvn-onepagcheckout' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wcvn_onepagcheckout_custom_title'
            ),
            'add_province' => array(
                'name' => __( 'Add provinces for Vietnam', 'wcvn-onepagcheckout' ),
                'type' => 'checkbox',
                'default' => 'yes',
                'desc' => __( 'Enable', 'wcvn-onepagcheckout' ).'</ br><p class="description">'.__( 'Recommended "Checked" if your store locate in VietNam.', 'wcvn-onepagcheckout' ).'</p>',
                'id'   => 'wcvn_onepagcheckout_add_province'
            ),
            'add_district' => array(
                'name' => __( 'Add districts for Vietnam', 'wcvn-onepagcheckout' ),
                'type' => 'checkbox',
                'default' => 'yes',
                'desc' => __( 'Enable', 'wcvn-onepagcheckout' ).'</ br><p class="description">'.__( 'Recommended "Checked" if your store locate in VietNam. Require "Add provinces for Vietnam" active', 'wcvn-onepagcheckout' ).'</p>',
                'id'   => 'wcvn_onepagcheckout_add_district'
            ),
            'currency_symbol' => array(
                'name' => __( 'Change currency symbol', 'wcvn-onepagcheckout' ),
                'type' => 'checkbox',
                'desc'=>  __( 'Enable', 'wcvn-onepagcheckout' ),
                'default' => '',
                'description' => '',
                'id'   => 'wcvn_onepagcheckout_currency_symbol'
            ),
            'currency_symbol_text' => array(
				'name' => '',
				'desc' => sprintf( __( 'Insert a text to change the current symbol <code>%s</code>', 'wcvn-onepagcheckout' ), get_woocommerce_currency_symbol() ),
				'type' => 'text',
                'css' => 'margin-top:-15px;',
				'id'   => 'wcvn_onepagcheckout_currency_symbol_text',
				'placeholder' => __( 'For `$` Example : Dolar', 'wcvn-onepagcheckout' ),
			),
            'convert_price' => array(
                'name' => __( 'Convert 000 of prices to K (or anything)', 'wcvn-onepagcheckout' ),
                'type' => 'checkbox',
                'desc'=>  __( 'Enable', 'wcvn-onepagcheckout' ),
                'default' => '',
                'id'   => 'wcvn_onepagcheckout_convert_price'
            ),
            'convert_price_text' => array(
				'name' => '',
				'desc' => __( 'Choose what you want to change. E.g:', 'wcvn-onepagcheckout' ),
				'type' => 'text',
				'id'   => 'wcvn_onepagcheckout_convert_price_text',
                'default' => 'K',
                'css' => 'margin-top:-15px',
				'placeholder' => __( 'For Example : K', 'wcvn-onepagcheckout' ),
			),
            'custom_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wcvn_onepagcheckout_custom_title_end'
            ),

            'text_title' => array(
                'name'     => __( 'Text Setting', 'wcvn-onepagcheckout' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wcvn_onepagcheckout_text_title'
            ),
            'addtocart_text' => array(
				'name' => __( 'Add to cart', 'wcvn-onepagcheckout' ),
				'desc' => __( 'Replace "Add to cart" with ....', 'wcvn-onepagcheckout' ),
				'type' => 'text',
				'id'   => 'wcvn_onepagcheckout_addtocart',
				'placeholder' => __( 'For Example :- Add to Basket', 'wcvn-onepagcheckout' ),
			),
            'viewcart_text' => array(
				'name' => __( 'View cart', 'wcvn-onepagcheckout' ),
				'desc' => __( 'Replace "View cart" with checkout (recommended) as every cart link is redirected to checkout page', 'wcvn-onepagcheckout' ),
				'type' => 'text',
				'id'   => 'wcvn_onepagcheckout_viewcart',
				'placeholder' => __( 'Checkout', 'wcvn-onepagcheckout' ),
			),
            'placeorder_text' => array(
 				'name' => __( 'Place Order', 'wcvn-onepagcheckout' ),
 				'desc' => __( 'Replace "Place Order" with ....', 'wcvn-onepagcheckout' ),
 				'type' => 'text',
 				'id'   => 'wcvn_onepagcheckout_placeorder',
				'placeholder' => __( 'For example :- Complete payment', 'wcvn-onepagcheckout' ),
 			),
            'continueshop_text' => array(
				'name' => __( 'Continue Shopping', 'wcvn-onepagcheckout' ),
				'desc' => __( 'Repalce "Continue Shopping" with ....', 'wcvn-onepagcheckout' ),
				'type' => 'text',
				'id'   => 'wcvn_onepagcheckout_continueshop',
				'placeholder' => __( 'For example :- Explore More', 'wcvn-onepagcheckout' ),
			),
            'billing_details_text' => array(
				'name' => __( 'Billing Details', 'wcvn-onepagcheckout' ),
				'desc' => __( 'Repalce "Billing Details" with ....', 'wcvn-onepagcheckout' ),
				'type' => 'text',
				'id'   => 'wcvn_onepagcheckout_billing_details',
				'placeholder' => __( 'For example :- Customer Details', 'wcvn-onepagcheckout' ),
			),
            'review_order_text' => array(
				'name' => __( 'Review Order', 'wcvn-onepagcheckout' ),
				'desc' => __( 'Repalce "Review Order" with ....', 'wcvn-onepagcheckout' ),
				'type' => 'text',
				'id'   => 'wcvn_onepagcheckout_review_order',
				'placeholder' => __( 'For example :- Order Summary', 'wcvn-onepagcheckout' ),
			),
            'confirm_pay_text' => array(
				'name' => __( 'Confirm & Pay', 'wcvn-onepagcheckout' ),
				'desc' => __( 'Repalce "Confirm & Pay" with ....', 'wcvn-onepagcheckout' ),
				'type' => 'text',
				'id'   => 'wcvn_onepagcheckout_confirm_pay',
				'placeholder' => __( 'For example :- Pay Here', 'wcvn-onepagcheckout' ),
			),
            'text_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wcvn_onepagcheckout_text_title_end'
            )
        );

        return apply_filters( 'wcvn_onepagcheckout_settings', $settings );
    }

}
