<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dizconto.com
 * @since      1.0.0
 *
 * @package    Dizconto
 * @subpackage Dizconto/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dizconto
 * @subpackage Dizconto/admin
 * @author     Dizconto Ltd. <info@dizconto.com>
 */
class Dizconto_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Dizconto_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dizconto_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, DIZCONTO_PLUGIN_URL . 'style.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url(__FILE__) . 'css/dizconto-admin.css', array(), $this->version, 'all' );

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
		 * defined in Dizconto_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dizconto_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url(__FILE__) . 'js/dizconto-admin.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Add plugin action links.
     * @param $actions
     * @return string[]
     */
    public static function add_plugin_action_links ( $actions ) {
        $links = array(
            '<a href="' . admin_url( 'admin.php?page=dizconto' ) . '">Settings</a>',
            '<a href="mailto:info@dizconto.com">Support</a>',
        );
        $actions = array_merge( $links, $actions );
        return $actions;
    }

    /**
     * Register a Wordpress admin menu items and pages.
     *
     * @since    1.0.0
     */
    public function add_admin_display() {
        add_menu_page( 'Dizconto', 'Dizconto', 'manage_options', 'dizconto', function() {
            require_once plugin_dir_path(__FILE__) . 'partials/dizconto-admin-display.php';
        } );
    }

}
