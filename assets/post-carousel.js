jQuery(document).ready(function($) {
    $('.post-carousel').each(function() {
        const $carousel = $(this);
        const slidesPerView = parseInt($carousel.data('slides-per-view')) || 3;
        const slidesPerGroup = parseInt($carousel.data('slides-per-group')) || 1;
        const autoplay = $carousel.data('autoplay') === 'yes';
        const autoplaySpeed = parseInt($carousel.data('autoplay-speed')) || 3000;
        const layout = $carousel.data('layout') || 'grid';
        
        // Responsive breakpoints
        const breakpoints = {
            320: {
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 10
            },
            768: {
                slidesPerView: Math.min(2, slidesPerView),
                slidesPerGroup: Math.min(2, slidesPerGroup),
                spaceBetween: 15
            },
            1024: {
                slidesPerView: slidesPerView,
                slidesPerGroup: slidesPerGroup,
                spaceBetween: 20
            }
        };
        
        // Masonry layout handling
        if (layout === 'masonry') {
            $carousel.find('.swiper-wrapper').addClass('masonry');
            return; // Skip Swiper initialization for masonry
        }
        
        // Initialize Swiper
        const swiper = new Swiper($carousel[0], {
            slidesPerView: slidesPerView,
            slidesPerGroup: slidesPerGroup,
            spaceBetween: 20,
            loop: false,
            grabCursor: true,
            
            // Responsive breakpoints
            breakpoints: breakpoints,
            
            // Navigation arrows
            navigation: {
                nextEl: $carousel.find('.swiper-button-next')[0],
                prevEl: $carousel.find('.swiper-button-prev')[0],
            },
            
            // Pagination
            pagination: {
                el: $carousel.find('.swiper-pagination')[0],
                clickable: true,
                dynamicBullets: true,
            },
            
            // Autoplay
            autoplay: autoplay ? {
                delay: autoplaySpeed,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            } : false,
            
            // Effects
            effect: 'slide',
            speed: 600,
            
            // Accessibility
            a11y: {
                prevSlideMessage: 'Previous slide',
                nextSlideMessage: 'Next slide',
                paginationBulletMessage: 'Go to slide {{index}}',
            },
            
            // Keyboard control
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Mouse wheel control
            mousewheel: {
                forceToAxis: true,
            },
            
            // Events
            on: {
                init: function() {
                    // Add loaded class for animations
                    $carousel.addClass('swiper-loaded');
                    
                    // Lazy loading images
                    $carousel.find('img').each(function() {
                        const $img = $(this);
                        if ($img.attr('data-src')) {
                            $img.attr('src', $img.attr('data-src'));
                            $img.removeAttr('data-src');
                        }
                    });
                },
                
                slideChange: function() {
                    // Update active slide styling
                    $carousel.find('.swiper-slide').removeClass('slide-active');
                    $carousel.find('.swiper-slide-active').addClass('slide-active');
                },
                
                reachEnd: function() {
                    // Handle end of slides
                    $carousel.addClass('swiper-end');
                },
                
                reachBeginning: function() {
                    // Handle beginning of slides
                    $carousel.removeClass('swiper-end');
                }
            }
        });
        
        // Handle window resize
        $(window).on('resize', function() {
            if (swiper) {
                swiper.update();
            }
        });
        
        // Pause autoplay on hover
        if (autoplay) {
            $carousel.on('mouseenter', function() {
                swiper.autoplay.stop();
            }).on('mouseleave', function() {
                swiper.autoplay.start();
            });
        }
        
        // Handle touch events for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        $carousel.on('touchstart', function(e) {
            touchStartX = e.originalEvent.changedTouches[0].screenX;
        });
        
        $carousel.on('touchend', function(e) {
            touchEndX = e.originalEvent.changedTouches[0].screenX;
            handleSwipe();
        });
        
        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next slide
                    swiper.slideNext();
                } else {
                    // Swipe right - previous slide
                    swiper.slidePrev();
                }
            }
        }
        
        // Store swiper instance for external access
        $carousel.data('swiper', swiper);
    });
    
    // Handle view all button clicks
    $('.view-all-btn').on('click', function(e) {
        const $btn = $(this);
        const href = $btn.attr('href');
        
        // Add loading state
        $btn.addClass('loading').text('Loading...');
        
        // Analytics tracking (if available)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'click', {
                'event_category': 'Post Carousel',
                'event_label': 'View All Button',
                'value': href
            });
        }
        
        // Restore button state after navigation
        setTimeout(function() {
            $btn.removeClass('loading');
        }, 1000);
    });
    
    // Intersection Observer for lazy loading
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                }
            });
        });
        
        $('.post-carousel img[data-src]').each(function() {
            imageObserver.observe(this);
        });
    }
});