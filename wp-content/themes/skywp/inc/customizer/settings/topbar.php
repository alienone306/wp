<?php
/**
* TopBar Customizer Options
*
* @package Urchenko Technologies
* @subpackage SkyWP WordPress theme
* @since SkyWP 1.0.0
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Customizer options
*
* @since 1.0.0
*/
add_action( 'customize_register', 'skywp_customizer_options' );
function skywp_customizer_options( $wp_customize ) {

	/**
	 * Panel
	 */
	$wp_customize->add_panel( 'skywp_topbar_panel', array(
		'title' 			=> esc_html__( 'TopBar', 'skywp' ),
		'priority' 			=> 21,
	) );





	/**
	 * Section
	 */
	$wp_customize->add_section( 'skywp_topbar_main', array(
		'title'				=> esc_html__( 'Main', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_topbar_panel',
	) );

	/**
	 * Top Bar
	 */
	$wp_customize->add_setting( 'skywp_topbar', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar', array(
		'label'					=> esc_html__('Show TopBar', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar',
		'priority'				=> 10,
	) ) );

	/**
	 * Topbar Shadow Bottom
	 */
	$wp_customize->add_setting( 'skywp_topbar_shadow', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_shadow', array(
		'label'					=> esc_html__('Shadow', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_shadow',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	* TopBar Visibility
	*/
	$wp_customize->add_setting( 'skywp_topbar_visibility', array(
		'default'		=> 'all-devices',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_visibility', array(
		'label'			=> esc_html__('Visibility', 'skywp'),
		'type'			=> 'select',
		'section'		=> 'skywp_topbar_main',
		'settings'		=> 'skywp_topbar_visibility',
		'priority'		=> 10,
		'choices'		=> array(
			'all-devices'			=> esc_html__('Show On All Devices', 'skywp'),
			'hide-tablet'			=> esc_html__('Hide On Tablet', 'skywp'),
			'hide-mobile'			=> esc_html__('Hide On Mobile', 'skywp'),
			'hide-tablet-mobile'	=> esc_html__('Hide On Tablet and Mobile', 'skywp'),
		),
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Width
	 */
	$wp_customize->add_setting( 'topbar_width', array(
		'default'				=> '1200',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'topbar_width', array(
		'label'					=> esc_html__('Width (px)', 'skywp'),
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'topbar_width',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Padding
	 */
	$wp_customize->add_setting( 'skywp_topbar_padding', array(
		'default'				=> '0px 0px 0px 0px',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_padding', array(
		'label'					=> esc_html__('Padding (px)', 'skywp'),
		'description'			=> esc_html__( 'top right bottom left: 10px 0px 10px 0px', 'skywp' ),
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_padding',
		'priority'				=> 10,
		'type'           => 'text',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	* TopBar Alignment
	*/
	$wp_customize->add_setting( 'skywp_topbar_alignment', array(
		'default'			=> 'space-between',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_alignment', array(
		'label'				=> esc_html__( 'Alignment', 'skywp' ),
		'type'				=> 'select',
		'section'			=> 'skywp_topbar_main',
		'settings'			=> 'skywp_topbar_alignment',
		'priority'			=> 10,
		'choices'			=> array(
			'space-between'		=> esc_html__( 'Spece Between', 'skywp' ),
			'space-around'		=> esc_html__( 'Space Around', 'skywp' ),
			'center'		=> esc_html__( 'Center', 'skywp' ),
			'flex-start'		=> esc_html__( 'Flex Start', 'skywp' ),
			'flex-end'		=> esc_html__( 'Flex End', 'skywp' ),
		),
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	* Position
	*/
	$wp_customize->add_setting( 'skywp_topbar_position', array(
		'default'			=> 'relative',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_position', array(
		'label'				=> esc_html__( 'Position', 'skywp' ),
		'type'				=> 'select',
		'section'			=> 'skywp_topbar_main',
		'settings'			=> 'skywp_topbar_position',
		'priority'			=> 10,
		'choices'			=> array(
			'relative'		=> esc_html__( 'Relative', 'skywp' ),
			'absolute'		=> esc_html__( 'Absolute', 'skywp' ),
		),
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Backgtoung
	 */
	$wp_customize->add_setting( 'skywp_bg_topbar', array(
		'default'     => '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_bg_topbar', array(
		'label'     => __( 'Background', 'skywp' ),
		'section'   => 'skywp_topbar_main',
		'settings'  => 'skywp_bg_topbar',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );





	/**
	 * Social buttons
	 */
	$wp_customize->add_section( 'skywp_topbar_social_buttons', array(
		'title'				=> esc_html__( 'Social media buttons', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_topbar_panel',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) );

	/**
	* Social media buttons style
	*/
	$wp_customize->add_setting( 'skywp_topbar_social_style', array(
		'default'		=> 'style-first',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_social_style', array(
		'label'			=> esc_html__('Social media buttons style', 'skywp'),
		'type'			=> 'select',
		'section'		=> 'skywp_topbar_social_buttons',
		'settings'		=> 'skywp_topbar_social_style',
		'priority'		=> 10,
		'choices'		=> array(
			'style-first'			=> esc_html__('Style first', 'skywp'),
		),
	) ) );

	/**
	 * Social buttons color
	 */
	$wp_customize->add_setting( 'skywp_topbar_social_buttons_color', array(
		'default'     => '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_topbar_social_buttons_color', array(
		'label'     => __( 'Color', 'skywp' ),
		'section'   => 'skywp_topbar_social_buttons',
		'settings'  => 'skywp_topbar_social_buttons_color',
		'priority'			=> 10,
	) ) );





	/**
	 * Content
	 */
	$wp_customize->add_section( 'skywp_topbar_content', array(
		'title'				=> esc_html__( 'Content', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_topbar_panel',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) );

	/**
	 * Font size
	 */
	$wp_customize->add_setting( 'skywp_topbar_text_font_size', array(
		'default'				=> '15',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_text_font_size', array(
		'label'					=> esc_html__('Font Size (px)', 'skywp'),
		'type'           => 'number',
		'section'				=> 'skywp_topbar_content',
		'settings'				=> 'skywp_topbar_text_font_size',
		'priority'				=> 10,
	) ) );

	/**
	* TopBar Text Color
	*/
	$wp_customize->add_setting( 'skywp_topbar_text_color', array(
		'default'			=> '#c7c7c7',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_topbar_text_color', array(
		'label'				=> esc_html__( 'Text Color', 'skywp' ),
		'section'			=> 'skywp_topbar_content',
		'settings'			=> 'skywp_topbar_text_color',
		'priority'			=> 10,
	) ) );




}



