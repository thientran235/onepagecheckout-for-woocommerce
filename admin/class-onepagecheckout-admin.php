<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://chiasewp.net/wcvn-onepagecheckout
 * @since      1.0.0
 *
 * @package    WCVN_OnePageCheckout
 * @subpackage WCVN_OnePageCheckout/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WCVN_OnePageCheckout
 * @subpackage WCVN_OnePageCheckout/admin
 * @author     Thien Tran <thientran2359@gmail.com>
 */
class WCVN_OnePageCheckout_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wcvn_onepagecheckout    The ID of this plugin.
	 */
	private $wcvn_onepagecheckout;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wcvn_onepagecheckout       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wcvn_onepagecheckout, $version ) {

		$this->wcvn_onepagecheckout = $wcvn_onepagecheckout;
		$this->version = $version;

		/**
		 * The class responsible for defining settings in admin area
		 */
		require_once WCVN_OPC_PATH . 'admin/partials/onepagecheckout-wc-settings.php';

		WC_Settings_Tab_WCVN_OnePageCheckout::init();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WCVN_OnePageCheckout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WCVN_OnePageCheckout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->wcvn_onepagecheckout, WCVN_OPC_URL . 'admin/css/onepagecheckout-admin.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WCVN_OnePageCheckout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WCVN_OnePageCheckout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->wcvn_onepagecheckout, WCVN_OPC_URL . 'admin/js/onepagecheckout-admin.min.js', array( 'jquery' ), $this->version, false );

	}

	public function show_woocommerce_error_message() {
		if ( current_user_can( 'activate_plugins' ) ) {
			$url = 'plugin-install.php?s=woocommerce&tab=search&type=term';
			$title = __( 'WooCommerce', 'wcvn-onepagecheckout' );
			echo '<div class="error"><p>' . sprintf( esc_html( __( 'To begin using "%s" , please install the plugin %s%s%s.', 'wcvn-onepagecheckout' ) ), 'WooCommerceVN One Page Checkout', '<a href="' . esc_url( admin_url( $url ) ) . '" title="' . esc_attr( $title ) . '">', 'WooCommerce', '</a>' ) . '</p></div>';
		}
	}

	public function plugin_redirect() {
		if (get_option('wcvn_onepagecheckout_do_activation_redirect', false)) {
			delete_option('wcvn_onepagecheckout_do_activation_redirect');
			wp_redirect(admin_url( 'admin.php?page=wc-settings&tab=wcvn_onepagcheckout' ) );
		}
    }

	public function action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page=wcvn_onepagecheckout_settings' ) . '">' . __( 'Settings', 'wcvn-onepagecheckout' ) . '</a>';
		$custom_links[] = '<a target="_blank" style="font-weight: 800;" href="https://fb.com/makiosp1">' . __( 'Author FB', 'wcvn-onepagecheckout' ) . '</a>';
		return array_merge( $custom_links, $links );
	}

}
