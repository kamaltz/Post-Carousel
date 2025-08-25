<?php
if (!defined('ABSPATH')) {
    exit;
}

class Post_Carousel_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'post_carousel';
    }
    
    public function get_title() {
        return 'Post Carousel';
    }
    
    public function get_icon() {
        return 'eicon-posts-carousel';
    }
    
    public function get_categories() {
        return ['general'];
    }
    
    protected function _register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Content Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'posts_per_page',
            [
                'label' => 'Posts to Show',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 20,
            ]
        );
        
        $this->add_control(
            'posts_per_view',
            [
                'label' => 'Posts Per View',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 6,
            ]
        );
        
        $this->add_control(
            'posts_per_slide',
            [
                'label' => 'Posts Per Slide',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 1,
                'max' => 3,
            ]
        );
        
        $this->add_control(
            'post_category',
            [
                'label' => 'Category',
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_categories_list(),
                'multiple' => true,
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'show_title',
            [
                'label' => 'Show Title',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_excerpt',
            [
                'label' => 'Show Excerpt',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_date',
            [
                'label' => 'Show Date',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_author',
            [
                'label' => 'Show Author',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'view_all_text',
            [
                'label' => 'View All Button Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'View All Articles',
            ]
        );
        
        $this->add_control(
            'view_all_url',
            [
                'label' => 'View All URL',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-site.com/articles',
            ]
        );
        
        $this->end_controls_section();
        
        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => 'Layout Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'layout_style',
            [
                'label' => 'Layout Style',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => 'Grid',
                    'list' => 'List',
                    'masonry' => 'Masonry',
                ],
            ]
        );
        
        $this->add_control(
            'show_navigation',
            [
                'label' => 'Show Navigation',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_pagination',
            [
                'label' => 'Show Pagination',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'autoplay',
            [
                'label' => 'Autoplay',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'autoplay_speed',
            [
                'label' => 'Autoplay Speed (ms)',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => 'Style',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'card_background',
            [
                'label' => 'Card Background',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .post-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .post-card',
            ]
        );
        
        $this->add_control(
            'card_border_radius',
            [
                'label' => 'Border Radius',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_shadow',
                'selector' => '{{WRAPPER}} .post-card',
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => 'Title Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .post-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .post-title',
            ]
        );
        
        $this->add_control(
            'excerpt_color',
            [
                'label' => 'Excerpt Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .post-excerpt',
            ]
        );
        
        $this->end_controls_section();
        
        // Button Style Section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => 'Button Style',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'button_background',
            [
                'label' => 'Background Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#007cba',
                'selectors' => [
                    '{{WRAPPER}} .view-all-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'button_text_color',
            [
                'label' => 'Text Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .view-all-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .view-all-btn',
            ]
        );
        
        $this->add_control(
            'button_padding',
            [
                'label' => 'Padding',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .view-all-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    
    private function get_categories_list() {
        $categories = get_categories();
        $options = [];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }
        return $options;
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'post_status' => 'publish',
        ];
        
        if (!empty($settings['post_category'])) {
            $args['cat'] = implode(',', $settings['post_category']);
        }
        
        $posts = new WP_Query($args);
        
        if ($posts->have_posts()) : ?>
            <div class="post-carousel-wrapper">
                <div class="swiper post-carousel" 
                     data-slides-per-view="<?php echo esc_attr($settings['posts_per_view']); ?>"
                     data-slides-per-group="<?php echo esc_attr($settings['posts_per_slide']); ?>"
                     data-autoplay="<?php echo esc_attr($settings['autoplay']); ?>"
                     data-autoplay-speed="<?php echo esc_attr($settings['autoplay_speed']); ?>"
                     data-layout="<?php echo esc_attr($settings['layout_style']); ?>">
                    
                    <div class="swiper-wrapper">
                        <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                            <div class="swiper-slide">
                                <article class="post-card <?php echo esc_attr($settings['layout_style']); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="post-content">
                                        <?php if ($settings['show_title'] === 'yes') : ?>
                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                        <?php endif; ?>
                                        
                                        <?php if ($settings['show_date'] === 'yes' || $settings['show_author'] === 'yes') : ?>
                                            <div class="post-meta">
                                                <?php if ($settings['show_date'] === 'yes') : ?>
                                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                                <?php endif; ?>
                                                <?php if ($settings['show_author'] === 'yes') : ?>
                                                    <span class="post-author">by <?php the_author(); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($settings['show_excerpt'] === 'yes') : ?>
                                            <div class="post-excerpt">
                                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <?php if ($settings['show_navigation'] === 'yes') : ?>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    <?php endif; ?>
                    
                    <?php if ($settings['show_pagination'] === 'yes') : ?>
                        <div class="swiper-pagination"></div>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($settings['view_all_text']) && !empty($settings['view_all_url']['url'])) : ?>
                    <div class="view-all-wrapper">
                        <a href="<?php echo esc_url($settings['view_all_url']['url']); ?>" 
                           class="view-all-btn"
                           <?php echo $settings['view_all_url']['is_external'] ? 'target="_blank"' : ''; ?>
                           <?php echo $settings['view_all_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                            <?php echo esc_html($settings['view_all_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif;
        
        wp_reset_postdata();
    }
}