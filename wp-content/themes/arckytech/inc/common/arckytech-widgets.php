<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function arckytech_widgets_init() {



    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'arckytec' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Set Your Blog Widget', 'arckytec' ),
        'before_widget' => '<div id="%1$s" class="arc-sidebar-widget mb-35 %2$s sidebar__single">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="arc-sidebar-widget-title news-page__sidebar-title">',
        'after_title'   => '</h3>',
    ] );


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    if( 5 > $footer_widgets ){
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'arckytec' ), 1 ),
            'id'            => 'footer-1',
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'arckytec' ), 1 ),
            'before_widget' => '<div id="%1$s" class="arc-footer-widget footer-col-1 %2$s  footer-widget__column">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="footer-widget__title-box"><h3 class="footer-widget__title">',
            'after_title'   => '</h3></div>',
        ]);
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'arckytec' ), 2 ),
            'id'            => 'footer-2',
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'arckytec' ), 2 ),
            'before_widget' => '<div id="%1$s" class="arc-footer-widget footer-col-2 %2$s  footer-widget__column">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="footer-widget__title-box"><h3 class="footer-widget__title">',
            'after_title'   => '</h3></div>',
        ]);
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'arckytec' ), 3 ),
            'id'            => 'footer-3',
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'arckytec' ), 3 ),
            'before_widget' => '<div id="%1$s" class="arc-footer-widget footer-col-3 %2$s  footer-widget__column">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="footer-widget__title-box"><h3 class="footer-widget__title">',
            'after_title'   => '</h3></div>',
        ]);
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'arckytec' ), 4 ),
            'id'            => 'footer-4',
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'arckytec' ), 4 ),
            'before_widget' => '<div id="%1$s" class="arc-footer-widget footer-col-4 %2$s  footer-widget__column">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="footer-widget__title-box"><h3 class="footer-widget__title">',
            'after_title'   => '</h3></div>',
        ]);
    }else{
        // footer default
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer %1$s', 'arckytec' ), $num ),
                'id'            => 'footer-' . $num,
                'description'   => sprintf( esc_html__( 'Footer column %1$s', 'arckytec' ), $num ),
                'before_widget' => '<div id="%1$s" class="arc-footer-widget footer-col-'.$num.' %2$s  footer-widget__column ">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="footer-widget__title-box"><h3 class="footer-widget__title">',
                'after_title'   => '</h3></div>',
            ]);
        }
    }

    
}
add_action( 'widgets_init', 'arckytech_widgets_init' );