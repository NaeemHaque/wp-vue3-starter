<?php

namespace Includes;

/**
 * assets handlers class
 */
class Assets
{

    /**
     * Class constructor
     */
    function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'register_assets']);
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts()
    {
        return [
            'main-script' => [
                'src' => WV3S_ASSETS . 'js/index.js',
                'version' => '1.0',
            ]
        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles()
    {
        return [
            'main-style' => [
                'src' => WV3S_ASSETS . 'css/style.css',
                'version' => '1.0',
            ]
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets()
    {
        $scripts = $this->get_scripts();
        $styles = $this->get_styles();

        foreach ($scripts as $handle => $script) {
            $deps = $script['deps'] ?? false;

            wp_enqueue_script($handle, $script['src'], $deps, $script['version'], true);
        }

        foreach ($styles as $handle => $style) {
            $deps = $style['deps'] ?? false;

            wp_enqueue_style($handle, $style['src'], $deps, $style['version']);
        }


    }
}