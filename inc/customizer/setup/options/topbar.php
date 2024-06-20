<?php
/**
 * OceanWP Customizer Settings: Top Bar
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = [

    'ocean_top_bar' => [
        'type'              => 'ocean-switch',
        'label'             => esc_html__( 'Enable Top Bar', 'oceanwp' ),
        'section'           => 'ocean_topbar_settings',
        'default'           => true,
        'transport'         => 'refresh',
        'priority'          => 10,
        'hideLabel'         => false,
        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
    ],

    'ocean_top_bar_full_width' => [
        'type'              => 'ocean-switch',
        'label'             => esc_html__( 'Display Top Bar in Full Width', 'oceanwp' ),
        'section'           => 'ocean_topbar_settings',
        'default'           => false,
        'transport'         => 'postMessage',
        'priority'          => 10,
        'hideLabel'         => false,
        'active_callback'   => 'ocean_cac_topbar',
        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
    ],

    'ocean_divider_after_top_bar_full_width_setting' => [
        'type'            => 'ocean-divider',
        'section'         => 'ocean_topbar_settings',
        'transport'       => 'postMessage',
        'top'             => 1,
        'bottom'          => 10,
        'priority'        => 10,
        'active_callback' => 'ocean_cac_topbar',
    ],

    'ocean_top_bar_visibility' => [
        'type'              => 'ocean-select',
        'label'             => esc_html__( 'Visibility', 'oceanwp' ),
        'section'           => 'ocean_topbar_settings',
        'transport'         => 'postMessage',
        'default'           => 'all-devices',
        'priority'          => 10,
        'hideLabel'         => false,
        'multiple'          => false,
        'active_callback'   => 'ocean_cac_topbar',
        'sanitize_callback' => 'sanitize_key',
        'choices'           => [
            'all-devices'        => esc_html__( 'Show On All Devices', 'oceanwp' ),
            'hide-tablet'        => esc_html__( 'Hide On Tablet', 'oceanwp' ),
            'hide-mobile'        => esc_html__( 'Hide On Mobile', 'oceanwp' ),
            'hide-tablet-mobile' => esc_html__( 'Hide On Tablet & Mobile', 'oceanwp' ),
        ]
    ],

    'ocean_divider_after_top_bar_visibility_setting' => [
        'type' => 'ocean-divider',
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'top' => 10,
        'active_callback' => 'ocean_cac_topbar',
    ],

    'ocean_top_bar_general_section' => [
        'type' => 'section',
        'title' => esc_html__('General Options', 'oceanwp'),
        'section' => 'ocean_topbar_settings',
        'after' => 'ocean_divider_after_top_bar_visibility_setting',
        'class' => 'section-site-layout',
        'priority' => 10,
        'options' => [
            'ocean_top_bar_style' => [
                'type' => 'ocean-select',
                'label' => esc_html__('Elements Positioning', 'oceanwp' ),
                'section' => 'ocean_top_bar_general_section',
                'transport' => 'refresh',
                'default' => 'one',
                'priority' => 10,
                'hideLabel' => false,
                'multiple' => false,
                'active_callback' => 'ocean_cac_topbar',
                'sanitize_callback' => 'sanitize_key',
                'choices' => [
                    'one'   => esc_html__( 'Left Content And Right Social', 'oceanwp' ),
					'two'   => esc_html__( 'Left Social And Right Content', 'oceanwp' ),
					'three' => esc_html__( 'Centered Content And Social', 'oceanwp' ),
                ]
            ],

            'ocean_divider_after_top_bar_style_setting' => [
                'type' => 'ocean-divider',
                'section' => 'ocean_top_bar_general_section',
                'transport' => 'postMessage',
                'priority' => 10,
                'active_callback' => 'ocean_cac_topbar',
            ],

            'ocean_top_bar_padding' => [
                'id' => 'ocean_top_bar_padding',
                'label'    => esc_html__( 'Padding (px)', 'oceanwp' ),
                'type'     => 'ocean-spacing',
                'section'  => 'ocean_top_bar_general_section',
                'transport' => 'postMessage',
                'priority' => 10,
                'hideLabel'    => false,
                'isType'       => 'padding',
                'active_callback' => 'ocean_cac_topbar',
                'setting_args' => [
                    'spacingTop' => [
                        'id' => 'ocean_top_bar_top_padding',
                        'label' => esc_html__( 'Top', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                            'default'   => 8,
                        ],
                    ],
                    'spacingRight' => [
                        'id' => 'ocean_top_bar_right_padding',
                        'label' => esc_html__( 'Right', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                            'default'   => 0,
                        ],
                    ],
                    'spacingBottom' => [
                        'id' => 'ocean_top_bar_bottom_padding',
                        'label' => esc_html__( 'Bottom', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                            'default'   => 8,
                        ],
                    ],
                    'spacingLeft' => [
                        'id' => 'ocean_top_bar_left_padding',
                        'label' => esc_html__( 'Left', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                            'default'   => 0,
                        ],
                    ],
                    'spacingTopTablet' => [
                        'id' => 'ocean_top_bar_tablet_top_padding',
                        'label' => esc_html__( 'Top', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'spacingRightTablet' => [
                        'id' => 'ocean_top_bar_tablet_right_padding',
                        'label' => esc_html__( 'Right', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'spacingBottomTablet' => [
                        'id' => 'ocean_top_bar_tablet_bottom_padding',
                        'label' => esc_html__( 'Bottom', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'spacingLeftTablet' => [
                        'id' => 'ocean_top_bar_tablet_left_padding',
                        'label' => esc_html__( 'Left', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'spacingTopMobile' => [
                        'id' => 'ocean_top_bar_mobile_top_padding',
                        'label' => esc_html__( 'Top', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'spacingRightMobile' => [
                        'id' => 'ocean_top_bar_mobile_right_padding',
                        'label' => esc_html__( 'Right', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'spacingBottomMobile' => [
                        'id' => 'ocean_top_bar_mobile_bottom_padding',
                        'label' => esc_html__( 'Bottom', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'spacingLeftMobile' => [
                        'id' => 'ocean_top_bar_mobile_left_padding',
                        'label' => esc_html__( 'Left', 'oceanwp' ),
                        'attr' => [
                            'transport' => 'postMessage',
                        ],
                    ],
                ],
                'preview' => 'queryWithType',
                'css' => [
                    'selector' => '#top-bar',
                    'property' => 'padding'
                ],
            ],
        ]
    ],

    'ocean_spacer_for_top_bar_content_section' => [
        'type' => 'ocean-spacer',
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'active_callback' => 'ocean_cac_topbar',
    ],

    'ocean_top_bar_content_section' => [
        'type'     => 'section',
        'title'    => esc_html__( 'Content', 'oceanwp' ),
        'section'  => 'ocean_topbar_settings',
        'after'    => 'ocean_spacer_for_top_bar_content_section',
        'class'    => 'section-site-layout',
        'priority' => 10,
        'options'  => [
            'ocean_desc_for_custom_topbar_template_settings' => [
                'type'            => 'ocean-content',
                'isContent'       => esc_html__( 'In the Top Bar content area, you can display regular text, HTML or shortcodes; or you can replace default content with a custom template.', 'oceanwp' ),
                'section'         => 'ocean_top_bar_content_section',
                'class'           => 'description',
                'transport'       => 'refresh',
                'priority'        => 10,
                'active_callback' => 'ocean_cac_topbar',
            ],

            'ocean_top_bar_content' => [
                'type'              => 'ocean-textarea',
                'label'             => esc_html__( 'Content', 'oceanwp' ),
                'section'           => 'ocean_top_bar_content_section',
                'transport'         => 'postMessage',
                'default'           => esc_html__( 'Place your content here', 'oceanwp' ),
                'priority'          => 10,
                'hideLabel'         => false,
                'active_callback'   => 'ocean_cac_topbar',
                'sanitize_callback' => 'wp_kses_post',
            ],

            'ocean_divider_after_top_bar_content_setting' => [
                'type'            => 'ocean-divider',
                'section'         => 'ocean_top_bar_content_section',
                'transport'       => 'postMessage',
                'priority'        => 10,
                'active_callback' => 'ocean_cac_topbar',
            ],

            'ocean_top_bar_template' => [
                'type'              => 'ocean-select',
                'label'             => esc_html__( 'Select Template', 'oceanwp' ),
                'desc'              => esc_html__( 'You can replace the default Top Bar content area with a custom template created in OceanWP > My Library.', 'oceanwp' ),
                'section'           => 'ocean_top_bar_content_section',
                'transport'         => 'refresh',
                'default'           => '0',
                'priority'          => 10,
                'hideLabel'         => false,
                'multiple'          => false,
                'active_callback'   => 'ocean_cac_topbar',
                'sanitize_callback' => 'sanitize_key',
                'choices'           => oceanwp_library_template_choices(),
            ]
        ]
    ],

    'ocean_spacer_for_top_bar_social_section' => [
        'type'            => 'ocean-spacer',
        'section'         => 'ocean_topbar_settings',
        'transport'       => 'postMessage',
        'priority'        => 10,
        'active_callback' => 'ocean_cac_topbar',
    ],

    'ocean_top_bar_social_menu_section' => [
        'type'     => 'section',
        'title'    => esc_html__( 'Social Menu', 'oceanwp' ),
        'section'  => 'ocean_topbar_settings',
        'after'    => 'ocean_spacer_for_top_bar_social_section',
        'class'    => 'section-site-layout',
        'priority' => 10,
        'options'  => [
            'ocean_top_bar_social' => [
                'type'              => 'ocean-switch',
                'label'             => esc_html__( 'Enable Social Menu', 'oceanwp' ),
                'section'           => 'ocean_top_bar_social_menu_section',
                'default'           => true,
                'transport'         => 'refresh',
                'priority'          => 10,
                'hideLabel'         => false,
                'active_callback'   => 'ocean_cac_topbar',
                'sanitize_callback' => 'oceanwp_sanitize_checkbox',
            ],

            'ocean_divider_after_top_bar_social_setting' => [
                'type' => 'ocean-divider',
                'section' => 'ocean_top_bar_social_menu_section',
                'transport' => 'postMessage',
                'priority' => 10,
                'top' => 1,
                'bottom' => 20,
                'active_callback' => 'ocean_cac_topbar_social_menu',
            ],

            'ocean_topbar_social_menu_default_section' => [
                'type' => 'section',
                'title' => esc_html__( 'Social Menu Options', 'oceanwp' ),
                'section' => 'ocean_top_bar_social_menu_section',
                'after' => 'ocean_divider_after_top_bar_social_setting',
                'class' => 'section-site-layout',
                'priority' => 10,
                'options' => [
                    'ocean_top_bar_social_target' => [
                        'type' => 'ocean-buttons',
                        'label' => esc_html__( 'Links Target', 'oceanwp' ),
                        'section' => 'ocean_topbar_social_menu_default_section',
                        'default'  => 'blank',
                        'transport' => 'postMessage',
                        'priority' => 10,
                        'hideLabel' => false,
                        'wrap'    => false,
                        'active_callback' => 'ocean_cac_topbar_social_menu',
                        'sanitize_callback' => 'sanitize_key',
                        'choices' => [
                            'blank' => [
                                'id'     => 'blank',
                                'label'   => esc_html__( 'New Tab', 'oceanwp' ),
                                'content' => esc_html__( 'New Tab', 'oceanwp' ),
                            ],
                            'self'  => [
                                'id'     => 'self',
                                'label'   => esc_html__( 'Same Tab', 'oceanwp' ),
                                'content' => esc_html__( 'Same Tab', 'oceanwp' ),
                            ]
                        ]
                    ],

                    'ocean_top_bar_social_font_size' => [
                        'id'      => 'ocean_top_bar_social_font_size',
                        'label'    => esc_html__( 'Icon Size', 'oceanwp' ),
                        'type'     => 'ocean-range-slider',
                        'section'  => 'ocean_topbar_social_menu_default_section',
                        'transport' => 'postMessage',
                        'priority' => 10,
                        'hideLabel'    => false,
                        'isUnit'       => true,
                        'isResponsive' => true,
                        'min'          => 1,
                        'max'          => 100,
                        'step'         => 1,
                        'active_callback' => 'ocean_cac_topbar_social_menu',
                        'sanitize_callback' => 'oceanwp_sanitize_number_blank',
                        'setting_args' => [
                            'desktop' => [
                                'id' => 'ocean_top_bar_social_font_size',
                                'label' => esc_html__( 'Desktop', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                    'default'  => 14,
                                ],
                            ],
                            'tablet' => [
                                'id' => 'ocean_top_bar_social_tablet_font_size',
                                'label' => esc_html__( 'Tablet', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                            'mobile' => [
                                'id' => 'ocean_top_bar_social_mobile_font_size',
                                'label' => esc_html__( 'Mobile', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                            'unit' => [
                                'id' => 'ocean_top_bar_social_font_size_unit',
                                'label' => esc_html__( 'Unit', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                    'default' => 'px',
                                ],
                            ],
                        ],
                        'preview' => 'queryWithType',
                        'css' => [
                            '#top-bar-social li a' => ['font-size']
                        ]
                    ],

                    'ocean_top_bar_social_padding' => [
                        'id' => 'ocean_top_bar_social_padding',
                        'label'    => esc_html__( 'Padding', 'oceanwp' ),
                        'type'     => 'ocean-spacing',
                        'section'  => 'ocean_topbar_social_menu_default_section',
                        'transport' => 'postMessage',
                        'priority' => 10,
                        'hideLabel'    => false,
                        'isType'       => 'padding',
                        'isTop'        => false,
                        'isBottom'     => false,
                        'active_callback' => 'ocean_cac_topbar_social_menu',
                        'setting_args' => [
                            'spacingRight' => [
                                'id' => 'ocean_top_bar_social_right_padding',
                                'label' => esc_html__( 'Right', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                    'default' => 6,
                                ],
                            ],
                            'spacingLeft' => [
                                'id' => 'ocean_top_bar_social_left_padding',
                                'label' => esc_html__( 'Left', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                    'default' => 6,
                                ],
                            ],
                            'spacingRightTablet' => [
                                'id' => 'ocean_top_bar_social_tablet_right_padding',
                                'label' => esc_html__( 'Right', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                            'spacingLeftTablet' => [
                                'id' => 'ocean_top_bar_social_tablet_left_padding',
                                'label' => esc_html__( 'Left', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                            'spacingRightMobile' => [
                                'id' => 'ocean_top_bar_social_mobile_right_padding',
                                'label' => esc_html__( 'Right', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                            'spacingLeftMobile' => [
                                'id' => 'ocean_top_bar_social_mobile_left_padding',
                                'label' => esc_html__( 'Left', 'oceanwp' ),
                                'attr' => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ],
                        'preview' => 'queryWithType',
                        'css' => [
                            'selector' => '#top-bar-social li a',
                            'property' => 'padding'
                        ],
                    ],

                    'ocean_divider_after_top_bar_social_padding_setting' => [
                        'type' => 'ocean-divider',
                        'section' => 'ocean_topbar_social_menu_default_section',
                        'transport' => 'postMessage',
                        'priority' => 10,
                        'active_callback' => 'ocean_cac_topbar_social_menu',
                    ],

                    'ocean_top_bar_social_links_color' => [
                        'type' => 'ocean-color',
                        'label' => esc_html__( 'Social Links', 'oceanwp' ),
                        'section' => 'ocean_topbar_social_menu_default_section',
                        'transport' => 'postMessage',
                        'priority' => 10,
                        'hideLabel' => false,
                        'showAlpha' => true,
                        'showPalette' => true,
                        'active_callback' => 'ocean_cac_topbar_social_menu',
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args' => [
                            'normal' => [
                                'id' => 'ocean_top_bar_social_links_color',
                                'key' => 'normal',
                                'label' => 'Normal',
                                'selector' => [
                                    '#top-bar-social li a' => 'color',
                                    '#top-bar-social li a .owp-icon use' => 'stroke'
                                ],
                                'attr' => [
                                    'transport' => 'postMessage',
                                    'default' => '#bbbbbb',
                                ],
                            ],
                            'hover' => [
                                'id' => 'ocean_top_bar_social_hover_links_color',
                                'key' => 'hover',
                                'label' => 'Hover',
                                'selector' => [
                                    '#top-bar-social li a:hover' => 'color',
                                    '#top-bar-social li a:hover .owp-icon use' => 'stroke'
                                ],
                                'attr' => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ]
                    ],
                ]
            ],

            'ocean_spacer_for_top_bar_social_link_section' => [
                'type' => 'ocean-spacer',
                'section' => 'ocean_top_bar_social_menu_section',
                'transport' => 'postMessage',
                'priority' => 10,
                'top' => 10,
                'bottom' => 10,
                'active_callback' => 'ocean_cac_topbar_social_menu',
            ],

            'ocean_topbar_social_menu_links_section' => [
                'type' => 'section',
                'title' => esc_html__('Social Links', 'oceanwp'),
                'section' => 'ocean_top_bar_social_menu_section',
                'after' => 'ocean_spacer_for_top_bar_social_link_section',
                'class' => 'section-site-layout',
                'priority' => 10,
                'active_callback' => 'ocean_cac_topbar_social_menu',
                'options' => [
                    'ocean_topbar_social_link_profile_options' => [
                        'type' => 'ocean-social-links',
                        'label' => esc_html__('Social Profile', 'oceanwp' ),
                        'section' => 'ocean_topbar_social_menu_links_section',
                        'transport' => 'postMessage',
                        'priority' => 10,
                        'hideLabel' => false,
                        'active_callback' => 'ocean_cac_topbar_social_menu',
                        'social_setting_id' => 'ocean_top_bar_social_profiles',
                        'social_profiles' => oceanwp_social_options()
                    ],
                ]
            ],

            'ocean_divider_for_top_bar_social_menu_custom_template_section' => [
                'type'            => 'ocean-divider',
                'section'         => 'ocean_top_bar_social_menu_section',
                'transport'       => 'postMessage',
                'priority'        => 10,
                'top'             => 10,
                'bottom'          => 10,
                'active_callback' => 'ocean_cac_topbar_social_menu',
            ],

            'ocean_top_bar_social_menu_custom_template_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Custom Template', 'oceanwp' ),
                'section'  => 'ocean_top_bar_social_menu_section',
                'after'    => 'ocean_divider_for_top_bar_social_menu_custom_template_section',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
                    'ocean_desc_for_top_bar_social_menu_custom_template_settings' => [
                        'type'            => 'ocean-content',
                        'isContent'       => esc_html__( 'You can replace the defualt Top Bar social menu with a custom template created in OceanWP > My Library.', 'oceanwp' ),
                        'section'         => 'ocean_top_bar_social_menu_custom_template_section',
                        'class'           => 'description',
                        'transport'       => 'postMessage',
                        'priority'        => 10,
                        'active_callback' => 'ocean_cac_topbar_social_menu',
                    ],

                    'ocean_top_bar_social_alt_template' => [
                        'type' => 'ocean-select',
                        'label' => esc_html__('Select Template', 'oceanwp' ),
                        'section' => 'ocean_top_bar_social_menu_custom_template_section',
                        'transport' => 'refresh',
                        'default' => '0',
                        'priority' => 10,
                        'hideLabel' => false,
                        'multiple' => false,
                        'active_callback' => 'ocean_cac_topbar_social_menu',
                        'sanitize_callback' => 'sanitize_key',
                        'choices' => oceanwp_library_template_choices(),
                    ],

                ]
            ]
        ]
    ],

    'ocean_divider_after_top_bar_social_menu_section' => [
        'type' => 'ocean-divider',
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'active_callback' => 'ocean_cac_topbar',
    ],

    'ocean_top_menu_typography' => [
        'id' => 'ocean_top_menu_typography',
        'type' => 'ocean-typography',
        'label' => esc_html__('Typography', 'oceanwp'),
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'hideLabel' => false,
        'selector' => '#top-bar-content,#top-bar-social-alt',
        'active_callback' => 'ocean_cac_topbar',
        'setting_args' => [
            'fontFamily' => [
                'id' => 'top_menu_typography[font-family]',
                'label' => esc_html__('Font Family', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'fontWeight' => [
                'id' => 'top_menu_typography[font-weight]',
                'label' => esc_html__('Font Weight', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'fontWeightTablet' => [
                'id' => 'top_menu_tablet_typography[font-weight]',
                'label' => esc_html__('Font Weight', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'fontWeightMobile' => [
                'id' => 'top_menu_mobile_typography[font-weight]',
                'label' => esc_html__('Font Weight', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'fontSubset' => [
                'id' => 'top_menu_typography[font-subset]',
                'label' => esc_html__('Font Subset', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'fontSize' => [
                'id' => 'top_menu_typography[font-size]',
                'label' => esc_html__('Font Size', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => 12,
                ],
            ],
            'fontSizeTablet' => [
                'id' => 'top_menu_tablet_typography[font-size]',
                'label' => esc_html__('Font Size', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'fontSizeMobile' => [
                'id' => 'top_menu_mobile_typography[font-size]',
                'label' => esc_html__('Font Size', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'fontSizeUnit' => [
                'id' => 'top_menu_typography[font-size-unit]',
                'label' => esc_html__('Unit', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'letterSpacing' => [
                'id' => 'top_menu_typography[letter-spacing]',
                'label' => esc_html__('Letter Spacing', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'letterSpacingTablet' => [
                'id' => 'top_menu_tablet_typography[letter-spacing]',
                'label' => esc_html__('Letter Spacing', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'letterSpacingMobile' => [
                'id' => 'top_menu_mobile_typography[letter-spacing]',
                'label' => esc_html__('Letter Spacing', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'letterSpacingUnit' => [
                'id' => 'top_menu_typography[letter-spacing-unit]',
                'label' => esc_html__('Unit', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => 'px'
                ],
            ],
            'lineHeight' => [
                'id' => 'top_menu_typography[line-height]',
                'label' => esc_html__('Line Height', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => 1.8,
                ],
            ],
            'lineHeightTablet' => [
                'id' => 'top_menu_tablet_typography[line-height]',
                'label' => esc_html__('Line Height', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'lineHeightMobile' => [
                'id' => 'top_menu_mobile_typography[line-height]',
                'label' => esc_html__('Line Height', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'lineHeightUnit' => [
                'id' => 'top_menu_typography[line-height-unit]',
                'label' => esc_html__('Unit', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'textTransform' => [
                'id' => 'top_menu_typography[text-transform]',
                'label' => esc_html__('Text Transform', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'textTransformTablet' => [
                'id' => 'top_menu_tablet_typography[text-transform]',
                'label' => esc_html__('Text Transform', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'textTransformMobile' => [
                'id' => 'top_menu_mobile_typography[text-transform]',
                'label' => esc_html__('Text Transform', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
            'textDecoration' => [
                'id' => 'top_menu_typography[text-decoration]',
                'label' => esc_html__('Text Decoration', 'oceanwp'),
                'attr' => [
                    'transport' => 'postMessage',
                ],
            ],
        ]
    ],

    'ocean_divider_after_top_bar_typography_setting' => [
        'type' => 'ocean-divider',
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'top' => 1,
        'bottom' => 10,
        'active_callback' => 'ocean_cac_topbar',
    ],

    'ocean_top_bar_bg' => [
        'type' => 'ocean-color',
        'label' => esc_html__( 'Background', 'oceanwp' ),
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'hideLabel' => false,
        'showAlpha' => true,
        'showPalette' => true,
        'active_callback' => 'ocean_cac_topbar',
        'sanitize_callback' => 'wp_kses_post',
        'setting_args' => [
            'normal' => [
                'id' => 'ocean_top_bar_bg',
                'key' => 'normal',
                'label' => 'Select Color',
                'selector' => [
                    '#top-bar-wrap,.oceanwp-top-bar-sticky' => 'background-color'
                ],
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => '#ffffff',
                ],
            ],
        ]
    ],

    'ocean_top_bar_border_color' => [
        'type' => 'ocean-color',
        'label' => esc_html__( 'Border', 'oceanwp' ),
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'hideLabel' => false,
        'showAlpha' => true,
        'showPalette' => true,
        'active_callback' => 'ocean_cac_topbar',
        'sanitize_callback' => 'wp_kses_post',
        'setting_args' => [
            'normal' => [
                'id' => 'ocean_top_bar_border_color',
                'key' => 'normal',
                'label' => 'Select Color',
                'selector' => [
                    '#top-bar-wrap{border-color' => 'border-color'
                ],
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => '#f1f1f1',
                ],
            ],
        ]
    ],

    'ocean_top_bar_text_color' => [
        'type' => 'ocean-color',
        'label' => esc_html__( 'Text', 'oceanwp' ),
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'hideLabel' => false,
        'showAlpha' => true,
        'showPalette' => true,
        'active_callback' => 'ocean_cac_topbar',
        'sanitize_callback' => 'wp_kses_post',
        'setting_args' => [
            'normal' => [
                'id' => 'ocean_top_bar_text_color',
                'key' => 'normal',
                'label' => 'Select Color',
                'selector' => [
                    '#top-bar-wrap,#top-bar-content strong' => 'color'
                ],
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => '#929292',
                ],
            ],
        ]
    ],

    'ocean_top_bar_link_color' => [
        'type' => 'ocean-color',
        'label' => esc_html__( 'Link', 'oceanwp' ),
        'section' => 'ocean_topbar_settings',
        'transport' => 'postMessage',
        'priority' => 10,
        'hideLabel' => false,
        'showAlpha' => true,
        'showPalette' => true,
        'active_callback' => 'ocean_cac_topbar',
        'sanitize_callback' => 'wp_kses_post',
        'setting_args' => [
            'normal' => [
                'id' => 'ocean_top_bar_link_color',
                'key' => 'normal',
                'label' => 'Normal',
                'selector' => [
                    '#top-bar-content a,#top-bar-social-alt a' => 'color'
                ],
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => '#555555',
                ],
            ],
            'hover' => [
                'id' => 'ocean_top_bar_link_color_hover',
                'key' => 'hover',
                'label' => 'Hover',
                'selector' => [
                    '#top-bar-content a:hover,#top-bar-social-alt a:hover' => 'color'
                ],
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => '#13aff0',
                ],
            ],
        ]
    ],

];
