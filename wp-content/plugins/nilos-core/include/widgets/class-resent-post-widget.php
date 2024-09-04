<?php
class Custom_Resent_Post_Widget extends WP_Widget {

    // Constructor function
    public function __construct() {
        parent::__construct(
            'Custom_Resent_Post_Widget',  // Widget ID
            'Arckytech Resent Posts',  // Widget name
            array(
                'description' => 'A custom widget to display categories in the sidebar.'
            )
        );
    }

    // Widget output
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];

        $post_args = array(
            'post_type' => 'post', 
            'posts_per_page' => 3, 
        );

        $post = new WP_Query($post_args);
    
        ?>
       
        <div class="sidebar__single sidebar__post">
            <h3 class="news-page__sidebar-title sidebar_title"><?php echo $title ?></h3>
            <?php if($post->have_posts() ) : ?>
            <ul class="sidebar__post-list list-unstyled">
                <?php while($post->have_posts()) : ?>
                <?php $post->the_post(); ?>
                <li>
                    <div class="sidebar__post-image">
                        <?php echo get_the_post_thumbnail(); ?>
                    </div>
                    <div class="sidebar__post-content">
                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php  the_title(); ?></a>
                        </h3>
                        <p><?php echo get_the_date('M, d, Y');  ?></p>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    // Widget form
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php
    }

    // Update widget instance
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

add_action('widgets_init', function(){
	register_widget('Custom_Resent_Post_Widget');
});