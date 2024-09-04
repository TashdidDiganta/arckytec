<?php 

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arckytech
 */

$categories = get_the_terms( $post->ID, 'category' );

$arckytech_blog_date = get_theme_mod( 'arckytech_blog_date', true );
$arckytech_blog_comments = get_theme_mod( 'arckytech_blog_comments', true );
$arckytech_blog_author = get_theme_mod( 'arckytech_blog_author', true );
$arckytech_blog_cat = get_theme_mod( 'arckytech_blog_cat', false );
$arckytech_blog_view_count = get_theme_mod( 'arckytech_blog_view_count', false );

?>
<div class="news-page__date-and-comment">
    <div class="news-page__date-box">
        <p class="news-page__date-sub-title"><a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a></p>
        <p class="news-page__date"><span class="icon-calendar"></span><?php the_time( get_option('date_format') ); ?></p>
    </div>
    <ul class="news-page__comment list-unstyled">
        <li>
            <p><span class="icon-chat"></span><?php comments_number();?></p>
        </li>
    </ul>
</div>
