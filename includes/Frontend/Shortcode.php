<?php

namespace Includes\Frontend;

class Shortcode{
    public function __construct()
    {
        add_shortcode('starter', [$this, 'render_shortcode']);
    }
    public function render_shortcode( $atts, $content){
        echo '<h4>Hey! This is Shortcode from wordpress vue plugin starter template</h4>';
    }
}

