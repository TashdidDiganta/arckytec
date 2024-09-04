<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  nilos
 */
get_header();

$post_column = is_active_sidebar( 'services-sidebar' ) ? 'col-lg-8 order-first order-lg-last' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar( 'services-sidebar' ) ? '' : 'justify-content-center';

$service_sidebar_img  = function_exists('get_field')? get_field('sidebar_image') : '#';
$service_sidebar_img_overlay_text  = function_exists('get_field')? get_field('sidebar_image_overlay_text') : 'Easy Solutions to <br> Your Home';
$service_sidebar_brochure  = function_exists('get_field')? get_field('sidebar_brochure_file') : array();
?>
<!--Services Details Start-->
<section class="services-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="services-details__left">
                    <?php if(has_post_thumbnail()): ?>
                    <div class="services-details__img">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif; ?>
                    <h3 class="services-details__title"><?php the_title(); ?></h3>
                    <?php echo wp_kses_post(get_the_content()); ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="services-details__right">
                    <div class="services-details__services-box">
                        <?php
                            $service_categories = get_terms(array(
                                'taxonomy'    => 'services-cat',
                                'hide_empty'  => true
                            ));

                            $categories = get_the_terms(get_the_ID(), 'services-cat');
                            $categories = array_map(function($cat){
                                return $cat->slug;
                            }, $categories);
                        ?>
                        <?php if($service_categories): ?>
                        <ul class="services-details__services-list list-unstyled">
                            <?php foreach($service_categories as $service): ?>
                            <li class="<?php echo in_array($service->slug, $categories)? 'active' : ''; ?>">
                                <a href="<?php echo esc_url(get_term_link($service)); ?>"><?php echo esc_html($service->name); ?><span class="icon-right"></span></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php if(!empty($service_sidebar_img)): ?>
                    <div class="services-details__sidebar-img">
                        <img src="<?php echo esc_url($service_sidebar_img); ?>" alt="<?php bloginfo('name'); ?>">
                        <p class="services-details__sidebar-img-text"><?php echo wp_kses_post($service_sidebar_img_overlay_text); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($service_sidebar_brochure)): 
                    $file_url = $service_sidebar_brochure['url'];
                    $file_size = number_format(($service_sidebar_brochure['filesize'] / 1000000), 2);
                    ?>
                    <div class="services-details__download">
                        <a href="<?php echo esc_url($file_url); ?>" download><?php _e('Company File', 'arc-core'); ?><span>(<?php echo esc_html($file_size); ?>MB)</span>
                            <div class="services-details__download-img">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/download-icon.png" alt="<?php bloginfo('name'); ?>">
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Services Details End-->

<?php get_footer();  ?>
