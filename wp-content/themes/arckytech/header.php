<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arckytech
 */
?>

<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php wp_body_open();?>


    <?php
        $arckytech_preloader       = get_theme_mod( 'arckytech_preloader_switch', 'off' );
        $arckytech_oofcanvas       = get_theme_mod( 'arckytech_offcanvas_enable', 'off' );
        $arckytech_preloader_logo  = get_theme_mod( 'arckytech_preloader_logo', get_template_directory_uri() . '/assets/img/loader.png' );
        $arckytech_sidebar_logo  = get_theme_mod( 'arckytech_sidebar_logo', get_parent_theme_file_uri('assets/img/logo/logo-2.png') );
        $arckytech_backtotop = get_theme_mod( 'arckytech_backtotop', false );
        $arckyetch_body_grid = get_theme_mod( 'body_grid_border', false );
    ?>

    <?php if($arckytech_preloader == 'on') :?>
        <div class="preloader">
            <div class="preloader__image" style="background-image: url(<?php echo esc_url($arckytech_preloader_logo); ?>);"></div>
        </div>
        <!-- /.preloader -->
    <?php endif; ?>

    <?php if($arckytech_oofcanvas == 'on') :?>
    <?php
        $offcanvas_logo = get_theme_mod('arckytech_offcanvas_logo', get_template_directory_uri() . '/assets/img/logo/logo-2.png');
        $offcanvas_title = get_theme_mod('arckytech_offcanvas_title', 'About Us');
        $offcanvas_desc = get_theme_mod('arckytech_offcanvas_desc', '');
        $offcanvas_form_title = get_theme_mod('arckytech_offcanvas_form_title', '');
    ?>
    <!-- Start sidebar widget content -->
    <div class="xs-sidebar-group info-group info-sidebar">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget">X</a>
                </div>
                <div class="sidebar-textwidget">
                    <div class="sidebar-info-contents">
                        <div class="content-inner">
                            <div class="logo">
                                <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($offcanvas_logo); ?>" alt="<?php bloginfo('name'); ?>"></a>
                            </div>
                            <div class="content-box">
                                <h4><?php echo esc_html($offcanvas_title); ?></h4>
                                <p><?php echo wp_kses_post($offcanvas_desc); ?></p>
                            </div>
                            <div class="form-inner">
                                <h4><?php echo esc_html($offcanvas_form_title); ?></h4>
                                <?php echo do_shortcode(get_theme_mod('arckytech_offcanvas_form')); ?>
                                <div class="result"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($arckytech_backtotop)) :?>
        <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fas fa-arrow-up"></i></a>
    <?php endif; ?>
    <div class="page-wrapper">
        <?php if($arckyetch_body_grid && is_front_page()): ?>
        <div class="site-border"></div>
        <div class="site-border site-border-two"></div>
        <div class="site-border site-border-three"></div>
        <div class="site-border site-border-four"></div>
        <?php endif; ?>

        <!-- header start -->
        <?php do_action( 'arckytech_header_style' );?>
        <!-- header end -->
        
        <!-- wrapper-box start -->
        <?php do_action( 'arckytech_before_main_content' );?>
