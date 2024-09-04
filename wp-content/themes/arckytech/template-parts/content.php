<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arckytech
 */

$arckytech_audio_url = function_exists( 'get_field' ) ? get_field( 'arckytech_post_audio' ) : NULL;
$gallery_images = function_exists('get_field') ? get_field('arckytech_post_gallery') : '';
$arckytech_video_url = function_exists( 'get_field' ) ? get_field( 'arckytech_post_video' ) : NULL;



$arckytech_blog_single_social = get_theme_mod( 'arckytech_blog_single_social', true );
$blog_tag_col = $arckytech_blog_single_social ? 'col-xl-8 col-lg-6' : 'col-xl-12';

if ( is_single() ) : ?>
<!-- details start -->
<article id="post-<?php the_ID();?>" <?php post_class( 'arc-postbox-details-article' );?>>
    <div class="blog-details__left">
       <?php if ( has_post_thumbnail() ): ?>
            <div class="arc-postbox-details-thumb blog-details__img">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </div>
        <?php endif;?>
        <div class="blog-details__content">
            <?php get_template_part( 'template-parts/blog/blog-details-meta' ); ?>
                <h3 class="blog-details__title-1"> <?php echo the_title(); ?> </h3>
                <div class="arc-postbox-details-article-inner">
                    <?php the_content(); ?>
                </div>
            <div class="blog-details__bottom">
                <?php print arckytech_get_tag(); ?>
                 <?php $social_links = get_theme_mod('arckytech_footer_social','');?>
                 
                 <?php if(!empty($social_links)) :?>
                    <div class="blog-details__social-list">
                        <?php foreach($social_links as $social) : ?>
                            <a href="<?php echo $social['link_url']; ?>"><?php echo $social['link_target']; ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>
<!-- details end -->
<?php else: ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'arc-postbox-item format-image mb-50 transition-3 blog-page__single' );?>>
<?php $category = get_the_category();?>

    <!--Blog Page Single Start-->
        <div class="blog-page__img <?php echo ( get_the_post_thumbnail() != NULL) ? "" : 'has_no_thumb' ?>">
    
            <?php the_post_thumbnail();  ?>
            <div class="blog-page__date">
                <p><?php echo get_the_date('d'); ?> <br> <?php echo get_the_date('M, Y'); ?>  </p>
            </div>
        </div>
        <div class="blog-page__content">
            <div class="blog-page__client-info">
                <p> <?php _e('By', 'arckytec'); ?> <a href="<?php the_permalink(); ?>"> <?php echo ucwords(get_the_author()); ?> </a></p>
                <p><a href="<?php echo get_category_link($category[0]->term_id); ?>"><?php echo esc_html($category[0]->name); ?></a></p>
            </div>
            <h3 class="blog-page__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="blog-page__btn-box">
                <a href="<?php the_permalink(); ?>" class="button-style-2"> <?php _e('View More', 'arckytec'); ?></a>
            </div>
        </div>
</article>
<?php endif;?>
