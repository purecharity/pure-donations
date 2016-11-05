<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Donations
 * @subpackage Purecharity_Wp_Donations/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Purecharity_Wp_Donations
 * @subpackage Purecharity_Wp_Donations/admin
 * @author     Pure Charity <developer@purecharity.com>
 */
class Purecharity_Wp_Donations_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	
	/**
	 * Add the Plugin Settings Menu.
	 *
	 * @since    1.0.0
	 */
	function add_admin_menu(  ) { 
		add_options_page( 'PureCharity&#8482; Donations Settings', 'PureCharity&#8482; Donations', 'manage_options', 'purecharity_donations', array('Purecharity_Wp_Donations_Admin', 'options_page') );
	}

	/**
	 * Checks for the existence of the donations plugin settings.
	 *
	 * @since    1.0.0
	 */
	public static function settings_exist(  ) { 
		if( false == get_option( 'purecharity_donations_settings' ) ) { 
			add_option( 'purecharity_donations_settings' );
		}
	}

	/**
	 * Initializes the settings page options.
	 *
	 * @since    1.0.0
	 */
	public static function settings_init() {
		register_setting( 'pdPluginPage', 'purecharity_donations_settings' );

		add_settings_section(
			'purecharity_donations_pdPluginPage_section', 
			__( 'General settings', 'wordpress' ), 
			array('Purecharity_Wp_Donations_Admin', 'settings_section_callback'),
			'pdPluginPage'
		);


		add_settings_field( 
			'plugin_color', 
			__( 'Main Theme Color', 'wordpress' ), 
			array('Purecharity_Wp_Donations_Admin', 'main_color_render'), 
			'pdPluginPage',
			'purecharity_donations_pdPluginPage_section' 
		);

		add_settings_field( 
			'one_time', 
			__( 'One Time Link', 'wordpress' ), 
			array('Purecharity_Wp_Donations_Admin', 'one_time_render'), 
			'pdPluginPage', 
			'purecharity_donations_pdPluginPage_section' 
		);

		add_settings_field( 
			'recurring', 
			__( 'Recurring Link', 'wordpress' ), 
			array('Purecharity_Wp_Donations_Admin', 'recurring_render'), 
			'pdPluginPage', 
			'purecharity_donations_pdPluginPage_section' 
		);
	}

	/**
	 * Renders the main theme color picker.
	 *
	 * @since    1.0.0
	 */
	public static function main_color_render(  ) { 

		$options = get_option( 'purecharity_donations_settings' );
		?>
		<input type="text" name="purecharity_donations_settings[plugin_color]" id="main_color" value="<?php echo @$options['plugin_color']; ?>">

	<?php

	}

	/**
	 * Renders the one-time link option.
	 *
	 * @since    1.0.0
	 */
	public static function one_time_render(  ) { 

		$options = get_option( 'purecharity_donations_settings' );
		?>
		<input type="text" name="purecharity_donations_settings[one_time]" id="one_time" value="<?php echo @$options['one_time']; ?>">

	<?php

	}

	/**
	 * Renders the one-time link option.
	 *
	 * @since    1.0.0
	 */
	public static function recurring_render(  ) { 

		$options = get_option( 'purecharity_donations_settings' );
		?>
		<input type="text" name="purecharity_donations_settings[recurring]" id="recurring" value="<?php echo @$options['recurring']; ?>">

	<?php

	}

	/**
	 * Callback for use with Settings API.
	 *
	 * @since    1.0.0
	 */
	public static function settings_section_callback(  ) 
	{ 
		echo __( 'General settings for the Pure Charity Donations plugin.', 'wordpress' );
	}

	/**
	 * Callback for use with Settings API.
	 *
	 * @since    1.0.0
	 */
	public static function display_settings_section_callback(  ) 
	{ 
		echo __( 'Display settings for the Pure Charity Donations plugin.', 'wordpress' );
	}
	
	/**
	 * Creates the options page.
	 *
	 * @since    1.0.0
	 */
	public static function options_page()
	{
    ?>
    <div class="wrap">
      <form action="options.php" method="post" class="pure-settings-form">
				<?php
					echo '<img align="left" src="' . plugins_url( get_option( 'pure_base_name' ) . '/public/img/purecharity.png' ) . '" > ';
				?>
				<h2 style="padding-left:100px;padding-top: 20px;padding-bottom: 50px;border-bottom: 1px solid #ccc;">PureCharity&#8482; Donations Settings</h2>
				
				<?php
				settings_fields( 'pdPluginPage' );
				do_settings_sections( 'pdPluginPage' );
				submit_button();
				?>
				
			</form>
    </div>
    <?php
	}


	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );
	}

}
