<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arckytech
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 'col-xl-8 col-lg-7' : 'col-xl-12 col-lg-12';
?>

	<!-- search result item area start -->
	<section class="arc-blog-area arc-postbox-area pt-120 pb-120 news-page">
    	<div class="container">
			<div class="row">
				<div class="<?php print esc_attr( $blog_column );?>">
					<div class="arc-postbox-wrapper pr-50">
						<?php
							if ( have_posts() ):
							if ( is_home() && !is_front_page() ):
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title();?></h1>
						</header>
						<?php
							endif;?>
						<?php
							/* Start the Loop */
							while ( have_posts() ): the_post(); ?>
							<?php
								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part( 'template-parts/content' );?>
							<?php
								endwhile;
							?>
								<div class="news-page__pagination blog-page__pagination">
									<?php arckytech_pagination( '<span class="icon-left-arrow"></span>', '<span class="icon-right-arrow"></span>', '', ['class' => 'pg-pagination list-unstyled'] );?>
								</div>
							<?php
							else:
								get_template_part( 'template-parts/content', 'none' );
							endif;
						?>

					</div>
				</div>

				<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
					<div class="col-xl-4 col-lg-5">
						<div class="arc-sidebar-wrapper arc-sidebar-ml--24 sidebar">
							<?php get_sidebar();?>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	</section>
		<!-- search result item area end -->
<?php
get_footer();