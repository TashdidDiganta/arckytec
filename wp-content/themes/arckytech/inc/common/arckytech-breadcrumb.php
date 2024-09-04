<?php
/**
 * Breadcrumbs for arckytech theme.
 *
 * @package     arckytech
 * @author      themedox
 * @copyright   Copyright (c) 2023, themedox
 * @link        https://www.wphix.com
 * @since       arckytech 1.0.0
 */

function arckytech_breadcrumb_func() {
    global $post;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;
    $title = '';
    
    if ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __(' Our Blog','arckytec'));
    }
    elseif ( is_single() && 'post' == get_post_type() ) {
        $title = get_the_title();
    }
    elseif ( is_single() && 'services' == get_post_type() ) {
        $title = get_the_title();
    }
    elseif ( is_archive() && 'services' == get_post_type() ) {
        $title = '';
    }
    elseif ( is_single() && 'portfolio' == get_post_type() ) {
        $title = 'Single Portfolio';
    }
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'arckytec' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'arckytec' );
        $breadcrumb_show = 0;
    } 
    elseif ( is_archive() ) {
        
        $title = str_replace("<span>", "", get_the_archive_title());
    } 
    else {
        $title = get_the_title();
    }
 

    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    }
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog & Insights','arckytec'));
    }

    $is_breadcrumb = function_exists('get_field')? get_field('is_it_invisible_breadcrumb', $_id) : false;

    $con1 = $breadcrumb_show == 1;
    
    if (  $con1 && !$is_breadcrumb) {
        $bg_img_from_page = function_exists('get_field')? get_field('breadcrumb_background_image') : '';
        $hide_bg_img = function_exists('get_field')? get_field('hide_breadcrumb_background_image') : false;

        // get_theme_mod
        $bg_img = get_theme_mod( 'breadcrumb_image' );

        if ( $hide_bg_img == 'off' ) { 
            $bg_main_img = '';
        }else{  
            $bg_main_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
        }   
    ?>


<!--Page Header Start-->
<section class="page-header">
    <div class="page-header__bg <?php echo esc_attr( $bg_img ? "has-bg" : 'solid-bg'); ?> " style="background-image: url(<?php echo esc_url($bg_main_img); ?>);">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h2>
                <?php
                    if(is_archive() && get_post_type() == 'post'){
                        _e('Archive', 'arckytec');
                    }elseif(is_single() && get_post_type() == 'post'){
                        _e('Blog Details', 'arckytec');
                    }else{
                        echo arckytech_kses( $title );
                    }
                ?>
            </h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'arckytec'); ?></a></li>
                <li><span class="icon-right"></span></li>
                <?php if('services' == get_post_type() && is_single()): ?>
                    <li><a href="#"><?php esc_html_e('Services', 'arckytec'); ?></a></li>
                    <li><span class="icon-right"></span></li>
                <?php endif; ?>
                
                <li><?php echo arckytech_kses( $title ); ?></li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<?php
    }
}

add_action( 'arckytech_before_main_content', 'arckytech_breadcrumb_func' );

