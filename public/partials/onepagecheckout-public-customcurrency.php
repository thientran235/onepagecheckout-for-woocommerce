<?php

/**
 * Provide a public area view for the custom currrency
 *
 *
 * @link       https://github.com/thientran235/wcvn-one-page-checkout
 * @since      1.0.0
 *
 * @package    WCVN_OnePageCheckout
 * @subpackage WCVN_OnePageCheckout/public/partials
 */

class WCVN_OnePageCheckout_CustomCurrency {

	/**
	 * The new symbol of the VND currency
	 * @var string
	 * @use change_currency_symbol()
	 */
	protected $new_symbol;
	/**
	 * @var string
	 * @use convert_price_thousand_to_k()
	 */
	protected $thousand_text;

	public function __construct() {
		add_filter( 'woocommerce_currency_symbol', array( $this, 'filter_woocommerce_currency_symbol' ), 10, 2 );
		add_filter( 'formatted_woocommerce_price', array( $this, 'filter_formatted_woocommerce_price' ), 10, 5 );
	}

	public function filter_woocommerce_currency_symbol( $currency_symbol, $currency ) {
		if ( get_option( 'wcvn_onepagcheckout_currency_symbol', 'no' ) == 'yes' ) {
			$currency_symbol = get_option( 'wcvn_onepagcheckout_currency_symbol_text', 'VND' );
		}

		return $currency_symbol;
	}

	public function filter_formatted_woocommerce_price( $formatted_price, $price, $decimals, $decimal_separator, $thousand_separator ) {
		if (get_option( 'wcvn_onepagcheckout_convert_price', 'no' ) == 'yes' ) {
			$thousand_text = get_option( 'wcvn_onepagcheckout_convert_price_text', 'K' );
			if ( $price < 1000 ) {
				return $formatted_price;
			} else {
				$new_formatted_price = number_format( $price / 1000, $decimals, $decimal_separator, $thousand_separator ) . $thousand_text;

				return $new_formatted_price;
			}
		}

		return $formatted_price;
	}
}
