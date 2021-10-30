<?php

namespace Includes\Admin;

class Menu
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu()
    {
        $parent_slug = 'plugin-menu';
        $capability = 'manage_options';
        add_menu_page(
            __('Vue Wordpress', ' plugin-template'),
            __('Vue Wordpress', ' plugin-template'),
            $capability,
            $parent_slug,
            [$this, 'side_menu'],
            'dashicons-menu',
            115
        );


    }

    public function side_menu()
    {
        echo '<div id="app"></div>';
    }

}