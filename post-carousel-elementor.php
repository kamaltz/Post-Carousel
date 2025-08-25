<?php
/**
 * Plugin Name: Post Carousel Elementor
 * Description: Custom Elementor widget for post carousel with advanced customization
 * Version: 1.0.1
 * Author: kamaltz
 */

if (!defined('ABSPATH')) {
    exit;
}

define('POST_CAROUSEL_ELEMENTOR_URL', plugin_dir_url(__FILE__));
define('POST_CAROUSEL_ELEMENTOR_PATH', plugin_dir_path(__FILE__));

class Post_Carousel_Elementor {
    
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }
    
    public function init() {
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }
        
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }
    
    public function admin_notice_missing_elementor() {
        echo '<div class="notice notice-warning is-dismissible"><p>Post Carousel Elementor requires Elementor to be installed and activated.</p></div>';
    }
    
    public function register_widgets() {
        require_once POST_CAROUSEL_ELEMENTOR_PATH . 'widgets/post-carousel-widget.php';
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Post_Carousel_Widget());
    }
    
    public function enqueue_scripts() {
        wp_enqueue_script('swiper', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', [], '8.0.0', true);
        wp_enqueue_style('swiper', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', [], '8.0.0');
        wp_enqueue_script('post-carousel-script', POST_CAROUSEL_ELEMENTOR_URL . 'assets/post-carousel.js', ['jquery', 'swiper'], '1.0.0', true);
        wp_enqueue_style('post-carousel-style', POST_CAROUSEL_ELEMENTOR_URL . 'assets/post-carousel.css', [], '1.0.0');
    }
}

new Post_Carousel_Elementor();