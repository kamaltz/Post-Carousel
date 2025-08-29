jQuery(document).ready(function($) {
    function initCarousels() {
        if (typeof Swiper === 'undefined') {
            setTimeout(initCarousels, 100);
            return;
        }
        
        $('.post-carousel').each(function() {
            const $carousel = $(this);
            const slidesPerView = parseInt($carousel.data('slides-per-view')) || 3;
            const slidesPerGroup = parseInt($carousel.data('slides-per-group')) || 1;
            const autoplay = $carousel.data('autoplay') === 'yes';
            const autoplaySpeed = parseInt($carousel.data('autoplay-speed')) || 5000;
            const slideSpeed = parseInt($carousel.data('slide-speed')) || 600;
            const layout = $carousel.data('layout') || 'grid';
            
            if ($carousel.hasClass('swiper-initialized')) {
                return;
            }
            
            if (layout === 'masonry') {
                $carousel.find('.swiper-wrapper').addClass('masonry');
                return;
            }
            
            $carousel[0].style.setProperty('--slides-per-view', slidesPerView);
            
            var config = {
                slidesPerView: slidesPerView,
                slidesPerGroup: slidesPerGroup,
                spaceBetween: 20,
                loop: false,
                grabCursor: true,
                speed: slideSpeed,
                
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        slidesPerGroup: 1,
                        spaceBetween: 15
                    },
                    768: {
                        slidesPerView: Math.min(2, slidesPerView),
                        slidesPerGroup: 1,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: slidesPerView,
                        slidesPerGroup: slidesPerGroup,
                        spaceBetween: 20
                    }
                }
            };
            
            if ($carousel.find('.swiper-button-next').length > 0) {
                config.navigation = {
                    nextEl: $carousel.find('.swiper-button-next')[0],
                    prevEl: $carousel.find('.swiper-button-prev')[0],
                };
            }
            
            if ($carousel.closest('.post-carousel-wrapper').find('.swiper-pagination').length > 0) {
                config.pagination = {
                    el: $carousel.closest('.post-carousel-wrapper').find('.swiper-pagination')[0],
                    clickable: true,
                    dynamicBullets: true,
                };
            }
            
            if (autoplay) {
                config.autoplay = {
                    delay: autoplaySpeed,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                };
            }
            
            const swiper = new Swiper($carousel[0], config);
            
            $carousel.data('swiper', swiper);
        });
    }
    
    initCarousels();
    
    if (window.elementorFrontend) {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/post_carousel.default', function($scope) {
            setTimeout(function() {
                $scope.find('.post-carousel').each(function() {
                    const $carousel = $(this);
                    if (!$carousel.hasClass('swiper-initialized')) {
                        const slidesPerView = parseInt($carousel.data('slides-per-view')) || 3;
                        const autoplay = $carousel.data('autoplay') === 'yes';
                        const autoplaySpeed = parseInt($carousel.data('autoplay-speed')) || 5000;
                        const slideSpeed = parseInt($carousel.data('slide-speed')) || 600;
                        
                        $carousel[0].style.setProperty('--slides-per-view', slidesPerView);
                        
                        var config = {
                            slidesPerView: slidesPerView,
                            spaceBetween: 20,
                            speed: slideSpeed,
                            breakpoints: {
                                320: { slidesPerView: 1 },
                                768: { slidesPerView: Math.min(2, slidesPerView) },
                                1024: { slidesPerView: slidesPerView }
                            }
                        };
                        
                        if ($carousel.find('.swiper-button-next').length > 0) {
                            config.navigation = {
                                nextEl: $carousel.find('.swiper-button-next')[0],
                                prevEl: $carousel.find('.swiper-button-prev')[0],
                            };
                        }
                        
                        if ($carousel.closest('.post-carousel-wrapper').find('.swiper-pagination').length > 0) {
                            config.pagination = {
                                el: $carousel.closest('.post-carousel-wrapper').find('.swiper-pagination')[0],
                                clickable: true,
                            };
                        }
                        
                        if (autoplay) {
                            config.autoplay = {
                                delay: autoplaySpeed,
                                disableOnInteraction: false,
                            };
                        }
                        
                        new Swiper($carousel[0], config);
                    }
                });
            }, 200);
        });
    }
    
    $(document).on('elementor/render/widget', function() {
        setTimeout(initCarousels, 300);
    });
});