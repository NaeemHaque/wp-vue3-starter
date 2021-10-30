<?php

/**
 * Plugin Name:       Wp-vue3 Starter
 * Description:       Vue 3 & Wordpress plugin starter template by Laravel Mix. vue router added successfully.
 * Version:           1.0.0
 * Author:            Naeem Haque
 * License:           GPL v2 or later
 * Text Domain:       plugin-template
 */

if (!defined('ABSPATH')) {
    exit();
} // No direct access allowed

require_once __DIR__ . '/vendor/autoload.php';


final class Vue3Wordpress
{

    /**
     * Define Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Construct Function
     */
    public function __construct()
    {
        $this->plugin_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);

    }

    /**
     * Plugin Constants
     * @since 1.0.0
     */
    public function plugin_constants()
    {
        define('WV3S_VERSION', self::VERSION);
        define('WV3S_TEMPLATE_PATH', trailingslashit(plugin_dir_path(__FILE__)));
        define('WV3S_URL', trailingslashit(plugins_url('', __FILE__)));
        define('WV3S_ASSETS', WV3S_URL . 'assets/');
    }

    /**
     * Singletone Instance
     * @since 1.0.0
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * On Plugin Activation
     * @since 1.0.0
     */
    public function activate()
    {
        $is_installed = get_option('plugin_is_installed');

        if (!$is_installed) {
            update_option('plugin_is_installed', time());
        }

        update_option('plugin_is_installed', PLUGIN_VERSION);

        //instance of create table class
        $installer = new Includes\Installer();
        $installer->run();
    }

    /**
     * On Plugin De-actiavtion
     * @since 1.0.0
     */
    public function deactivate()
    {

    }

    /**
     * Init Plugin
     * @since 1.0.0
     */
    public function init_plugin()
    {

        new Includes\Assets();


        if (is_admin()) {
            new Includes\Admin();
        } else {
            new Includes\Frontend();
        }

    }

}

function vue3_wordpress(): Vue3Wordpress
{
    return new Vue3Wordpress();
}

vue3_wordpress();