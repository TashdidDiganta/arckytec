<?php

/**
 * arckytech functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package arckytech
 */

if ( !function_exists( 'arckytech_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function arckytech_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on arckytech, use a find and replace
         * to change 'arckytec' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'arckytec', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( [
            'main-menu' => esc_html__( 'Main Menu', 'arckytec' ),
            'footer-menu' => esc_html__( 'footer Menu', 'arckytec' ),
        ] );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'arckytech_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ] ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        //Enable custom header
        add_theme_support( 'custom-header' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ] );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        remove_theme_support( 'widgets-block-editor' );

    }
endif;
add_action( 'after_setup_theme', 'arckytech_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function arckytech_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'arckytech_content_width', 640 );
}
add_action( 'after_setup_theme', 'arckytech_content_width', 0 );



/**
 * Enqueue scripts and styles.
 */

define( 'ARCKYTECH_THEME_DIR', get_template_directory() );
define( 'ARCKYTECH_THEME_URI', get_template_directory_uri() );
define( 'ARCKYTECH_THEME_CSS_DIR', ARCKYTECH_THEME_URI . '/assets/css/' );
define( 'ARCKYTECH_THEME_JS_DIR', ARCKYTECH_THEME_URI . '/assets/js/' );
define( 'ARCKYTECH_THEME_INC', ARCKYTECH_THEME_DIR . '/inc/' );



// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Implement the Custom Header feature.
 */
require ARCKYTECH_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require ARCKYTECH_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require ARCKYTECH_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */

if ( class_exists( 'Kirki' ) ) {
    include_once ARCKYTECH_THEME_INC . 'kirki-customizer.php';
}
include_once ARCKYTECH_THEME_INC . 'class-arckytech-kirki.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require ARCKYTECH_THEME_INC . 'jetpack.php';
}


/**
 * include arckytech functions file
 */
require_once ARCKYTECH_THEME_INC . 'class-navwalker.php';
require_once ARCKYTECH_THEME_INC . 'class-tgm-plugin-activation.php';
require_once ARCKYTECH_THEME_INC . 'add_plugin.php';
require_once ARCKYTECH_THEME_INC . '/common/arckytech-breadcrumb.php';
require_once ARCKYTECH_THEME_INC . '/common/arckytech-scripts.php';
require_once ARCKYTECH_THEME_INC . '/common/arckytech-widgets.php';


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function arckytech_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'arckytech_pingback_header' );



// arckytech_comment 
if ( !function_exists( 'arckytech_comment' ) ) {
    function arckytech_comment( $comment, $args, $depth ) {
        global $post;
        $GLOBAL['comment'] = $comment;
        extract( $args, EXTR_SKIP );
        $args['reply_text'] = 'Reply';
        $replayClass = 'comment-depth-' . esc_attr( $depth );
        ?>
            <li id="comment-<?php comment_ID();?>">
                <div class="comments-box arc-postbox-details-comment-box d-sm-flex align-items-start comment-one__single">
                    <div class="arc-postbox-details-comment-thumb comment-one__image">
                        <?php print get_avatar( $comment, 102, null, null, [ 'class' => [] ] );?>
                    </div>
                    <div class="arc-postbox-details-comment-content comment-one__content">
                        <h3><?php print get_comment_author_link();?></h3>
                        <p class="comment-one__date"><?php comment_time( get_option( 'date_format' ) );?></p>
                        <?php comment_text();?>
                        <?php comment_reply_link( array_merge( $args, [ 'depth' => $depth, 'max_depth' => $args['max_depth'] ] ) );?>
                    </div>
                </div>
            </li>
        <?php
    }
}

/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'arckytech_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function arckytech_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}

// arckytech_search_filter_form
if ( !function_exists( 'arckytech_search_filter_form' ) ) {
    function arckytech_search_filter_form( $form ) {

        $form = sprintf(
            '<div class="sidebar__single sidebar__search">
                <form action="' . home_url( '/' ) . '" class="sidebar__search-form">
                    <input type="search" placeholder="Search here" name="s" value="'. get_search_query() .'" ?>
                    <button type="submit"><i class="icon-search"></i></button>
                </form>
           </div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search', 'arckytec' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'arckytech_search_filter_form' );
}

add_action( 'admin_enqueue_scripts', 'arckytech_admin_custom_scripts' );

function arckytech_admin_custom_scripts() {
    wp_enqueue_media();
    wp_enqueue_style( 'customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css',array());
    wp_register_script( 'arckytech-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'arckytech-admin-custom' );
}



add_filter('intermediate_image_sizes_advanced','stop_thumbs');
function stop_thumbs($sizes){
      return array();
}

// allow custom fonts
function allow_custom_font_uploads($mime_types) {
    $mime_types['woff'] = 'font/woff';
    $mime_types['woff2'] = 'font/woff2';
    return $mime_types;
}
add_filter('upload_mimes', 'allow_custom_font_uploads');

// comments count
function custom_comments_count($count) {
    // Add leading zero if the count is less than 10
    return sprintf('%02d', $count);
}
add_filter('get_comments_number', 'custom_comments_count');

