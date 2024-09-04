<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package arckytech
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function arckytech_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    if ( !is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    if ( !empty($get_user) ) {
        $classes[] = 'profile-breadcrumb';
    }

    return $classes;
}
add_filter( 'body_class', 'arckytech_body_classes' );

/**
 * Get tags.
 */
function arckytech_get_tag() {
    $html = '';
    if ( has_tag() ) {
        $html .= '<p class="blog-details__tags"><span>' . esc_html__( 'Tags : ', 'arckytec' ) . '</span>';
        $html .= get_the_tag_list( '', ' ', '' );
        $html .= '</p>';
    }
    return $html;
}

/**
 * Get categories.
 */
function arckytech_get_category() {

    $categories = get_the_category( get_the_ID() );
    $x = 0;
    foreach ( $categories as $category ) {

        if ( $x == 2 ) {
            break;
        }
        $x++;
        print '<a class="news-tag" href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a>';

    }
}

/** img alt-text **/
function arckytech_img_alt_text( $img_er_id = null ) {
    $image_id = $img_er_id;
    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', false );
    $image_title = get_the_title( $image_id );

    if ( !empty( $image_id ) ) {
        if ( $image_alt ) {
            $alt_text = get_post_meta( $image_id, '_wp_attachment_image_alt', false );
        } else {
            $alt_text = get_the_title( $image_id );
        }
    } else {
        $alt_text = esc_html__( 'Image Alt Text', 'arckytec' );
    }

    return $alt_text;
}

// arckytech_ofer_sidebar_func
function arckytech_offer_sidebar_func() {
    if ( is_active_sidebar( 'offer-sidebar' ) ) {

        dynamic_sidebar( 'offer-sidebar' );
    }
}
add_action( 'arckytech_offer_sidebar', 'arckytech_offer_sidebar_func', 20 );

// arckytech_service_sidebar
function arckytech_service_sidebar_func() {
    if ( is_active_sidebar( 'services-sidebar' ) ) {

        dynamic_sidebar( 'services-sidebar' );
    }
}
add_action( 'arckytech_service_sidebar', 'arckytech_service_sidebar_func', 20 );

// arckytech_portfolio_sidebar
function arckytech_portfolio_sidebar_func() {
    if ( is_active_sidebar( 'portfolio-sidebar' ) ) {

        dynamic_sidebar( 'portfolio-sidebar' );
    }
}
add_action( 'arckytech_portfolio_sidebar', 'arckytech_portfolio_sidebar_func', 20 );

// arckytech_faq_sidebar
function arckytech_faq_sidebar_func() {
    if ( is_active_sidebar( 'faq-sidebar' ) ) {

        dynamic_sidebar( 'faq-sidebar' );
    }
}
add_action( 'arckytech_faq_sidebar', 'arckytech_faq_sidebar_func', 20 );