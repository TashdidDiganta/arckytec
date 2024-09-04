<?php 

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arckytech
*/

$arckytech_footer_logo  = get_theme_mod( 'footer_logo' );
$arckytech_footer_links = get_theme_mod( 'arckytech_footer_links' );
$arckytech_footer_description = get_theme_mod( 'arckytech_footer_description' );
$arc_footer_newsletter = get_theme_mod('arckytech_request_elementor_switch', 'off');
$menu  = get_theme_mod( 'footer_navs' );
$whatsapp  = get_theme_mod( 'footer_whatsapp' );

// Default values for 'my_repeater_setting' theme mod.
$footer_socials_links = [
	[
		'link_text' => '<i class="fab fa-facebook-f"></i>',
		'link_url'  => 'https://facebook.com/',
	],
    [
		'link_text' => '<i class="fab fa-twitter"></i>',
		'link_url'  => 'https://twitter.com/',
	],
    [
		'link_text' => '<i class="fab fa-behance"></i>',
		'link_url'  => 'https://behance.com/',
	],
    [
		'link_text' => '<i class="fab fa-youtube"></i>',
		'link_url'  => 'https://youtube.com/',
	],
];

// Theme_mod settings to check.
$footer_socials = get_theme_mod( 'my_repeater_setting', $footer_socials_links );

// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-' . $num ) ) {
        $footer_columns++;
    }
}

switch ( $footer_columns ) {
case '1':
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
    $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
    $footer_class[3] = 'col-xl-4 col-lg-6';
    break;
case '4':
    $footer_class[1] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
    $footer_class[2] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
    $footer_class[3] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
    $footer_class[4] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}

?>

<?php if( 'on' == $arc_footer_newsletter ) : ?>

<!--Get In Touch Start-->
<section class="get-in-touch">
    <div class="get-in-touch__img">
        <?php $img = get_theme_mod('newsletter_section_image', get_template_directory_uri() . '/assets/img/resources/get-in-touch-img-1.jpg'); ?>
        <img src="<?php echo esc_url($img); ?>" alt="<?php bloginfo('name'); ?>">
    </div>
    <div class="get-in-touch__wrap">
        <div class="get-in-touch__shape-1 float-bob-y">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shapes/get-in-touch-shape-1.png" alt="<?php bloginfo('name'); ?>">
        </div>
        <div class="container">
            <div class="get-in-touch__inner">
                <h3 class="get-in-touch__title"> <?php echo wp_kses_post(get_theme_mod('newsletter_section_title', 'Looking For The Best <br> Architecture & Interior Services')); ?></h3>
                <div class="get-in-touch__btn-box">
                    <a href="<?php echo esc_url(get_theme_mod('button_url', '#')); ?> " class="button-style-3">
                    <?php echo esc_html(get_theme_mod('button_name', 'Submit Request')); ?> <span class="icon-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Get In Touch End-->
<?php endif; ?>

<!--Site Footer Start-->
<footer class="site-footer">
    <?php $image = get_theme_mod( 'footer_bg_shape' ); ?>
    <div class="site-footer__shape-1" style="background-image: url('<?php echo esc_url( $image ); ?>');"></div>
    <div class="site-footer__top">
        <div class="container">
            <div class="site-footer__top-inner">
                <div class="row">
                    <?php for( $num = 1; $num <= $footer_widgets; $num++) :?>
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp">
                        <?php dynamic_sidebar('footer-' . $num); ?>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="site-footer__bottom-inner">
                <p class="site-footer__bottom-text"> <?php echo get_theme_mod( 'arckytech_copyright', 'Copyright & Design By @arckytec - 2023' ); ?></p>
            </div>
        </div>
    </div>
</footer>
<!--Site Footer End-->

