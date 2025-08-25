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
        
        $this->add_responsive_control(
            'posts_per_view',
            [
                'label' => 'Posts Per View',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => '1',
                    '2' => '2', 
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-carousel' => '--slides-per-view: {{VALUE}};',
                ],
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
            'show_category',
            [
                'label' => 'Show Category Badge',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_read_more',
            [
                'label' => 'Show Read More',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'title_only_mode',
            [
                'label' => 'Title Only Mode',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => 'Show only title without excerpt, date, author, or read more',
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
        
        // Category Badge Style Section
        $this->start_controls_section(
            'category_style_section',
            [
                'label' => 'Category Badge Style',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'category_background',
            [
                'label' => 'Background Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e74c3c',
                'selectors' => [
                    '{{WRAPPER}} .post-category a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'category_text_color',
            [
                'label' => 'Text Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .post-category a' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'selector' => '{{WRAPPER}} .post-category a',
            ]
        );
        
        $this->add_control(
            'category_padding',
            [
                'label' => 'Padding',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'default' => [
                    'top' => 4,
                    'right' => 8,
                    'bottom' => 4,
                    'left' => 8,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'category_border_radius',
            [
                'label' => 'Border Radius',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 2,
                    'right' => 2,
                    'bottom' => 2,
                    'left' => 2,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                                <article class="post-card <?php echo esc_attr($settings['layout_style']); ?> <?php echo $settings['title_only_mode'] === 'yes' ? 'title-only' : ''; ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="post-content">
                                        <?php if ($settings['show_category'] === 'yes') :
                                        $categories = get_the_category();
                                        if (!empty($categories)) : ?>
                                            <div class="post-category">
                                                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                                                    <?php echo esc_html($categories[0]->name); ?>
                                                </a>
                                            </div>
                                        <?php endif; endif; ?>
                                        
                                        <?php if ($settings['show_title'] === 'yes') : ?>
                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                        <?php endif; ?>
                                        
                                        <?php if ($settings['title_only_mode'] !== 'yes') : ?>
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
                                            
                                            <?php if ($settings['show_read_more'] === 'yes') : ?>
                                                <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <?php if ($settings['show_navigation'] === 'yes') : ?>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    <?php endif; ?>
                </div>
                
                <?php if ($settings['show_pagination'] === 'yes') : ?>
                    <div class="swiper-pagination"></div>
                <?php endif; ?>
                
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
    
    protected function content_template() {
        ?>
        <#
        var slidesPerView = settings.posts_per_view || 3;
        var autoplay = settings.autoplay === 'yes';
        var showNavigation = settings.show_navigation === 'yes';
        var showPagination = settings.show_pagination === 'yes';
        #>
        <div class="post-carousel-wrapper">
            <div class="swiper post-carousel" 
                 data-slides-per-view="{{{ slidesPerView }}}"
                 data-slides-per-group="{{{ settings.posts_per_slide || 1 }}}"
                 data-autoplay="{{{ autoplay ? 'yes' : 'no' }}}"
                 data-autoplay-speed="{{{ settings.autoplay_speed || 3000 }}}"
                 data-layout="{{{ settings.layout_style || 'grid' }}}">
                
                <div class="swiper-wrapper">
                    <# for (var i = 1; i <= (settings.posts_per_page || 6); i++) { #>
                        <div class="swiper-slide">
                            <article class="post-card {{{ settings.layout_style || 'grid' }}} <# if (settings.title_only_mode === 'yes') { #>title-only<# } #>">
                                <div class="post-thumbnail">
                                    <a href="#">
                                        <img src="https://via.placeholder.com/400x300/cccccc/666666?text=Post+{{{ i }}}" alt="Post {{{ i }}}">
                                    </a>
                                </div>
                                
                                <div class="post-content">
                                    <# if (settings.show_category === 'yes') { #>
                                        <div class="post-category">
                                            <a href="#">Category</a>
                                        </div>
                                    <# } #>
                                    
                                    <# if (settings.show_title === 'yes') { #>
                                        <h3 class="post-title">
                                            <a href="#">Sample Post Title {{{ i }}}</a>
                                        </h3>
                                    <# } #>
                                    
                                    <# if (settings.title_only_mode !== 'yes') { #>
                                        <# if (settings.show_date === 'yes' || settings.show_author === 'yes') { #>
                                            <div class="post-meta">
                                                <# if (settings.show_date === 'yes') { #>
                                                    <span class="post-date">January 1, 2024</span>
                                                <# } #>
                                                <# if (settings.show_author === 'yes') { #>
                                                    <span class="post-author">by Admin</span>
                                                <# } #>
                                            </div>
                                        <# } #>
                                        
                                        <# if (settings.show_excerpt === 'yes') { #>
                                            <div class="post-excerpt">
                                                This is a sample excerpt for post {{{ i }}}. It shows how the content will look in the carousel.
                                            </div>
                                        <# } #>
                                        
                                        <# if (settings.show_read_more === 'yes') { #>
                                            <a href="#" class="read-more">Read More</a>
                                        <# } #>
                                    <# } #>
                                </div>
                            </article>
                        </div>
                    <# } #>
                </div>
                
                <# if (showNavigation) { #>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                <# } #>
            </div>
            
            <# if (showPagination) { #>
                <div class="swiper-pagination"></div>
            <# } #>
            
            <# if (settings.view_all_text && settings.view_all_url && settings.view_all_url.url) { #>
                <div class="view-all-wrapper">
                    <a href="{{{ settings.view_all_url.url }}}" class="view-all-btn">
                        {{{ settings.view_all_text }}}
                    </a>
                </div>
            <# } #>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            setTimeout(function() {
                if (typeof Swiper !== 'undefined') {
                    $('.post-carousel').each(function() {
                        if (!$(this).hasClass('swiper-initialized')) {
                            var slidesPerView = $(this).data('slides-per-view') || 3;
                            $(this)[0].style.setProperty('--slides-per-view', slidesPerView);
                            
                            var showNavigation = $(this).closest('.post-carousel-wrapper').find('.swiper-button-next').length > 0;
                            var showPagination = $(this).closest('.post-carousel-wrapper').find('.swiper-pagination').length > 0;
                            
                            var swiperConfig = {
                                slidesPerView: 'auto',
                                spaceBetween: 20,
                            };
                            
                            if (showNavigation) {
                                swiperConfig.navigation = {
                                    nextEl: $(this).find('.swiper-button-next')[0],
                                    prevEl: $(this).find('.swiper-button-prev')[0],
                                };
                            }
                            
                            if (showPagination) {
                                swiperConfig.pagination = {
                                    el: $(this).closest('.post-carousel-wrapper').find('.swiper-pagination')[0],
                                    clickable: true,
                                };
                            }
                            
                            new Swiper(this, swiperConfig);
                        }
                    });
                }
            }, 100);
        });
        </script>
        <?php
    }
}