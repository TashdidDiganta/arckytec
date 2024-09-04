<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package arckytech
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 'col-xl-8 col-lg-7' : 'col-xl-12 col-lg-12';
?>
<!-- breadcrumb area start -->
<section class="arc-postbox-details-area arc-blog-area pb-120 pt-95">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr($blog_column); ?>">
                <div class="arc-postbox-details-main-wrapper">
                    <div class="arc-postbox-details-content postbox__text">
                        <?php
							while ( have_posts() ):
							the_post();

							get_template_part( 'template-parts/content', get_post_format() );
						?>
						
                        <?php 
							if ( get_previous_post_link() && get_next_post_link() ): 
							$prev_post = get_adjacent_post(false, '', true);
							$next_post = get_adjacent_post(false, '', false);
						?>
                        <?php endif;?>
                        <!-- navigation end -->

                        <?php
							get_template_part( 'template-parts/biography', get_post_format() );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ):
								comments_template();
							endif;
							endwhile; // End of the loop.
						?>
                    </div>
                </div>
            </div>

            <?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
            <div class="col-xl-4 col-lg-5">
                <div class="arc-sidebar-wrapper arc-sidebar-ml--24">
                    <?php get_sidebar();?>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</section>
<!-- breadcrumb area end -->
<?php
get_footer();
