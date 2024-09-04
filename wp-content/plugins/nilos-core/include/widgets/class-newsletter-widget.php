
<?php

	/**
	 * Arckytec newsletter
	 *
	 *
	 * @author 		themedox
	 * @category 	Widgets
	 * @package 	NilosCore/Widgets
	 * @version 	1.0.0
	 * @extends 	WP_Widget
	*/

class Custom_newsletter_Widget extends WP_Widget {

    // Constructor function
    public function __construct() {
        parent::__construct(
            'Custom_Newsletter_Widget',  // Widget ID
            'Arckytech Newsletter widget',  // Widget name
            array(
                'description' => 'A custom widget to display categories in the sidebar.'
            )
        );
    }
    // Widget output
    public function widget($args, $instance) {
<<<<<<< HEAD
        echo $args['before_widget'];
        ?>
        
        <div class="footer-widget__contact-form mc-form">
=======
       echo $args['before_widget'];
        ?>
        <div class="footer-widget__contact-form mc-form" data-url="MC_FORM_URL"
            novalidate="novalidate">
>>>>>>> 908a6e453fedfd4f13f74df69934f06ab708acfe
            <div class="footer-widget__contact-form-input-box">
                <?php echo do_shortcode($instance['script']); ?>
                <button type="submit" class="footer-widget__contact-btn"><span class="icon-right-arrow"></span></button>
            </div>
        </div>
<<<<<<< HEAD
=======

>>>>>>> 908a6e453fedfd4f13f74df69934f06ab708acfe
        <?php
        echo $args['after_widget'];
    }

    // Widget form
    public function form($instance) {
        $script = isset($instance['script']) ? $instance['script'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('script'); ?>"> <?php _e(' Contact Form 7 Script:', 'arckytec'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('script'); ?>" name="<?php echo $this->get_field_name('script'); ?>" type="text" value="<?php echo esc_attr($script); ?>"/>
        </p>
        <?php
    }

    // Update widget instance
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['script'] = (!empty($new_instance['script'])) ? strip_tags($new_instance['script']) : '';
        return $instance;
    }
}

add_action('widgets_init', function(){
	register_widget('Custom_newsletter_Widget');
});
