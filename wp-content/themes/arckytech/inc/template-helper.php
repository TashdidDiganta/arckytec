<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package arckytech
 */


function arckytech_check_header() {
    $nl_header_tabs = function_exists('get_field')? get_field('header') : false;
    $nl_header_style_meta = function_exists('get_field')? get_field('arckytech_header_style') : '';
    $elementor_header_template_meta = function_exists('get_field')? get_field('elementor_header_style') : false;


    $arckytech_header_option_switch = get_theme_mod('arckytech_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod( 'header_layout_custom', 'header_1' );
    $elementor_header_templates_kirki = get_theme_mod( 'arckytech_header_templates' );
    
    if($nl_header_tabs == 'default'){
        if($arckytech_header_option_switch){
            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        }else{ 
            get_template_part( 'template-parts/header/header-1' );
        }
    }elseif($nl_header_tabs == 'elementor'){
        if($elementor_header_template_meta){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    }else{
        if($arckytech_header_option_switch){

            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }else{
            get_template_part( 'template-parts/header/header-1' );
        }
        
    }

}
add_action( 'arckytech_header_style', 'arckytech_check_header', 10 );


/* arckytech offcanvas */

function arckytech_check_offcanvas() {
    $arckytech_offcanvas_style = function_exists( 'get_field' ) ? get_field( 'arckytech_offcanvas_style' ) : NULL;
    $arckytech_default_offcanvas_style = get_theme_mod( 'choose_default_offcanvas', 'offcanvas-style-1' );

    if ( $arckytech_offcanvas_style == 'offcanvas-style-1' ) {
        get_template_part( 'template-parts/offcanvas/offcanvas-1' );

    }
    elseif($arckytech_offcanvas_style == 'offcanvas-style-2' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-2' );
    }

    
    else{
        if ( $arckytech_default_offcanvas_style == 'offcanvas-style-2' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-2' );
        } 

        else {
            get_template_part( 'template-parts/offcanvas/offcanvas-1' );
        }
    }
}

add_action( 'arckytech_offcanvas_style', 'arckytech_check_offcanvas', 10 );




/**
 * [arckytech_header_lang description]
 * @return [type] [description]
 */
function arckytech_header_lang_defualt() {
   ?>

    <div class="arc-header-top-menu-item arc-header-lang">
        <span class="arc-header-lang-toggle" id="arc-header-lang-toggle"><?php print esc_html__( 'English', 'arckytec' );?></span>
        <?php do_action( 'arckytech_language' );?>
    </div>
<?php
}

/**
 * [arckytech_language_list description]
 * @return [type] [description]
 */
function _arckytech_language( $mar ) {
    return $mar;
}
function arckytech_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'arckytec' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'arckytec' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'arckytec' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _arckytech_language( $mar );
}
add_action( 'arckytech_language', 'arckytech_language_list' );





/**
 * [arckytech_offcanvas_language description]
 * @return [type] [description]
 */


 /**
 * [arckytech_header_lang description]
 * @return [type] [description]
 */
function arckytech_offcanvas_lang_defualt() {
    ?>
  
     <div class="offcanvas__select language">
         <div class="offcanvas__lang d-flex align-items-center justify-content-md-end">
             <div class="offcanvas__lang-img mr-15">
                 <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/language-flag.png" alt="<?php echo esc_attr__('language', 'arckytec'); ?>">
             </div>
 
             <div class="offcanvas__lang-wrapper">
                 <span class="offcanvas__lang-selected-lang arc-lang-toggle" id="arc-offcanvas-lang-toggle"><?php echo esc_html__('English', 'arckytec'); ?></span> 
                 <?php do_action( 'arckytech_offcanvas_language' );?>
             </div>
         </div>
     </div>
 <?php
 }
function _arckytech_offcanvas_language( $mar ) {
    return $mar;
}
function arckytech_offcanvas_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="offcanvas__lang-list arc-lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="offcanvas__lang-list arc-lang-list">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'arckytec' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'arckytec' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'arckytec' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _arckytech_language( $mar );
}
add_action( 'arckytech_offcanvas_language', 'arckytech_offcanvas_language_list' );



/**
 * [arckytech_language_list description]
 * @return [type] [description]
 */
function _arckytech_footer_language( $mar ) {
    return $mar;
}
function arckytech_footer_language_list() {
    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="footer__lang-list arc-lang-list-2">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="footer__lang-list arc-lang-list-2">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'arckytec' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'arckytec' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'arckytec' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _arckytech_footer_language( $mar );
}
add_action( 'arckytech_footer_language', 'arckytech_footer_language_list' );



// header logo
function arckytech_header_logo() { ?>
    <?php
        $arckytech_logo_on = function_exists('get_field')? get_field('arckytech_en_secondary_logo') : NULL;
        $arckytech_logo = get_template_directory_uri() . '/assets/img/resources/logo-1.png';
        $arckytech_logo_white = get_template_directory_uri() . '/assets/img/resources/logo-1.png';

        $arckytech_site_logo_width = get_theme_mod( 'arckytech_logo_width', '135');

        $arckytech_site_logo = get_theme_mod( 'header_logo', $arckytech_logo );
        $arckytech_secondary_logo = get_theme_mod( 'header_secondary_logo', $arckytech_logo_white );
    ?>

    <?php if ( $arckytech_logo_on == 'on' ) : ?>
    <a class="secondary-logo" href="<?php print esc_url( home_url( '/' ) );?>">
        <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" src="<?php print esc_url( $arckytech_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'arckytec' );?>" />
    </a>
    <?php else : ?>
    <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
        <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" src="<?php print esc_url( $arckytech_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'arckytec' );?>" />
    </a>
    <?php endif; ?>
<?php
}

// header logo
function arckytech_header_double_logo() { ?>
    <?php
        $arckytech_logo = get_template_directory_uri() . '/assets/img/resources/logo-1.png';
        $arckytech_logo_white = get_template_directory_uri() . '/assets/img/resources/logo-1.png';

        $arckytech_site_logo_width = get_theme_mod( 'arckytech_logo_width', '135');

        $arckytech_site_logo = get_theme_mod( 'header_logo', $arckytech_logo );
        $arckytech_logo_white = get_theme_mod( 'header_secondary_logo', $arckytech_logo_white );

        ?>
    
        <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url( $arckytech_logo_white ); ?>" alt="<?php print esc_attr__( 'logo', 'arckytec' );?>">
            <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $arckytech_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'arckytec' );?>">
        </a>
<?php
}


// arckytech_footer_logo
function arckytech_footer_logo() { ?>
      <?php
        $arckytech_foooter_logo = function_exists( 'get_field' ) ? get_field( 'arckytech_footer_logo' ) : NULL;

        $arckytech_logo = get_template_directory_uri() . '/assets/img/resources/logo-2.png';

        $arckytech_footer_logo_default = get_theme_mod( 'arckytech_footer_logo', $arckytech_logo );
        $arckytech_site_logo_width = get_theme_mod( 'arckytech_logo_width', '120');
      ?>

      <?php if ( !empty( $arckytech_foooter_logo ) ) : ?>
         <a href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" src="<?php print esc_url( $arckytech_foooter_logo );?>" alt="<?php print esc_attr__( 'logo', 'arckytec' );?>" />
         </a>
      <?php else : ?>
         <a href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" src="<?php print esc_url( $arckytech_footer_logo_default );?>" alt="<?php print esc_attr__( 'logo', 'arckytec' );?>" />
         </a>
      <?php endif; ?>
   <?php
}


// header logo
function arckytech_header_sticky_logo() {?>
    <?php
        $arckytech_sticky_logo = function_exists( 'get_field' ) ? get_field( 'arckytech_sticky_logo' ) : NULL;
        $arckytech_logo = get_theme_mod( 'arckytech_sticky_logo', get_template_directory_uri() . '/assets/img/resources/logo-2.png' );
        $arckytech_secondary_logo = get_theme_mod( 'seconday_logo',  get_template_directory_uri() . '/assets/img/resources/logo-1.png');
        $arckytech_site_logo_width = get_theme_mod( 'arckytech_logo_width', '120');
    ?>
        <?php if ( !empty( $arckytech_sticky_logo ) ) : ?>
        <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $arckytech_sticky_logo );?>" alt="logo">
        </a>
        <?php else : ?>
            <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $arckytech_logo );?>" alt="logo">
            <img data-width="<?php echo esc_attr($arckytech_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url( $arckytech_secondary_logo );?>" alt="logo">
        </a>
        <?php endif; ?>
    <?php
}

function arckytech_mobile_logo() {
    // side info
    $arckytech_mobile_logo_hide = get_theme_mod( 'arckytech_mobile_logo_hide', false );

    $arckytech_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/resources/logo-1.png' );

    ?>

    <?php if ( !empty( $arckytech_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $arckytech_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'arckytec' );?>" />
        </a>
    </div>
    <?php endif;?>



<?php }

/**
 * [arckytech_header_social_profiles description]
 * @return [type] [description]
 */
function arckytech_header_social_profiles() {
    $arckytech_topbar_fb_url = get_theme_mod( 'arckytech_topbar_fb_url', __( '#', 'arckytec' ) );
    $arckytech_topbar_twitter_url = get_theme_mod( 'arckytech_topbar_twitter_url', __( '#', 'arckytec' ) );
    $arckytech_topbar_instagram_url = get_theme_mod( 'arckytech_topbar_instagram_url', __( '#', 'arckytec' ) );
    $arckytech_topbar_linkedin_url = get_theme_mod( 'arckytech_topbar_linkedin_url', __( '#', 'arckytec' ) );
    $arckytech_topbar_youtube_url = get_theme_mod( 'arckytech_topbar_youtube_url', __( '#', 'arckytec' ) );
    ?>
        <ul>
        <?php if ( !empty( $arckytech_topbar_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $arckytech_topbar_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $arckytech_topbar_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $arckytech_topbar_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $arckytech_topbar_instagram_url ) ): ?>
            <li><a href="<?php print esc_url( $arckytech_topbar_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $arckytech_topbar_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $arckytech_topbar_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $arckytech_topbar_youtube_url ) ): ?>
            <li><a href="<?php print esc_url( $arckytech_topbar_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif;?>
        </ul>

<?php
}

/**
 * [arckytech_offcanvas_social_profiles description]
 * @return [type] [description]
 */
function arckytech_offcanvas_social_profiles() {

    $arckytech_offcanvas_fb_url = get_theme_mod( 'arckytech_offcanvas_fb_url', __( '#', 'arckytec' ) );
    $arckytech_offcanvas_twitter_url = get_theme_mod( 'arckytech_offcanvas_twitter_url', __( '#', 'arckytec' ) );
    $arckytech_offcanvas_instagram_url = get_theme_mod( 'arckytech_offcanvas_instagram_url', __( '#', 'arckytec' ) );
    $arckytech_offcanvas_linkedin_url = get_theme_mod( 'arckytech_offcanvas_linkedin_url', __( '#', 'arckytec' ) );
    $arckytech_offcanvas_youtube_url = get_theme_mod( 'arckytech_offcanvas_youtube_url', __( '#', 'arckytec' ) );
    ?>
        <?php if ( !empty( $arckytech_offcanvas_fb_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_offcanvas_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $arckytech_offcanvas_twitter_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_offcanvas_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $arckytech_offcanvas_instagram_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_offcanvas_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $arckytech_offcanvas_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_offcanvas_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $arckytech_offcanvas_youtube_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_offcanvas_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a>
        <?php endif;?>
<?php
}

function arckytech_footer_social_profiles() {
    $arckytech_footer_fb_url = get_theme_mod( 'arckytech_footer_fb_url', __( '#', 'arckytec' ) );
    $arckytech_footer_twitter_url = get_theme_mod( 'arckytech_footer_twitter_url', __( '#', 'arckytec' ) );
    $arckytech_footer_instagram_url = get_theme_mod( 'arckytech_footer_instagram_url', __( '#', 'arckytec' ) );
    $arckytech_footer_linkedin_url = get_theme_mod( 'arckytech_footer_linkedin_url', __( '#', 'arckytec' ) );
    $arckytech_footer_youtube_url = get_theme_mod( 'arckytech_footer_youtube_url', __( '#', 'arckytec' ) );
    ?>

        <?php if ( !empty( $arckytech_footer_fb_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_footer_fb_url );?>">
                <i class="fab fa-facebook-f"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $arckytech_footer_twitter_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_footer_twitter_url );?>">
                <i class="fab fa-twitter"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $arckytech_footer_instagram_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_footer_instagram_url );?>">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $arckytech_footer_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_footer_linkedin_url );?>">
                <i class="fab fa-linkedin"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $arckytech_footer_youtube_url ) ): ?>
            <a href="<?php print esc_url( $arckytech_footer_youtube_url );?>">
                <i class="fab fa-youtube"></i>
            </a>
        <?php endif;?>
<?php
}


/**
 * [arckytech_header_menu description]
 * @return [type] [description]
 */
function arckytech_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'main-menu__list',
            'container'      => '',
            'fallback_cb'    => 'Arc_Navwalker_Class::fallback',
            'walker'         => new \ArcCore\Widgets\Arc_Navwalker_Class,
        ] );
    ?>
    <?php
}



/**
 * [arckytech_footer_menu description]
 * @return [type] [description]
 */
function arckytech_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0 footer-list-inline-3',
        'container'      => '',
        'fallback_cb'    => 'Arc_Navwalker_Class::fallback',
        'link_before'    => '<i class="fas fa-chevron-right"></i>',
        'walker'         => new \ArcCore\Widgets\Arc_Navwalker_Class,
    ] );
}

/**
 * [arckytech_offcanvas_default_menu description]
 * @return [type] [description]
 */
function arckytech_offcanvas_default_menu() {
    wp_nav_menu( [
        'theme_location' => 'offcanvas-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Arc_Navwalker_Class::fallback',
        'walker'         => new \ArcCore\Widgets\Arc_Navwalker_Class,
    ] );
}

/**
 *
 * arckytech footer
 */
add_action( 'arckytech_footer_style', 'arckytech_check_footer', 10 );

function arckytech_check_footer() {
    $page_footer = function_exists('get_field')? get_field('footer') : false;
    $page_elementor_footer_style = function_exists('get_field')? get_field('element_footer_styles') : false;
    $arckytech_footer_option_switch = get_theme_mod('arckytech_footer_elementor_switch', false);
    $elementor_footer_templates_kirki = get_theme_mod( 'arckytech_footer_templates' );
    
    if($page_footer == 'default'){
        if($arckytech_footer_option_switch){
            if($elementor_footer_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            }
        }else{ 
            get_template_part( 'template-parts/footer/footer-1' );
        }
    }elseif($page_footer == 'elementor'){
        if($page_elementor_footer_style){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($page_elementor_footer_style);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        }
    }else{
        if($elementor_footer_templates_kirki){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        }else{
            get_template_part( 'template-parts/footer/footer-1' );
        }
    }

}

// arckytech_copyright_text
function arckytech_copyright_text() {
   print get_theme_mod( 'arckytech_copyright', wp_kses_post( 'Copyright & Design By <a href="#">@ArykytechDesign</a> - 2023' ) );
}

/**
 *
 * pagination
 */
if ( !function_exists( 'arckytech_pagination' ) ) {

    function _arckytech_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function arckytech_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
            'before_page_number'    => ''
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }     

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul class="'.$args['class'].'">';
            foreach ( $paginations as $key => $pg ) {
                if(strpos($pg, 'current') !== false){
                    $pagi .= '<li><a href="#" class="active">' . $pg . '</a></li>';
                }elseif(strpos($pg, 'dots') !== false){
                    $pagi .= '<li><a href="#">---</a></li>';
                }else{
                    $pagi .= '<li>'.$pg.'</li>';
                }
            }
            $pagi .= '</ul>';
        }

        print _arckytech_pagi_callback( $pagi );
    }
}

function arckytech_paginate_links_dots( $args ) {
    // Replace '...' with your custom dots HTML.
    $args['dots'] = '<a href="#">---</a>';
    return $args;
}

add_filter('wp_link_pages_args', 'arckytech_paginate_links_dots');


// header top bg color
function arckytech_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'arckytech_breadcrumb_bg_color', '#e1e1e1' );
    wp_enqueue_style( 'arckytech-custom', ARCKYTECH_THEME_CSS_DIR . 'arckytech-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'arckytech-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'arckytech_breadcrumb_bg_color' );

// breadcrumb-spacing top
function arckytech_breadcrumb_spacing() {
    $padding_px = get_theme_mod( 'arckytech_breadcrumb_spacing', '160px' );
    wp_enqueue_style( 'arckytech-custom', ARCKYTECH_THEME_CSS_DIR . 'arckytech-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style( 'arckytech-breadcrumb-top-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'arckytech_breadcrumb_spacing' );

// breadcrumb-spacing bottom
function arckytech_breadcrumb_bottom_spacing() {
    $padding_px = get_theme_mod( 'arckytech_breadcrumb_bottom_spacing', '160px' );
    wp_enqueue_style( 'arckytech-custom', ARCKYTECH_THEME_CSS_DIR . 'arckytech-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style( 'arckytech-breadcrumb-bottom-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'arckytech_breadcrumb_bottom_spacing' );

// scrollup
function arckytech_scrollup_switch() {
    $scrollup_switch = get_theme_mod( 'arckytech_scrollup_switch', false );
    wp_enqueue_style( 'arckytech-custom', ARCKYTECH_THEME_CSS_DIR . 'arckytech-custom.css', [] );
    if ( $scrollup_switch ) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style( 'arckytech-scrollup-switch', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'arckytech_scrollup_switch' );

// theme color
function arckytech_custom_color() {
    $color_code = get_theme_mod( 'arckytech_color_option', '#F50963' );
    wp_enqueue_style( 'arckytech-custom', ARCKYTECH_THEME_CSS_DIR . 'arckytech-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --arc-theme-1 : " . $color_code . "}";

        wp_add_inline_style( 'arckytech-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'arckytech_custom_color' );


// theme color secondary
function arckytech_custom_color_secondary() {
    $color_code = get_theme_mod( 'arckytech_color_option_2', '#008080' );
    wp_enqueue_style( 'arckytech-custom', ARCKYTECH_THEME_CSS_DIR . 'arckytech-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --arc-theme-2 : " . $color_code . "}";

        wp_add_inline_style( 'arckytech-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'arckytech_custom_color_secondary' );

// scroll to top color
function arckytech_custom_color_scrollup() {
    $color_code = get_theme_mod( 'arckytech_color_scrollup', '#03041C' );
    wp_enqueue_style( 'arckytech-custom', ARCKYTECH_THEME_CSS_DIR . 'arckytech-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html .back-to-top-btn { background-color: " . $color_code . "}";
        wp_add_inline_style( 'arckytech-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'arckytech_custom_color_scrollup' );

/**
 * Move the textarea field to the bottom
 */
function arckytech_move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'arckytech_move_comment_field' );

// arckytech_kses_intermediate
function arckytech_kses_intermediate( $string = '' ) {
    return wp_kses( $string, arckytech_get_allowed_html_tags( 'intermediate' ) );
}

function arckytech_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function arckytech_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'arckytech_archive_count_span' );
function arckytech_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'arckytech_cat_count_span');
function arckytech_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}