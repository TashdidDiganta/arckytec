<?php
class Custom_Social_Widget extends WP_Widget {

    // Constructor function
    public function __construct() {
        parent::__construct(
            'Custom_Social_Widget',  // Widget ID
            'Arckytech Social Widget',  // Widget name
            array(
                'description' => 'A custom widget to display categories in the sidebar.'
            )
        );
    }

    // Widget output
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $social_links = get_theme_mod('arckytech_footer_social','');

        ?>
        <div class="footer-widget__social">
            <?php foreach($social_links as $social) : ?>
                <a href="<?php echo $social['link_url']; ?>"><?php echo $social['link_target']; ?></a>
            <?php endforeach; ?>
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
	register_widget('Custom_Social_Widget');
});
