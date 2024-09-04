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
$team_designation = function_exists('get_field') ? get_field('member_designation') : '';


?>

<!--Team Details Start-->
<section class="team-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="team-details__left">
                    <?php if(has_post_thumbnail()): ?>
                    <div class="team-details__img">
                       <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="team-details__right">
                    <h3 class="team-details__name"><?php the_title(); ?></h3>
                    <p class="team-details__sub-title"><?php echo wp_kses_post($team_designation); ?></p>
                    <?php the_content(); ?>
                    <div class="team-details__progress">
                        <h3 class="team-details__progress-title"> <?php echo _e('Skills', 'arc-core'); ?></h3>
                        <div class="progress-levels">
                        <?php $tp_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_custom_meta_id') : ''; ?>
                            <!--Skill Box-->
                            <?php  foreach($tp_repeater as $row) : ?>
                            <div class="progress-box">
                                <div class="inner count-box">
                                    <div class="text"> <?php  ?></div>
                                    <div class="bar">
                                        <div class="bar-innner">
                                            <div class="skill-percent">
                                                <span class="count-text" data-speed="3000"
                                                    data-stop="<?php echo esc_attr($row['_progress_value']); ?>">0</span>
                                                <span class="percent">%</span>
                                            </div>
                                            <div class="bar-fill" data-percent="<?php echo esc_attr($row['_progress_value']); ?>"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="team-details__social-box">
                        <div class="team-details__social-title"><?php echo _e('Social Media', 'arc-core'); ?></div>
                        <div class="team-details__social">
                        <?php
                            $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                foreach($social_repeater as $row) :?>
                                    <?php foreach($row['_team_social_id'] as $icon ) :?>
                                        <a href="<?php echo $row['_url_value']; ?>"><i class="icon-<?php echo strtolower($icon)?>"></i></a>
                                    <?php endforeach?>
                                <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="team-details__bottom">
              <?php esc_html(the_field('member_details')); ?>
            </div>
        </div>
    </div>
</section>
<!--Team Details End-->

<?php get_footer();  ?>
