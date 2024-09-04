<?php
/**
 * Theme Options
 */
new \Kirki\Panel(
    'panel_id',
    [
        'priority'    => 10,
        'title'       => esc_html__( 'Arckytec Customizer', 'arckytec' ),
        'description' => esc_html__( 'Arckytec Customizer Description.', 'arckytec' ),
    ]
);

// body settings
function arckyetc_body_settings(){
 
    new \Kirki\Section(
        'arckyetc_body_settings',
        [
            'title'       => esc_html__( 'Body Settings', 'arckytec' ),
            'description' => esc_html__( 'Body setings for making some changes.', 'arckytec' ),
            'panel'       => 'panel_id',
            'priority'    => 30,
        ]
    );
   
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'body_grid_border',
            'label'       => esc_html__( 'Body Grid', 'arckytec' ),
            'description' => esc_html__( 'Grid On/Off', 'arckytec' ),
            'section'     => 'arckyetc_body_settings',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'arckytec' ),
                'off' => esc_html__( 'Disable', 'arckytec' ),
            ],
        ]
    );
 
}
arckyetc_body_settings();

// header
function header_main_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_main_section',
        [
            'title'       => esc_html__( 'Header Main Settings', 'arckytec' ),
            'description' => esc_html__( 'Header Main Controls.', 'arckytec' ),
            'panel'       => 'panel_id',
            'priority'    => 30,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'arckytech_header_elementor_switch',
            'label'       => esc_html__( 'Header Custom/Elementor Switch', 'arckytec' ),
            'description' => esc_html__( 'Header Custom/Elementor On/Off', 'arckytec' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'arckytec' ),
                'off' => esc_html__( 'Disable', 'arckytec' ),
            ],
        ]
    ); 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'header_layout_custom',
            'label'       => esc_html__( 'Chose Header Style', 'arckytec' ),
            'section'     => 'header_main_section',
            'priority'    => 10,
            'choices'     => [
                'header_1'  => get_template_directory_uri() . '/inc/img/header/header-1.png',
            ],
            'default'     => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'arckytech_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_posttype = array(
        'post_type'      => 'arc-header',
        'posts_per_page' => -1,
    );
    $header_posttype_loop = get_posts($header_posttype);

    $header_post_obj_arr = array();
    foreach($header_posttype_loop as $post){
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }


    wp_reset_query();


    new \Kirki\Field\Select(
        [
            'settings'    => 'arckytech_header_templates',
            'label'       => esc_html__( 'Elementor Header Template', 'arckytec' ),
            'section'     => 'header_main_section',
            'placeholder' => esc_html__( 'Choose an option', 'arckytec' ),
            'choices'     => $header_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'arckytech_header_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
   
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_switch',
            'label'       => esc_html__( 'Header Right Switch', 'arckytec' ),
            'description' => esc_html__( 'Header Right On/Off', 'arckytec' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'arckytec' ),
                'off' => esc_html__( 'Disable', 'arckytec' ),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'contact_title',
            'label'    => esc_html__( 'Contact Title', 'arckytec' ),
            'section'  => 'header_main_section',
            'default'  => esc_html__( 'Need Help:', 'arckytec' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'header_right_switch',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'contact_number',
            'label'    => esc_html__( 'Contact Number', 'arckytec' ),
            'section'  => 'header_main_section',
            'default'  => esc_html__( '+9(406)555-0120', 'arckytec' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'header_right_switch',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );


    new \Kirki\Field\URL(
        [
            'settings' => 'contact_link',
            'label'    => esc_html__( 'Contact link', 'arckytec' ),
            'section'  => 'header_main_section',
            'default'  => '+9(406)555-0120',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'header_right_switch',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'sticky_header',
            'label'       => esc_html__( 'Sticky Header', 'arckytec' ),
            'description' => esc_html__( 'Sticky Header On/Off', 'arckytec' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'arckytec' ),
                'off' => esc_html__( 'Disable', 'arckytec' ),
            ],
        ]
    );
 
}
header_main_section();

// Preloader
function preloader_section(){

    new \Kirki\Section(
        'preloader_section',
        [
            'title'       => esc_html__( 'Preloader Settings', 'arckytec' ),
            'description' => esc_html__( 'Preloader Controls.', 'arckytec' ),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'arckytech_preloader_switch',
            'label'       => esc_html__( 'Preloader Switch', 'arckytec' ),
            'description' => esc_html__( 'Preloader On/Off', 'arckytec' ),
            'section'     => 'preloader_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'arckytec' ),
                'off' => esc_html__( 'Disable', 'arckytec' ),
            ],
        ]
    ); 

    new \Kirki\Field\Image(
        [
            'settings'    => 'arckytech_preloader_logo',
            'label'       => esc_html__( 'Preloader Logo Icon', 'arckytec' ),
            'description' => esc_html__( 'Preloader Logo Here', 'arckytec' ),
            'section'     => 'preloader_section',
            'default'     => get_template_directory_uri() . '/assets/img/loader.png',
        ]
    );   
}

preloader_section();

// offcanvas_side_section
function offcanvas_side_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'offcanvas_side_section',
        [
            'title'       => esc_html__( 'Offcanvas Info', 'arckytec' ),
            'description' => esc_html__( 'Offcanvas Information.', 'arckytec' ),
            'panel'       => 'panel_id',
            'priority'    => 110,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'arckytech_offcanvas_enable',
            'label'       => esc_html__( 'Enable/Disable Offcanvas', 'arckytec' ),
            'description' => esc_html__( 'Enable/Disable Offcanvas', 'arckytec' ),
            'section'     => 'offcanvas_side_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'arckytec' ),
                'off' => esc_html__( 'Disable', 'arckytec' ),
            ],
        ]
    ); 

    new \Kirki\Field\Image(
        [
            'settings'    => 'arckytech_offcanvas_logo',
            'label'       => esc_html__( 'Offcanvas Logo', 'arckytec' ),
            'description' => esc_html__( 'Offcanvas Logo Here', 'arckytec' ),
            'section'     => 'offcanvas_side_section',
            'default'     => get_template_directory_uri() . '/assets/img/resources/logo-1.png',
            'active_callback' => [
                [
                    'setting'  => 'arckytech_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    ); 

    new \Kirki\Field\Text(
        [
            'settings' => 'arckytech_offcanvas_title',
            'label'    => esc_html__( 'Give a title', 'arckytec' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'About US', 'arckytec' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'arckytech_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'arckytech_offcanvas_desc',
            'label'    => esc_html__( 'Write a short description', 'arckytec' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut
            labore et magna aliqua. Ut enim ad minim veniam laboris.', 'arckytec' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'arckytech_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );

    

    new \Kirki\Field\Text(
        [
            'settings' => 'arckytech_offcanvas_form_title',
            'label'    => esc_html__( 'Give a form title', 'arckytec' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'Get a free quote', 'arckytec' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'arckytech_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings'    => 'arckytech_offcanvas_form',
            'label'       => esc_html__( 'Form Shortcode', 'arckytec' ),
            'section'     => 'offcanvas_side_section',
            'default'     => '',
            'placeholder' => esc_html__( 'Paste a shortcode here', 'arckytec' ),
            'active_callback' => [
                [
                    'setting'  => 'arckytech_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
}
offcanvas_side_section();


// header_logo_section
function header_logo_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title'       => esc_html__( 'Header Logo', 'arckytec' ),
            'description' => esc_html__( 'Header Logo Settings.', 'arckytec' ),
            'panel'       => 'panel_id',
            'priority'    => 40,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo',
            'label'       => esc_html__( 'Header Logo', 'arckytec' ),
            'description' => esc_html__( 'Theme Default/Primary Logo Here', 'arckytec' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/resources/logo-1.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_secondary_logo',
            'label'       => esc_html__( 'Header Secondary Logo', 'arckytec' ),
            'description' => esc_html__( 'Theme Secondary Logo Here', 'arckytec' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/resources/logo-2.png',
        ]
    );

    // Contacts Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'arckytech_logo_width',
            'label'    => esc_html__( 'Logo Width', 'arckytec' ),
            'section'  => 'header_logo_section',
            'default'  => esc_html__( '135', 'arckytec' ),
            'priority' => 10,
        ]
    );
}
header_logo_section();


// header_breadcrumb_section
function header_breadcrumb_section(){
    new \Kirki\Section(
        'header_breadcrumb_section',
        [
            'title'       => esc_html__( 'Breadcrumb', 'arckytec' ),
            'description' => esc_html__( 'Breadcrumb Settings.', 'arckytec' ),
            'panel'       => 'panel_id',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'breadcrumb_blog_title',
            'label'    => esc_html__( 'Breadcrumb Blog Title', 'arckytec' ),
            'section'  => 'header_breadcrumb_section',
            'default'  => __('Blogs & Insights', 'arckytec'),
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Image(
        [
            'settings'    => 'breadcrumb_image',
            'label'       => esc_html__( 'Breadcrumb Image', 'arckytec' ),
            'description' => esc_html__( 'Breadcrumb Image add/remove', 'arckytec' ),
            'section'     => 'header_breadcrumb_section',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'breadcrumb_bg_color',
            'label'       => __( 'Breadcrumb BG Color', 'arckytec' ),
            'description' => esc_html__( 'You can change breadcrumb bg color from here.', 'arckytec' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => '#f3fbfe',
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings'    => 'breadcrumb_padding',
            'label'       => esc_html__( 'Padding Control', 'arckytec' ),
            'description' => esc_html__( 'Padding', 'arckytec' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => [
                'padding-top'  => '',
                'padding-bottom' => '',
            ],
        ]
    );
    new \Kirki\Field\Typography(
        [
            'settings'    => 'breadcrumb_typography',
            'label'       => esc_html__( 'Typography Control', 'arckytec' ),
            'description' => esc_html__( 'The full set of options.', 'arckytec' ),
            'section'     => 'header_breadcrumb_section',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );


}
header_breadcrumb_section();

// Mobile nav section
function mobile_nav_section(){
    new \Kirki\Section(
        'mobile_nav_drawer',
        [
            'title'       => esc_html__( 'Mobile Nav Drawer', 'arckytec' ),
            'description' => esc_html__( 'Mobile nav settings', 'arckytec' ),
            'panel'       => 'panel_id',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'mobile_nav_logo',
            'label'       => esc_html__( 'Drawer Logo', 'arckytec' ),
            'description' => esc_html__( 'Mobile nav drawer logo', 'arckytec' ),
            'section'     => 'mobile_nav_drawer',
            'default'     => get_template_directory_uri() ."/assets/img/resources/logo-2.png",
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'mobile_nav_email',
            'label'    => esc_html__( 'Email', 'arckytec' ),
            'section'  => 'mobile_nav_drawer',
            'default'  => 'needhelp@arckytech.com',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Text(
        [
            'settings' => 'mobile_nav_tel',
            'label'    => esc_html__( 'Phone', 'arckytec' ),
            'section'  => 'mobile_nav_drawer',
            'default'  => '666 888 0000',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Repeater(
        [
            'settings' => 'mobile_nav_socials',
            'label'    => esc_html__( 'Mobile Nav socials', 'arckytec' ),
            'section'  => 'mobile_nav_drawer',
            'priority' => 10,
            'row_label'    => [
                'type'  => 'field',
                'value' => esc_html__( 'link', 'arckytec' ),
                'field' => 'link_text',
            ],
            'default'  => [
                [
                    'link_text'   => esc_html__( 'fab fa-facebook-square', 'arckytec' ),
                    'link_url'    => 'https://facebook.com/',
                    'link_target' => '_self',
                    'checkbox'    => false,
                ]
            ],
            'fields'   => [
                'link_text'   => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link Text', 'arckytec' ),
                    'description' => esc_html__( 'Description', 'arckytec' ),
                    'default'     => '',
                ],
                'link_url'    => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link URL', 'arckytec' ),
                    'description' => esc_html__( 'Description', 'arckytec' ),
                    'default'     => '',
                ],
                'link_target' => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Link Target', 'arckytec' ),
                    'description' => esc_html__( 'Description', 'arckytec' ),
                    'default'     => '_self',
                    'choices'     => [
                        '_blank' => esc_html__( 'New Window', 'arckytec' ),
                        '_self'  => esc_html__( 'Same Frame', 'arckytec' ),
                    ],
                ]
            ],
        ]
    );

}
mobile_nav_section();

// footer layout
function footer_layout_section(){

    new \Kirki\Section(
        'footer_layout_section',
        [
            'title'       => esc_html__( 'Footer', 'arckytec' ),
            'description' => esc_html__( 'Footer Settings.', 'arckytec' ),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings'    => 'footer_widget_number',
            'label'       => esc_html__( 'Footer Widget Number', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'default'     => '4',
            'placeholder' => esc_html__( 'Choose an option', 'arckytec' ),
            'choices'     => [
                '1' => esc_html__( '1', 'arckytec' ),
                '2' => esc_html__( '2', 'arckytec' ),
                '3' => esc_html__( '3', 'arckytec' ),
                '4' => esc_html__( '4', 'arckytec' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'arckytech_request_elementor_switch',
            'label'       => esc_html__( 'Footer Newsletter', 'arckytec' ),
            'description' => esc_html__( 'Footer Newsletter On/Off', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'arckytec' ),
                'off' => esc_html__( 'Disable', 'arckytec' ),
            ],
        ]
    ); 


    new \Kirki\Field\Image(
        [
            'settings'    => 'newsletter_section_image',
            'label'       => esc_html__( 'Set Cta Image', 'arckytec' ),
            'description' => esc_html__( 'Set request section image.', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'default'     => get_template_directory_uri() . '/assets/img/resources/get-in-touch-img-1.jpg',
            'active_callback' => [
                [
                    'setting' => 'arckytech_request_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]

    );

    new \Kirki\Field\Textarea(
        [
            'settings'    => 'newsletter_section_title',
            'label'       => esc_html__( 'Section Title', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'default'     => wp_kses_post( 'Looking For The Best <br> Architecture & Interior Services' ),
            'active_callback' => [
                [
                    'setting' => 'arckytech_request_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'button_name',
            'label'    => esc_html__( 'Button Name', 'arckytec' ),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__( 'Submit Request', 'arckytec' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'arckytech_request_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'button_url',
            'label'    => esc_html__( 'Button Url', 'arckytec' ),
            'section'  => 'footer_layout_section',
            'default'  => 'https://contact.html',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'arckytech_request_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
    // end request section


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'arckytech_footer_elementor_switch',
            'label'       => esc_html__( 'Footer Custom/Elementor Switch', 'arckytec' ),
            'description' => esc_html__( 'Footer Custom/Elementor On/Off', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'arckytec' ),
                'off' => esc_html__( 'Disable', 'arckytec' ),
            ],
        ]
    ); 



    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'footer_layout_custom',
            'label'       => esc_html__( 'Footer Layout Control', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'priority'    => 10,
            'choices'     => [
                'footer_1' => get_template_directory_uri() . '/inc/img/footer/footer-1.png'
            ],
            'default'     => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'arckytech_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $footer_posttype = array(
        'post_type'      => 'arc-footer',
        'posts_per_page' => -1,
    );
    $footer_posttype_loop = get_posts($footer_posttype);
    $footer_post_obj_arr = array();
    foreach($footer_posttype_loop as $post){
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Select(
        [
            'settings'    => 'arckytech_footer_templates',
            'label'       => esc_html__( 'Elementor Footer Template', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'placeholder' => esc_html__( 'Choose an option', 'arckytec' ),
            'choices'     => $footer_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'arckytech_footer_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );



    // footer_layout_section section 

    new \Kirki\Field\Repeater(
        [
            'settings'     => 'arckytech_footer_social',
            'label'        => esc_html__( 'Footer Social Links', 'arckytec' ),
            'section'      => 'footer_layout_section',
            'priority'     => 10,

            'default'      => [
            ],
            'row_label'    => [
                'type'  => 'field',
                'value' => esc_html__( 'ROW', 'arckytec' ),
                'field' => 'link_target',
            ],
            'fields' => [
                'link_target'   => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Choose social media', 'arckytec' ),
                    'description' => esc_html__( 'Description', 'arckytec' ),
                    'default'     => "<i class='fab fa-facebook-f'></i>",
                    'choices' => [
                        "<i class='fab fa-facebook-f'></i>" => "Facebook",
                        "<i class='fab fa-twitter'></i>" => "Twitter",
                        "<i class='fab fa-linkedin'></i>" => "Linkedin",
                        "<i class='fab fa-instagram'></i>" => "Instagram",
                    ],
                ],
                'link_url'    => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link URL', 'arckytec' ),
                    'description' => esc_html__( 'Description', 'arckytec' ),
                    'default'     => '',
                ],
            ],
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_logo',
            'label'       => esc_html__( 'Footer logo', 'arckytec' ),
            'description' => esc_html__( 'Set request section image.', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'default'     => '',
            'active_callback' => [
                [
                    'setting' => 'arckytech_request_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]

    );


    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_bg_shape',
            'label'       => esc_html__( 'Footer BG Shape', 'arckytec' ),
            'description' => esc_html__( 'Set foooter background shape', 'arckytec' ),
            'section'     => 'footer_layout_section',
            'default'     => '',
        ]
    );
    
    

    new \Kirki\Field\Text(
        [
            'settings' => 'arckytech_copyright',
            'label'    => esc_html__( 'Footer Copyright', 'arckytec' ),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__( 'Copyright & Design By @ArykytechDesign - 2023', 'arckytec' ),
            'priority' => 10,
        ]
    );

    $menus = wp_get_nav_menus();

    $options = [];

    foreach ( $menus as $menu ) {
        $options[ $menu->slug ] = $menu->name;
    }



}
footer_layout_section();


