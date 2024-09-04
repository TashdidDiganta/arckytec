<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package arckytech
	*/
   // topbar settings
   $arckytech_fb_link    = get_theme_mod( 'arckytech_fb_link', __( 'info@arckytech.com', 'arckytec' ) );
   $arckytech_fb_text    = get_theme_mod( 'arckytech_fb_text', __( '7500k Followers ', 'arckytec' ) );

   // main header settings
   $arckytech_header_search      = get_theme_mod( 'arckytech_header_search', false );
   $arckytech_header_hamburger   = get_theme_mod( 'arckytech_header_hamburger', false );
   $header_right_switch      = get_theme_mod( 'header_right_switch', false );
   $sticky_header            = get_theme_mod( 'sticky_header', 'off' );
   $arckytech_menu_col           = $header_right_switch ? 'col-xl-5 d-none d-xl-block' : 'col-xl-10 col-lg-7 col-md-7 col-sm-8 col-6 d-none d-xl-block';
   $arckytech_menu_align         = $header_right_switch ? '' : 'justify-content-end';
?>
<header class="main-header">
    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="container">
                <div class="main-menu__wrapper-inner">
                    <div class="main-menu__left">
                        <div class="main-menu__logo">
                        <?php arckytech_header_logo(); ?>
                        </div>
                        <div class="main-menu__main-menu-box">
                            <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                            <?php arckytech_header_menu();?>
                        </div>
                    </div>
                    <?php if(get_theme_mod('header_right_switch', '') == "on" ) : ?>
                        <div class="main-menu__right">
                            <div class="main-menu__search-and-call">
                                <div class="main-menu__search-box">
                                    <a href="#" class="main-menu__search search-toggler icon-search"></a>
                                </div>
                                <div class="main-menu__call">
                                    <div class="main-menu__call-icon">
                                        <span class="icon-phone1"></span>
                                    </div>
                                    <div class="main-menu__call-number">
                                        <p><?php echo esc_html(get_theme_mod('contact_title', 'Need Help:'));?></p>
                                        <h5><a href="tel:<?php echo esc_url(get_theme_mod('contact_number','+9(406)555-0120')); ?>"> <?php echo esc_html(get_theme_mod('contact_number','+9(406)555-0120')); ?> </a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<!--Blog Page Single End-->
<div class="search-popup">
    <div class="search-popup__overlay search-toggler">
        <div class="search-close-btn">
            <i class="icon-cancel"></i>
        </div>
    </div>

    <!-- /.search-popup__overlay -->
    <div class="search-popup__content">
        <form>
            <label for="search" class="sr-only"> <?php echo _e('search here', 'arckytec'); ?> </label><!-- /.sr-only -->
            <input type="text" id="search" placeholder="Search Here..." name="s" value="<?php echo get_search_query(); ?>"/>
            <button type="submit" aria-label="search submit" class="thm-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>
<!-- /.search-popup -->

<?php if($sticky_header == 'on'): ?>
<div class="stricky-header stricked-menu main-menu main-menu-six">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->
<?php endif; ?>