<?php
/**
 * OceanWP Customizer Class
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The OceanWP Customizer class
 */
class OceanWP_Customizer_Init {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		$this->include_settings();

		add_action( 'customize_controls_enqueue_scripts',   array( $this, 'custom_customize_enqueue' ), 7 );
		add_action( 'customize_controls_print_footer_scripts', array( '_WP_Editors', 'force_uncompressed_tinymce' ), 1 );
		add_action( 'customize_controls_print_footer_scripts', array( '_WP_Editors', 'print_default_editor_scripts' ), 45 );
		add_action( 'customize_register', array( $this, 'register_settings' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
	}


    public function register_settings( $wp_customize) {

        require OCEANWP_INC_DIR . 'customizer/setup/extend-section/class-panel.php';
		require OCEANWP_INC_DIR . 'customizer/setup/extend-section/class-section.php';

		// Tweak default controls
		$wp_customize->get_setting( 'custom_logo' )->transport      = 'refresh';
		$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';

		// Move custom logo setting
		$wp_customize->get_control( 'custom_logo' )->section 		= 'ocean_header_logo_section';

		$options = ocean_customize_options('options');

		foreach ( $options as $section_key => $section_options ) {

			$section_args = [
				'title'    => $section_options['title'],
				'priority' => $section_options['priority']
			];

			$wp_customize->add_section(
				$section_key,
				$section_args
			);

			$this->register_options_recursive($wp_customize, $section_key, $section_options['options'] );
		}

	}

    private function register_options_recursive( $wp_customize, $section_key, $options ) {

		foreach ( $options as $option_key => $option_data) {

            if ( 'section' ===  $option_data['type'] ) {

                $child_section_args = [
                    'title'    => $option_data['title'],
                    'priority' => $option_data['priority']
                ];

                if ( isset( $option_data['panel'] ) && $option_data['panel'] ) {
                    $child_section_args['panel'] = $option_data['panel'];
                }

                if ( isset( $option_data['section'] ) && $option_data['section'] ) {
                    $child_section_args['section'] = $option_data['section'];
                }

				if ( isset( $option_data['after'] ) && $option_data['after'] ) {
                    $child_section_args['after'] = $option_data['after'];
                }

				if ( isset( $option_data['class'] ) && $option_data['class'] ) {
                    $child_section_args['section_class'] = $option_data['class'];
                }

                $child_section = new OWP_Customize_Section(
                    $wp_customize,
                    $option_key,
                    $child_section_args
                );

                $wp_customize->add_section( $child_section );

                if ( isset( $option_data['options'] ) ) {
                    $this->register_options_recursive( $wp_customize, $option_key, $option_data['options'] );
                }

            } else {

                $setting_args = [
                    'transport' => $option_data['transport'],
                ];

                if ( isset($option_data['default']) && $option_data['default']) {
                    $setting_args['default'] = $option_data['default'];
                }

                if (isset($option_data['sanitize_callback']) && $option_data['sanitize_callback']) {
                    $setting_args['sanitize_callback'] = $option_data['sanitize_callback'];
                }

                $wp_customize->add_setting(
                    $option_key,
                    $setting_args
                );

                unset( $setting_args );

                $control_args = [
                    'label'       => isset($option_data['label']) ? $option_data['label'] : '',
                    'description' => isset($option_data['desc']) ? $option_data['desc'] : '',
                    'type'        => $option_data['type'],
                    'section'     => isset($option_data['section']) ? $option_data['section'] : '',
                    'priority'    => $option_data['priority'],
                ];

                if ( isset( $option_data['active_callback'] ) && $option_data['active_callback'] ) {
                    $control_args['active_callback'] = $option_data['active_callback'];
                }

                if ( isset( $option_data['setting_args'] ) && $option_data['setting_args'] ) {
                    foreach ( $option_data['setting_args'] as $setting_arg_key => $setting_arg_data ) {

                        $wp_customize->add_setting(
                            $setting_arg_data['id'],
			                $setting_arg_data['attr']
                        );

                        $control_args['settings'][$setting_arg_key] = $setting_arg_data['id'];

						if ( 'ocean-color' ===  $option_data['type'] ) {
							$control_args['json']['settingGroup'][$setting_arg_key] = [
								'id' => $setting_arg_key,
								'key' => isset($setting_arg_data['key']) ? $setting_arg_data['key'] : '',
								'label' => $setting_arg_data['label']
							];
						}

						if ( 'ocean-range-slider' ===  $option_data['type'] ) {
							if ( 'unit' !== $setting_arg_key ) {
								$control_args['json']['settingGroup'][$setting_arg_key] = [
									'id' => $setting_arg_key,
									'label' => $setting_arg_data['label']
								];
							}
						}
                    }
                }

				if ( 'ocean-social-links' ===  $option_data['type'] && isset( $option_data['social_profiles'] ) && $option_data['social_profiles'] ) {
					foreach ( $option_data['social_profiles'] as $social_profile_key => $social_profile_value ) {

						$setting_name = $option_data['social_setting_id'] . '[' . $social_profile_key . ']';

						$wp_customize->add_setting(
							$setting_name,
							array(
								'transport' => 'postMessage'
							)
						);

						$control_args['settings'][$social_profile_key] = $setting_name;

						$control_args['json']['settingGroup'][$social_profile_key] = [
							'id' => $social_profile_key,
							'label' => $social_profile_value['label']
						];
					}
				}

                if ( isset( $option_data['wrapper'] ) && $option_data['wrapper'] ) {
                    $control_args['json']['wrapper'] = $option_data['wrapper'];
                }
                if ( isset( $option_data['class'] ) && $option_data['class'] ) {
                    $control_args['json']['settingClass'] = $option_data['class'];
                }
				if ( isset( $option_data['links'] ) && $option_data['links'] ) {
                    $control_args['json']['links'] = $option_data['links'];
                }
				if ( isset( $option_data['linkIcon'] ) && $option_data['linkIcon'] ) {
                    $control_args['json']['linkIcon'] = $option_data['linkIcon'];
                }
				if ( isset( $option_data['titleIcon'] ) && $option_data['titleIcon'] ) {
                    $control_args['json']['titleIcon'] = $option_data['titleIcon'];
                }
				if ( isset( $option_data['isContent'] ) && $option_data['isContent'] ) {
                    $control_args['json']['isContent'] = $option_data['isContent'];
                }
                if ( isset( $option_data['top'] ) && $option_data['top'] ) {
                    $control_args['json']['top'] = $option_data['top'];
                }
                if ( isset( $option_data['bottom'] ) && $option_data['bottom'] ) {
                    $control_args['json']['bottom'] = $option_data['bottom'];
                }
                if ( isset( $option_data['choices'] ) && $option_data['choices'] ) {
                    $control_args['json']['choices'] = $option_data['choices'];
                }
                if ( isset( $option_data['hideLabel'] ) && $option_data['hideLabel'] ) {
                    $control_args['json']['hideLabel'] = $option_data['hideLabel'];
                }
                if ( isset( $option_data['showAlpha'] ) && $option_data['showAlpha'] ) {
                    $control_args['json']['showAlpha'] = $option_data['showAlpha'];
                }
                if ( isset( $option_data['showPalette'] ) && $option_data['showPalette'] ) {
                    $control_args['json']['showPalette'] = $option_data['showPalette'];
                }
				if ( isset( $option_data['subType'] ) && $option_data['subType'] ) {
                    $control_args['json']['subType'] = $option_data['subType'];
                }
                if ( isset( $option_data['wrap'] ) && $option_data['wrap'] ) {
                    $control_args['json']['wrap'] = $option_data['wrap'];
                }
				if ( isset( $option_data['selector'] ) && $option_data['selector'] ) {
                    $control_args['json']['selector'] = $option_data['selector'];
                }

				if ( 'ocean-range-slider' ===  $option_data['type'] ) {
					if ( isset( $option_data['min'] ) && $option_data['min'] ) {
						$control_args['json']['min'] = $option_data['min'];
					}
					if ( isset( $option_data['max'] ) && $option_data['max'] ) {
						$control_args['json']['max'] = $option_data['max'];
					}
					if ( isset( $option_data['step'] ) && $option_data['step'] ) {
						$control_args['json']['step'] = $option_data['step'];
					}
					if ( isset( $option_data['isUnit'] ) && $option_data['isUnit'] ) {
						$control_args['json']['isUnit'] = $option_data['isUnit'];
					}
					if ( isset( $option_data['isResponsive'] ) && $option_data['isResponsive'] ) {
						$control_args['json']['isResponsive'] = $option_data['isResponsive'];
					}
				}

				if ( 'ocean-spacing' ===  $option_data['type'] ) {
					if ( isset( $option_data['isTop'] ) ) {
						$control_args['json']['isTop'] = $option_data['isTop'];
					}
					if ( isset( $option_data['isRight'] ) ) {
						$control_args['json']['isRight'] = $option_data['isRight'];
					}
					if ( isset( $option_data['isBottom'] ) ) {
						$control_args['json']['isBottom'] = $option_data['isBottom'];
					}
					if ( isset( $option_data['isLeft'] ) ) {
						$control_args['json']['isLeft'] = $option_data['isLeft'];
					}
				}

				if ( 'ocean-rich-text' ===  $option_data['type'] ) {
					if ( isset( $option_data['mediaButtons'] ) ) {
						$control_args['json']['mediaButtons'] = $option_data['mediaButtons'];
					}
					if ( isset( $option_data['tinymce'] ) ) {
						$control_args['json']['tinymce'] = $option_data['tinymce'];
					}
				}

                $wp_customize->add_control(
                    $option_key,
                    $control_args
                );

                unset( $control_args );

                if ( isset( $option_data['options'] ) ) {
                    $this->register_options_recursive( $wp_customize, $option_key, $option_data['options'] );
                }

            }


		}
	}

	/**
	 * Load scripts for customizer
	 *
	 * @since 1.0.0
	 */
	public function custom_customize_enqueue() {

		$uri   = OCEANWP_INC_DIR_URI . 'customizer/setup/assets/dist/';
		$asset = require OCEANWP_INC_DIR . 'customizer/setup/assets/dist/index.asset.php';
		$deps  = $asset['dependencies'];

		array_push( $deps, 'customize-controls' );

		wp_enqueue_script(
			'extend-section',
			OCEANWP_INC_DIR_URI . 'customizer/setup/extend-section/script.js',
			array(),
			'1.0',
			true
		);

		wp_register_script(
			'owp-react-customizer',
			$uri . 'index.js',
			$deps,
			filemtime( OCEANWP_INC_DIR . 'customizer/setup/assets/dist/index.js' ),
			true
		);

		wp_enqueue_style(
			'owp-react-customizer',
			$uri . 'style-index.css',
			array(),
			filemtime( OCEANWP_INC_DIR . 'customizer/setup/assets/dist/style-index.css' )
		);

		wp_enqueue_script( 'owp-react-customizer' );

		$customize_loc = $this->localize_customize_script();
		if ( is_array( $customize_loc ) ) {
			wp_localize_script(
				'owp-react-customizer',
				'oceanCustomize',
				$customize_loc
			);
		}

		if ( is_array( $customize_loc ) ) {
			wp_localize_script(
				'extend-section',
				'oceanSectionCustomize',
				$customize_loc
			);
		}

	}

	/**
	 * Localize Script.
	 *
	 * @return mixed|void
	 */
	public function localize_customize_script() {

		return apply_filters(
			'ocean_customize_localize',
			array(
				// 'options' => ocean_customize_options('options'),
				// 'isPremium' => ocean_check_pro_license(),
				'isOE' => ocean_is_oe_active()
			)
		);
	}

	public function include_settings() {

		require OCEANWP_INC_DIR . 'customizer/setup/functions.php';
        require OCEANWP_INC_DIR . 'customizer/setup/helpers.php';
		require OCEANWP_INC_DIR . 'customizer/setup/callback.php';
		require OCEANWP_INC_DIR . 'customizer/setup/css-output/css.php';
	}

	public function customize_preview_init() {

		$uri   = OCEANWP_INC_DIR_URI . 'customizer/setup/assets/dist/';
		$asset = require OCEANWP_INC_DIR . 'customizer/setup/assets/dist/live-preview.asset.php';
		$deps  = $asset['dependencies'];

		array_push( $deps, 'customize-preview' );

		wp_enqueue_script(
			'ocean-customize-preview',
			$uri . 'live-preview.js',
			$deps,
			filemtime( OCEANWP_INC_DIR . 'customizer/setup/assets/dist/live-preview.js' ),
			true
		);

		wp_localize_script(
			'ocean-customize-preview',
			'oceanCustomizePreview',
			array(
				'options' => ocean_customize_options('options'),
				'googleFonts' => oceanwp_google_fonts_array()
			)
		);
	}

}

return new OceanWP_Customizer_Init();
