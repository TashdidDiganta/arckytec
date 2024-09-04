<?php get_header(); ?>


<!--Services Page Start-->
<section class="services-page">
    <div class="container">
        <?php if(have_posts()): ?>
        <div class="row">
            <?php while(have_posts()): the_post(); ?>
            <!--Services Three Single Start-->
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                <div class="services-three__single">
                    <div class="services-three__icon">
                        <span class="icon-service-architecture"></span>
                    </div>
                    <div class="services-three__title-box">
                        <div class="services-three__shape-1">
                            <img src="assets/images/shapes/services-three-shape-1.png" alt="">
                        </div>
                        <div class="services-three__shape-2">
                            <img src="assets/images/shapes/services-three-shape-2.png" alt="">
                        </div>
                        <h3 class="services-three__title"><a href="architecture.html"><?php the_title(); ?></a></h3>
                    </div>
                    <p class="services-three__text">Nulla condimentum nisl dui semper tellus elit consequat eu
                        nullam vel nisl tempus pulvinar lorem ac rutrum enim suspendisse id.</p>
                    <div class="services-three__view-more">
                        <a href="architecture.html">View More<span class="icon-right-arrow-3"></span></a>
                    </div>
                </div>
            </div>
            <!--Services Three Single End-->
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="blog-page__pagination">
                    <ul class="pg-pagination list-unstyled">
                        <li class="prev">
                            <a href="#" aria-label="prev"><span class="icon-left-arrow"></span></a>
                        </li>
                        <li class="count active"><a href="#">1</a></li>
                        <li class="count"><a href="#">2</a></li>
                        <li class="count"><a href="#">3</a></li>
                        <li class="next">
                            <a href="#" aria-label="Next"><span class="icon-right-arrow"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Services Page End-->
<?php get_footer(); ?>
