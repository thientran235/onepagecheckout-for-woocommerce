<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div id="woocommerce-form-coupon-lightbox" class="onepagecheckout-box">
	<div class="onepagecheckout-close">✕</div>
	<form class="checkout_coupon woocommerce-form-coupon" method="post">
		<div class="onepagecheckout-lightbox-title"><?php esc_html_e( 'Coupon code', 'wcvn-onepagecheckout' ); ?></div>
		<p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'wcvn-onepagecheckout' ); ?></p>
		<p class="form-row form-row-first">
			<label for="coupon_code" class=""><?php esc_attr_e( 'Coupon code', 'wcvn-onepagecheckout' ); ?> <abbr class="required" title="required">*</abbr></label>
			<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'wcvn-onepagecheckout' ); ?>" id="coupon_code" value="" />
		</p>
		<p class="form-row form-row-last">
			<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'wcvn-onepagecheckout' ); ?>"><?php esc_html_e( 'Apply coupon', 'wcvn-onepagecheckout' ); ?></button>
		</p>
		<div class="clear"></div>
	</form>
</div>
