<?php
/**
 * Page Header Settings.
 *
 * @package arilewp
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
* Page Header Settings.
*/

if ( ! class_exists( 'ArileWP_Customize_General_Option' ) ) :

	class ArileWP_Customize_General_Option extends ArileWP_Customize_Base_Option {

		public function elements() {

			return array(
			
			
			    'arilewp_page_header_heading' => array(
					'setting' => array(),
					'control' => array(
						'type'    => 'heading',
						'priority'        => 1,
						'label'   => esc_html__( 'General Settings', 'arilewp' ),
						'section' => 'arilewp_theme_general',
					),
				),
			
					'arilewp_animation_disabled'            => array(
						'setting' => array(
							'default'           => true,
							'sanitize_callback' => array( 'ArileWP_Customizer_Sanitize', 'sanitize_checkbox' ),
						),
						'control' => array(
							'type'     => 'toggle',
							'priority' => 2,
							'label'    => esc_html__( 'Site Animation Enable/Disable', 'arilewp' ),
							'section'  => 'arilewp_theme_general',
						),
					),
			  

			);

		}

	}

	new ArileWP_Customize_General_Option();

endif;
