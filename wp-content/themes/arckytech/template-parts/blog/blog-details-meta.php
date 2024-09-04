<?php
$arckytech_blog_view_count = get_theme_mod( 'arckytech_blog_view_count', false );
?>

<ul class="blog-details__meta list-unstyled">
    <li>
        <div class="blog-details__meta-shape"></div>
        <p><?php echo get_the_date('M, d, Y');  ?></p>
    </li>
    <li>
        <div class="blog-details__meta-shape"></div>
        <?php if(!empty(get_the_category())): ?>
            <p><a href=""><?php echo esc_html(get_the_category()[0]->name); ?></a></p>
        <?php endif; ?>

    </li>
    <li>
        <div class="blog-details__meta-shape"></div>
        <p> <?php _e('By', 'arckytec' );?>  <a href="#"> <?php echo ucwords(get_the_author()); ?></a></p>
    </li>
</ul>

