<?php
defined( 'SLPLUS_VERSION' ) || exit;

/**
 * Store Locator Plus Admin Settings tab.
 *
 * @property-read   array $group_params
 * @property-read   string[] $map_languages        The Map Languages supported by the base plugin.
 * @property-read   string[] $option_cache
 * @property-read   string[] $update_info          A string array store user notify message
 *
 * @property-read   SLP_Settings $Settings
 */
class SLP_Admin_Settings extends SLP_Object_With_Objects {
	private $group_params = array();
	private $map_languages = array();
	private $update_info = array();

	protected $objects = array(
		'Settings' => array( 'auto_instantiate' => true, 'subdir' => 'include/module/settings/' ),
	);

	/**
	 * Setup the group params at startup.
	 */
	function initialize() {
		parent::initialize();
		SLP_Admin_Settings_Text::get_instance( true );
		$this->group_params = array( 'plugin' => $this->slplus, 'section_slug' => null, 'group_slug' => null );
	}

	/**
	 * Map
	 */
	function add_map() {
		$slug                               = 'map';
		$this->group_params['section_slug'] = $slug;
		$this->Settings->add_section( $slug );

		$this->add_map_functionality();

		/**
		 * ACTION: slp_ux_modify_adminpanel_map
		 *
		 * @param SLP_Settings $settings
		 * @param string $section_name
		 * @param array $section_params ['name'] = string of name, ['slug'] = string of unique slug
		 */
		do_action( 'slp_ux_modify_adminpanel_map', $this->Settings, $this->Settings->get_section( $slug )->name, $this->Settings->get_section( $slug )->get_params() );
	}

	/**
	 * Map / Functionality
	 */
	private function add_map_functionality() {
		$this->group_params['group_slug'] = 'functionality';

		// Language Selection
		//
		$selections = array();
		$this->set_map_languages();
		foreach ( $this->map_languages as $label => $value ) {
			$selections[] = array( 'label' => $label, 'value' => $value );
		}
		$this->Settings->add_ItemToGroup( array(
			'group_params' => $this->group_params,
			'option_name'  => 'options_nojs',
			'option'       => 'map_language',
			'type'         => 'dropdown',
			'label'        => __( 'Map Language', 'store-locator-le' ),
			'description'  =>
				__( 'Select the language to be used when sending and receiving data from the Google Maps API.', 'store-locator-le' ),
			'custom'       => $selections,

		) );
	}

	/**
	 * Results
	 */
	function add_results() {
		$slug                               = 'results';
		$this->group_params['section_slug'] = $slug;
		$this->Settings->add_section( $slug );

		/**
		 * ACTION: slp_ux_modify_adminpanel_results
		 *
		 * @param SLP_Settings $settings
		 * @param string $section_name
		 * @param array $section_params ['name'] = string of name, ['slug'] = string of unique slug
		 */
		do_action( 'slp_ux_modify_adminpanel_results', $this->Settings, $this->Settings->get_section( $slug )->name, $this->Settings->get_section( $slug )->get_params() );

	}

	/**
	 * Search
	 */
	function add_search() {
		$slug                               = 'search';
		$this->group_params['section_slug'] = $slug;
		$this->Settings->add_section( $slug );

		$this->add_search_functionality();
		$this->add_search_appearance();

		/**
		 * FILTER: slp_ux_modify_adminpanel_search
		 *
		 * Add items to the Experience / Search admin tab.
		 *
		 * The section name is 'Search'
		 * The group names in the base plugin are:
		 *     'Search Features'
		 *     'Search Labels'
		 */
		do_action( 'slp_ux_modify_adminpanel_search', $this->Settings, $this->Settings->get_section( $slug )->name, $this->Settings->get_section( $slug )->get_params() );
	}

	/**
	 * Search / Appearance
	 */
	private function add_search_appearance() {
		$this->group_params['group_slug'] = 'appearance';
		$this->Settings->add_group( $this->group_params );
	}

	/**
	 * Search / Functionality
	 */
	private function add_search_functionality() {
		$this->group_params['group_slug'] = 'functionality';

		/**
		 * FILTER: slp_radius_behavior_description
		 *
		 * Extend the admin panel radius behavior description text.
		 *
		 * @param string $radius_behavior_description gets the current string, extend it.
		 *
		 * @return string
		 */
		$radius_behavior_description = __( 'Always Use - show locations within the selected radius.<br/>', 'store-locator-le' );
		$radius_behavior_description = apply_filters( 'slp_radius_behavior_description', $radius_behavior_description );
		$radius_behavior_description .= $this->slplus->Text->get_web_link( 'docs_for_radius_behavior' );

		/**
		 * FILTER: slp_radius_behavior_selections
		 *
		 * Extend the admin panel radius behavior selections.
		 *
		 * @param array $selections as array ( array( 'label' => __( 'text', 'textdomain') , 'value' => 'slug' ) )
		 *
		 * @return array
		 */
		$radius_behavior_selections = array(
			array(
				'label' => __( 'Always Use', 'store-locator-le' ),
				'value' => 'always_use',
			),
		);
		$radius_behavior_selections = apply_filters( 'slp_radius_behavior_selections', $radius_behavior_selections );

		$this->Settings->add_ItemToGroup( array(
			'group_params' => $this->group_params,
			'label'        => $this->slplus->Text->get_text_string( array( 'label', 'radius_behavior' ) ),
			'description'  => __( 'How should the radius be handled on the location search.<br/>', 'store-locator-le' ) . $radius_behavior_description,
			'option_name'  => 'options_nojs',
			'option'       => 'radius_behavior',
			'type'         => 'dropdown',
			'custom'       => $radius_behavior_selections,
		) );

	}

	/**
	 * Tools
	 */
	public function add_tools() {
		$slug                               = 'tools';
		$this->group_params['section_slug'] = $slug;
		$this->Settings->add_section( $slug );
		$this->group_params['group_slug'] = 'functionality';

		$this->Settings->add_ItemToGroup( array(
				'group_params' => $this->group_params,
				'type'         => 'hyperbutton',
				'button_label' => __( 'Export Settings', 'store-locator-le' ),
				'id'           => 'export_settings'
			)
		);

		$this->Settings->add_ItemToGroup( array(
			'group_params' => $this->group_params,
			'type'         => 'file',
			'id'           => 'settings_file',
			'name'         => 'async-upload',
			'button_text'  => __( 'Import Settings From JSON File', 'store-locator-le' ),
			'attributes'   => array(
				'accept' => 'accept=".json"'
			)
		) );
	}


	/**
	 * View
	 */
	public function add_view() {
		$slug                               = 'view';
		$this->group_params['section_slug'] = $slug;
		$this->Settings->add_section( $slug );

		$style = SLP_Style::get_instance( true );

		// Add Style Details Divs
		//
		$this->group_params['group_slug'] = 'appearance';
		$this->Settings->add_ItemToGroup( array(
			'group_params' => $this->group_params,
			'label'        => '',
			'description'  => '',
			'setting'      => 'themedesc',
			'type'         => 'subheader',
		) );
	}

	/**
	 * Render the map settings admin page.
	 */
	function display() {
		$site_url = get_site_url();
		if ( ! ( strpos( $this->slplus->SmartOptions->map_home_icon, 'http' ) === 0 ) ) {
			$this->slplus->SmartOptions->map_home_icon->value = $site_url . $this->slplus->SmartOptions->map_home_icon;
		}
		if ( ! ( strpos( $this->slplus->SmartOptions->map_end_icon, 'http' ) === 0 ) ) {
			$this->slplus->SmartOptions->map_end_icon->value = $site_url . $this->slplus->SmartOptions->map_end_icon;
		}
		if ( ! SLP_Admin_Helper::get_instance()->webItemExists( $this->slplus->SmartOptions->map_home_icon ) ) {
			$this->slplus->notifications->add_notice(
				'warning',
				sprintf(
					__( 'Your home marker %s cannot be located or is hiding behind an extra layer of security.', 'store-locator-le' ),
					$this->slplus->SmartOptions->map_home_icon
				)
			);
		}
		if ( ! SLP_Admin_Helper::get_instance()->webItemExists( $this->slplus->SmartOptions->map_end_icon ) ) {
			$this->slplus->notifications->add_notice(
				'warning',
				sprintf(
					__( 'Your destination marker %s cannot be located or is hiding behind an extra layer of security.', 'store-locator-le' ),
					$this->slplus->SmartOptions->map_end_icon
				)
			);
		}

		// Navbar
		$this->Settings->add_section(
			array(
				'name'        => 'Navigation',
				'div_id'      => 'navbar_wrapper',
				'description' => SLP_Admin_UI::get_instance()->create_Navbar(),
				'innerdiv'    => false,
				'is_topmenu'  => true,
				'auto'        => false,
			)
		);

		// Subtabs
		add_action( 'slp_build_map_settings_panels', array( $this, 'add_search' ), 10 );
		add_action( 'slp_build_map_settings_panels', array( $this, 'add_map' ), 20 );
		add_action( 'slp_build_map_settings_panels', array( $this, 'add_results' ), 30 );
		add_action( 'slp_build_map_settings_panels', array( $this, 'add_view' ), 40 );
		add_action( 'slp_build_map_settings_panels', array( $this, 'add_tools' ), 50 );

		// Render
		if ( count( $this->update_info ) > 0 ) {
			$update_msg = "<div class='highlight'>" . __( 'Successful Update', 'store-locator-le' );
			foreach ( $this->update_info as $info_msg ) {
				$update_msg .= '<br/>' . $info_msg;
			}
			$update_msg        .= '</div>';
			$this->update_info = array();
			print wp_kses_post( $update_msg );
		}
		do_action( 'slp_build_map_settings_panels', $this->Settings );
		$this->Settings->render_settings_page();
	}

	/**
	 * Save or update custom CSS
	 *
	 * Called when "Save Settings" button is clicked
	 *
	 */
	private function save_custom_css() {
		if ( ! is_dir( SLPLUS_UPLOADDIR . 'css/' ) ) {
			wp_mkdir_p( SLPLUS_UPLOADDIR . 'css/' );
		}
		$css_file = $this->slplus->SmartOptions->theme->value . '.css';
		SLP_Admin_Activation::get_instance()->copy_newer_files( SLPLUS_PLUGINDIR . "css/$css_file", SLPLUS_UPLOADDIR . "css/$css_file" );
	}

	/**
	 * Save the options to the WP database options table.
	 */
	function save_options() {
		if ( empty( $_REQUEST ) ) {
			return;
		}
		if ( empty( $_REQUEST['security'] ) ) {
			return;
		}
		if ( ! check_ajax_referer( 'slp_ajax', 'security', false ) ) {
			return;
		}

		// -- Existing option values we want to inspect later...
		$starting_theme = $this->slplus->SmartOptions->theme->value;

		if ( isset( $_POST['options_nojs'] ) ) {

			// Set height unit to blank, if height is "auto !important"
			if ( isset( $_POST['options_nojs']['map_height'] ) &&
			     isset( $_POST['options_nojs']['map_height_units'] ) &&
			     ( strpos( sanitize_key( $_POST['options_nojs']['map_height'] ), 'auto' ) !== false ) &&
			     ( wp_kses_post( wp_unslash( $_POST['options_nojs']['map_height_units'] ) ) !== ' ' )
			) {
				$_REQUEST['map_height_units'] = ' ';
				$this->update_info[]          = __( "Auto set height unit to blank when height is 'auto'", 'store-locator-le' );
			}

			// Set weight unit to blank, if height is "auto !important"
			if ( isset( $_POST['options_nojs']['map_width'] ) &&
			     isset( $_POST['options_nojs']['map_width_units'] ) &&
			     ( strpos( sanitize_key( $_POST['options_nojs']['map_width'] ), 'auto' ) !== false ) &&
			     ( wp_kses_post( wp_unslash( $_POST['options_nojs']['map_width_units'] ) ) !== ' ' )
			) {
				$_REQUEST['map_width_units'] = ' ';
				$this->update_info[]         = __( "Auto set width unit to blank when width is 'auto'", 'store-locator-le' );
			}

			// Height, strip non-digits, if % set range 0..100
			if ( isset( $_POST['options_nojs']['map_height_units'] ) &&
			     in_array( wp_unslash( $_POST['options_nojs']['map_height_units'] ), array( '%', 'px', 'pt', 'em' ) )
			) {
				$_POST['options_nojs']['map_height'] = intval( $_POST['options_nojs']['map_height'] );
				if ( $_POST['options_nojs']['map_height_units'] === '%' ) {
					$_REQUEST['map_height'] = max( 0, min( intval( $_POST['options_nojs']['map_height'] ), 100 ) );
				}
			}


			// Width, strip non-digits, if % set range 0..100
			if ( isset( $_POST['options_nojs']['map_width_units'] ) &&
			     in_array( wp_unslash( $_POST['options_nojs']['map_width_units'] ), array( '%', 'px', 'pt', 'em' ) )
			) {
				$_POST['options_nojs']['map_width'] = intval( $_POST['options_nojs']['map_width'] );
				if ( $_POST['options_nojs']['map_width_units'] === '%' ) {
					$_REQUEST['map_width'] = max( 0, min( intval( $_POST['options_nojs']['map_width'] ), 100 ) );
				}
			}
		}

		$this->slplus->SmartOptions->set_checkboxes( $this->Settings->current_admin_page );

		// Serialized Options Setting for stuff going into slp.js.
		// This should be used for ALL new JavaScript options.
		//

		// NOTE: WordPress will have called addslashes() on all $_REQUEST entries by now with wp_magic_quotes
		//
		// $_REQUEST walk 1 for options
		// phpcs:ignore no need to sanitize this, set_valid_option downstream from set_valid_options does that
		// phpcs:ignore
		array_walk( $_REQUEST, array( $this->slplus->SmartOptions, 'set_valid_options' ) );

		// $_REQUEST walk 2 on just the ['options'] sub-array
		if ( isset( $_REQUEST['options'] ) ) {
			// phpcs:ignore no need to sanitize this, set_valid_option downstream from set_valid_options does that
			// phpcs:ignore
			array_walk( $_REQUEST['options'], array( $this->slplus->SmartOptions, 'set_valid_options' ) );
		}

		// Save Map Domain and Center Map At Settings
		if ( isset( $_POST['options_nojs']['default_country'] ) ) {
			$selected_country                    = SLP_Country_Manager::get_instance()->countries[ sanitize_key( wp_unslash( $_POST['options_nojs']['default_country'] ) ) ];
			$this->slplus->options['map_domain'] = $selected_country->google_domain;
		}

		// Serialized Options Setting for stuff NOT going to slp.js.
		// This should be used for ALL new options not going to slp.js.
		//

		// $_REQUEST walk 3 on $_REQUEST for optionsNoJS
		// phpcs:ignore no need to sanitize this, set_valid_option downstream from set_ValidOptionsNoJS does that
		// phpcs:ignore
		array_walk( $_REQUEST, array( $this->slplus, 'set_ValidOptionsNoJS' ) );
		$ending_theme = $this->slplus->SmartOptions->theme->value;

		// $_REQUEST walk 4 on just the ['options_nojs'] sub-array
		if ( isset( $_REQUEST['options_nojs'] ) ) {
			// phpcs:ignore no need to sanitize this, set_valid_option downstream from set_ValidOptionsNoJS does that
			// phpcs:ignore
			array_walk( $_REQUEST['options_nojs'], array( $this->slplus, 'set_ValidOptionsNoJS' ) );
		}


		$this->slplus->SmartOptions->execute_change_callbacks();       // Anything changed?  Execute their callbacks.
		$this->slplus->WPOption_Manager->update_wp_option( 'js' );        // Change callbacks may interact with JS or NOJS, make sure both are saved after ALL callbacks
		$this->slplus->WPOption_Manager->update_wp_option( 'nojs' );

		// Save or Update a copy of the css file to the uploads\slp\css dir
		// this is legacy support for custom theme files stored in a directory... the "Plugin Style" drop down at the top of the view page.
		if ( $starting_theme !== $ending_theme ) {
			$this->save_custom_css();
		}
	}

	/**
	 * Set our object options.
	 */
	protected function set_default_object_options() {
		$this->objects['Settings']['options'] = array(
			'name'        => __( 'Settings', 'store-locator-le' ),
			'form_action' => ( is_network_admin() ? network_admin_url() : admin_url() ) . 'admin.php?page=' . $this->slplus->clean['page'],
		);
	}

	/**
	 * Set the map languages when needed.
	 */
	private function set_map_languages() {
		if ( empty( $this->map_languages ) ) {
			$this->map_languages =
				array(
					__( 'English', 'store-locator-le' )                 => 'en',
					__( 'Arabic', 'store-locator-le' )                  => 'ar',
					__( 'Basque', 'store-locator-le' )                  => 'eu',
					__( 'Bulgarian', 'store-locator-le' )               => 'bg',
					__( 'Bengali', 'store-locator-le' )                 => 'bn',
					__( 'Catalan', 'store-locator-le' )                 => 'ca',
					__( 'Czech', 'store-locator-le' )                   => 'cs',
					__( 'Danish', 'store-locator-le' )                  => 'da',
					__( 'German', 'store-locator-le' )                  => 'de',
					__( 'Greek', 'store-locator-le' )                   => 'el',
					__( 'English (Australian)', 'store-locator-le' )    => 'en-AU',
					__( 'English (Great Britain)', 'store-locator-le' ) => 'en-GB',
					__( 'Spanish', 'store-locator-le' )                 => 'es',
					__( 'Farsi', 'store-locator-le' )                   => 'fa',
					__( 'Finnish', 'store-locator-le' )                 => 'fi',
					__( 'Filipino', 'store-locator-le' )                => 'fil',
					__( 'French', 'store-locator-le' )                  => 'fr',
					__( 'Galician', 'store-locator-le' )                => 'gl',
					__( 'Gujarati', 'store-locator-le' )                => 'gu',
					__( 'Hindi', 'store-locator-le' )                   => 'hi',
					__( 'Croatian', 'store-locator-le' )                => 'hr',
					__( 'Hungarian', 'store-locator-le' )               => 'hu',
					__( 'Indonesian', 'store-locator-le' )              => 'id',
					__( 'Italian', 'store-locator-le' )                 => 'it',
					__( 'Hebrew', 'store-locator-le' )                  => 'iw',
					__( 'Japanese', 'store-locator-le' )                => 'ja',
					__( 'Kannada', 'store-locator-le' )                 => 'kn',
					__( 'Korean', 'store-locator-le' )                  => 'ko',
					__( 'Lithuanian', 'store-locator-le' )              => 'lt',
					__( 'Latvian', 'store-locator-le' )                 => 'lv',
					__( 'Malayalam', 'store-locator-le' )               => 'ml',
					__( 'Marathi', 'store-locator-le' )                 => 'mr',
					__( 'Dutch', 'store-locator-le' )                   => 'nl',
					__( 'Norwegian', 'store-locator-le' )               => 'no',
					__( 'Polish', 'store-locator-le' )                  => 'pl',
					__( 'Portuguese', 'store-locator-le' )              => 'pt',
					__( 'Portuguese (Brazil)', 'store-locator-le' )     => 'pt-BR',
					__( 'Portuguese (Portugal)', 'store-locator-le' )   => 'pt-PT',
					__( 'Romanian', 'store-locator-le' )                => 'ro',
					__( 'Russian', 'store-locator-le' )                 => 'ru',
					__( 'Slovak', 'store-locator-le' )                  => 'sk',
					__( 'Slovenian', 'store-locator-le' )               => 'sl',
					__( 'Serbian', 'store-locator-le' )                 => 'sr',
					__( 'Swedish', 'store-locator-le' )                 => 'sv',
					__( 'Tagalog', 'store-locator-le' )                 => 'tl',
					__( 'Tamil', 'store-locator-le' )                   => 'ta',
					__( 'Telugu', 'store-locator-le' )                  => 'te',
					__( 'Thai', 'store-locator-le' )                    => 'th',
					__( 'Turkish', 'store-locator-le' )                 => 'tr',
					__( 'Ukrainian', 'store-locator-le' )               => 'uk',
					__( 'Vietnamese', 'store-locator-le' )              => 'vi',
					__( 'Chinese (Simplified)', 'store-locator-le' )    => 'zh-CN',
					__( 'Chinese (Traditional)', 'store-locator-le' )   => 'zh-TW',
				);
		}
	}
}
