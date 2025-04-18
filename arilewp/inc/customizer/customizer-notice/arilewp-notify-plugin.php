<?php
/*
 *  Customizer Notifications
 */ 


require get_template_directory() . '/inc/customizer/customizer-notice/arilewp-customizer-notify.php';
$arilewp_config_customizer = array(
    'recommended_plugins' => array( 
        'arile-extra' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the features and business sections of the FrontPage. please install and activate %s plugin', 'arilewp' ), '<strong>Arile Extra</strong>' 
            ),
        ),
    ),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'arilewp' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'arilewp' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'arilewp' ),
	'activate_button_label'     => esc_html__( 'Activate', 'arilewp' ),
	'arilewp_deactivate_button_label'   => esc_html__( 'Deactivate', 'arilewp' ),
);
ArileWP_Customizer_Notify::init( apply_filters( 'arilewp_customizer_notify_array', $arilewp_config_customizer ) );