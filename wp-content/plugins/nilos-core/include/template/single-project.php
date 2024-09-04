<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  nilos
 */
get_header();

$post_column = is_active_sidebar( 'portfolio-sidebar' ) ? 'col-xxl-9 col-xl-9 col-lg-8' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar( 'portfolio-sidebar' ) ? '' : 'justify-content-center';

?>

<!--Project Details Start-->
    <section class="project-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <?php if(has_post_thumbnail()): ?>
                    <div class="project-details__img">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="project-details__duration">
                        <ul class="project-details__duration-list list-unstyled">
                            <li>
                                <p>Year:</p>
                                <h3><?php echo esc_html(get_field('project_duration')); ?></h3>
                            </li>
                            <li>
                                <p>Client:</p>
                                <h3><?php echo esc_html(get_field('client_name')); ?></h3>
                            </li>
                            <li>
                                <p>Price:</p>
                                <h3><?php echo  esc_html(get_field('project_price')); ?></h3>
                            </li>
                            <li>
                                <p>Location:</p>
                                <h3><?php echo esc_html(get_field('project_location')); ?></h3>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php echo wp_kses_post(get_the_content()); ?>
                    <div class="project-details__pagination-box">
                        <ul class="project-details__pagination list-unstyled clearfix">
                            <?php
                                $next_post = get_next_post();
                                $prev_post = get_previous_post();
                            ?>
                            <li class="previous">
                                <?php if(!empty($prev_post)): ?>
                                    <a href="<?php echo esc_url(get_the_permalink($prev_post->ID)); ?>" aria-label="next">
                                        <?php _e('Next Project','arc-core'); ?>
                                        <i class="icon-right-arrow"></i>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <li class="next">
                                <?php if(!empty($next_post)): ?>
                                    <a href="<?php echo esc_url(get_the_permalink($next_post->ID)); ?>" aria-label="previous">
                                        <i class="icon-left-arrow"></i>
                                        <?php _e('Previous Projects','arc-core'); ?>
                                    </a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--Project Details End-->

<?php get_footer();  ?>

