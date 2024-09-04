<?php

/**
 * arckytech_scripts description
 * @return [type] [description]
 */
function arckytech_scripts()
{

    /**
     * all css files
     */

    wp_enqueue_style('arckytech-fonts', arckytech_fonts_url(), array(), time());
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', ARCKYTECH_THEME_CSS_DIR . 'bootstrap-rtl.css', array());
    } else {
        wp_enqueue_style('bootstrap', ARCKYTECH_THEME_CSS_DIR . 'bootstrap.css', array());
    }
    wp_enqueue_style('bootrap-min', ARCKYTECH_THEME_CSS_DIR . 'bootstrap.min.css', []);
    wp_enqueue_style('animate', ARCKYTECH_THEME_CSS_DIR . 'animate.css', []);
    wp_enqueue_style('animate-min', ARCKYTECH_THEME_CSS_DIR . 'animate.min.css', []);
    wp_enqueue_style('custom-animate', ARCKYTECH_THEME_CSS_DIR . 'custom-animate.css', []);
    wp_enqueue_style('fontawesome', ARCKYTECH_THEME_CSS_DIR . 'fontawesome.min.css', []);
    wp_enqueue_style('fontawesome-pro', ARCKYTECH_THEME_CSS_DIR . 'font-awesome-pro.css', []);
    wp_enqueue_style('magnific-popup', ARCKYTECH_THEME_CSS_DIR . 'magnific-popup.css', []);
    wp_enqueue_style('odometer', ARCKYTECH_THEME_CSS_DIR . 'odometer.min.css', []);
    wp_enqueue_style('swiper', ARCKYTECH_THEME_CSS_DIR . 'swiper.min.css', []);
    wp_enqueue_style('style', ARCKYTECH_THEME_CSS_DIR . 'style.css', []);
    wp_enqueue_style('arckytech-unit', ARCKYTECH_THEME_CSS_DIR . 'arckytech-unit.css', [], time());
    wp_enqueue_style('twentytwenty', ARCKYTECH_THEME_CSS_DIR . 'twentytwenty.css', []);
    wp_enqueue_style('spacing', ARCKYTECH_THEME_CSS_DIR . 'spacing.css', []);
    wp_enqueue_style('arckytec-responsive', ARCKYTECH_THEME_CSS_DIR . 'arckytec-responsive.css', []);
    wp_enqueue_style('arckytec', ARCKYTECH_THEME_CSS_DIR . 'arckytec.css', []);
    wp_enqueue_style('arckytech-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-bundle',  ARCKYTECH_THEME_JS_DIR. 'bootstrap-bundle.js', ['jquery'], '', true);
    wp_enqueue_script('apear',  ARCKYTECH_THEME_JS_DIR. 'jquery.appear.min.js', ['jquery'], '', true);
    wp_enqueue_script('magnific-popup',  ARCKYTECH_THEME_JS_DIR. 'magnific-popup.js', ['jquery'], '', true);
    wp_enqueue_script('validate',  ARCKYTECH_THEME_JS_DIR. 'jquery.validate.min.js', ['jquery'], '', true);
    wp_enqueue_script('odometer',  ARCKYTECH_THEME_JS_DIR. 'odometer.min.js', ['jquery'], '', true);
    wp_enqueue_script('swiper',  ARCKYTECH_THEME_JS_DIR. 'swiper.min.js', ['jquery'], '', true);
    wp_enqueue_script('swiper-bundle',  ARCKYTECH_THEME_JS_DIR. 'swiper-bundle.js', ['jquery'], false, true);
    wp_enqueue_script('slider',  ARCKYTECH_THEME_JS_DIR. 'slider-init.js', ['jquery'], '', true);
    wp_enqueue_script('wow',  ARCKYTECH_THEME_JS_DIR. 'wow.js', ['jquery'], false, true);
    wp_enqueue_script('marquee',  ARCKYTECH_THEME_JS_DIR. 'marquee.min.js', ['jquery'], false, true);
    wp_enqueue_script('circle-type',  ARCKYTECH_THEME_JS_DIR. 'jquery.circleType.js', ['jquery'], false, true);
    wp_enqueue_script('lettering',  ARCKYTECH_THEME_JS_DIR. 'jquery.lettering.min.js', ['jquery'], false, true);
    wp_enqueue_script('move',  ARCKYTECH_THEME_JS_DIR. 'jquery.event.move.js', ['jquery'], '', true);
    wp_enqueue_script('twentytwenty',  ARCKYTECH_THEME_JS_DIR. 'twentytwenty.js', ['jquery'], false, true);
    wp_enqueue_script('nice-select',  ARCKYTECH_THEME_JS_DIR. 'nice-select.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('arckytec',  ARCKYTECH_THEME_JS_DIR. 'arckytec.js', ['jquery'], '1.0.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script('arckytech-main', 'arckytec', array(
        'ajax_url'  => admin_url('admin-ajax.php'),
        '_nonce'    => wp_create_nonce('portfolio')
    ));
}
add_action('wp_enqueue_scripts', 'arckytech_scripts');

/*
Register Fonts
 */
function arckytech_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'arckytec')) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Syne:wght@400;500;600;700;800&display=swap&display=swap&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap&family=Prata&display=swap');
    }
    return $font_url;
}
