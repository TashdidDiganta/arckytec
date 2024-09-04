<?php
/**
 * Elementor Widget Traits Functions
 */
namespace Arc\Widgets;

trait ArcElementorTraits {
    
    protected function get_all_project(){
        $services = new \WP_Query(array(
            'post_type'     => 'project',
            'post_status'   => 'publish',
            'posts_per_page'    => -1
        ));

        $data = array();

        if($services->have_posts()){
            while($services->have_posts()){
                $services->the_post();
                $data[get_the_ID()] = get_the_title();
            }
        }

        return $data;
    }

    protected function get_all_services(){
        $services = new \WP_Query(array(
            'post_type'     => 'services',
            'post_status'   => 'publish',
            'posts_per_page'    => -1
        ));

        $data = array();

        if($services->have_posts()){
            while($services->have_posts()){
                $services->the_post();
                $data[get_the_ID()] = get_the_title();
            }
        }

        return $data;
    }

    protected function service_repeater(){
        $this->start_controls_section(
            '_services_list',
            [
                'label' => esc_html__('Services List', 'arc-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_service_style'   => ['service-1', 'service-4']
                ],
            ]
        );
        $this->add_control(
            'services_list',
            [
                'label' => esc_html__('Services List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'arc-core' ),
                        'type'  => \Elementor\Controls_Manager::ICONS
                    ],
                    [
                        'name'  => 'service',
                        'label' => esc_html__('Select A Service', 'arc-core'),
                        'type'  => \Elementor\Controls_Manager::SELECT2,
                        'options'   => $this->get_all_services(),
                    ],

                    ],
                    'default'   => [
                        [
                            'name'  => esc_html__('Creative Architecture', 'arc-core'),

                        ],
                    ],
            ]
        );
        $this->end_controls_section();
    } 
    protected function arc_switcher_ctrl($id, $label){
        $this->add_control(
			'_' .$id,
			[
				'label' => esc_html( $label ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'arc-core' ),
				'label_off' => esc_html__( 'Hide', 'arc-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
    }
}