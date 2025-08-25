=== Post Carousel Elementor ===
Contributors: yourname
Tags: elementor, carousel, posts, slider, widget
Requires at least: 5.0
Tested up to: 6.3
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL v2 or later

Custom Elementor widget for creating beautiful post carousels with advanced customization options.

== Description ==

Post Carousel Elementor adalah plugin yang memungkinkan Anda membuat carousel post yang menarik dengan berbagai opsi kustomisasi. Plugin ini terinspirasi dari desain 807garage.com dan menyediakan kontrol penuh atas tampilan dan fungsionalitas carousel.

**Fitur Utama:**

* **Kustomisasi Konten Post**
  - Pilih kategori post tertentu
  - Atur jumlah post yang ditampilkan
  - Kontrol tampilan title, excerpt, tanggal, dan author
  - Thumbnail post otomatis

* **Pengaturan Layout**
  - 3 style layout: Grid, List, dan Masonry
  - Atur jumlah post per view (1-6)
  - Atur jumlah post per slide (1-3)
  - Responsive design untuk semua device

* **Kontrol Navigasi**
  - Navigation arrows (dapat diaktifkan/nonaktifkan)
  - Pagination dots dengan dynamic bullets
  - Autoplay dengan pengaturan kecepatan
  - Touch/swipe support untuk mobile

* **Kustomisasi Style**
  - Warna background card
  - Border dan border radius
  - Box shadow effects
  - Typography untuk title dan excerpt
  - Hover effects dan transitions

* **Tombol View All**
  - Teks tombol dapat dikustomisasi
  - Link ke halaman artikel portal
  - Style button yang dapat disesuaikan
  - Analytics tracking support

**Teknologi yang Digunakan:**
- Swiper.js untuk carousel functionality
- Elementor Widget API
- Responsive CSS Grid/Flexbox
- Intersection Observer untuk lazy loading

== Installation ==

1. Upload folder plugin ke direktori `/wp-content/plugins/`
2. Aktifkan plugin melalui menu 'Plugins' di WordPress admin
3. Pastikan Elementor sudah terinstall dan aktif
4. Buka Elementor editor dan cari widget "Post Carousel" di panel widgets

== Frequently Asked Questions ==

= Apakah plugin ini memerlukan Elementor Pro? =
Tidak, plugin ini bekerja dengan Elementor versi gratis.

= Bisakah saya menggunakan custom post types? =
Saat ini plugin hanya mendukung post type 'post' standar WordPress.

= Apakah responsive di mobile? =
Ya, plugin ini fully responsive dengan breakpoints untuk mobile, tablet, dan desktop.

= Bisakah saya menambahkan custom CSS? =
Ya, Anda bisa menambahkan custom CSS melalui Elementor atau theme customizer.

== Screenshots ==

1. Widget settings panel di Elementor editor
2. Grid layout example
3. List layout example  
4. Masonry layout example
5. Mobile responsive view

== Changelog ==

= 1.0.0 =
* Initial release
* Grid, List, dan Masonry layouts
* Full Elementor integration
* Responsive design
* Swiper.js carousel functionality
* View All button feature

== Upgrade Notice ==

= 1.0.0 =
Initial release of Post Carousel Elementor plugin.

== Developer Notes ==

**File Structure:**
```
post-carousel-elementor/
├── post-carousel-elementor.php (Main plugin file)
├── widgets/
│   └── post-carousel-widget.php (Elementor widget class)
├── assets/
│   ├── post-carousel.css (Stylesheet)
│   └── post-carousel.js (JavaScript functionality)
└── readme.txt (This file)
```

**Hooks dan Filters:**
- `post_carousel_query_args` - Filter untuk memodifikasi WP_Query arguments
- `post_carousel_post_content` - Filter untuk memodifikasi konten post
- `post_carousel_before_render` - Action sebelum render carousel
- `post_carousel_after_render` - Action setelah render carousel

**Customization Examples:**

```php
// Modify query arguments
add_filter('post_carousel_query_args', function($args) {
    $args['meta_query'] = array(
        array(
            'key' => 'featured',
            'value' => 'yes',
            'compare' => '='
        )
    );
    return $args;
});

// Add custom content
add_action('post_carousel_after_render', function() {
    echo '<div class="carousel-footer">Custom footer content</div>';
});
```

**Browser Support:**
- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- Mobile browsers (iOS Safari, Chrome Mobile)

**Performance Notes:**
- Lazy loading untuk images
- Optimized CSS dan JavaScript
- Minimal DOM manipulation
- Efficient Swiper.js configuration