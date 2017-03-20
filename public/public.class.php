<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Donations
 * @subpackage Purecharity_Wp_Donations/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Purecharity_Wp_Donations
 * @subpackage Purecharity_Wp_Donations/public
 * @author     Pure Charity <developer@purecharity.com>
 */
class Purecharity_Wp_Donations_Public {

	/**
	 * The name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The name of this plugin.
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
	 * @var      string    $plugin_name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Prints the fields
	 *
	 * @since    1.0.0
	 */
	public static function donation_form($options) {

		$html = self::print_custom_styles();
		$html .= '
			<div class="container">
				<form class="pure-donations clearfix">
	        <input class="donatefield" name="give" type="number" min="0" placeholder="$ USD" /><br/>
	        <input class="button donatesubmit" data-url="'.$options['recurring'].'" name="donaterecurring" type="submit" value="Give Recurring" />
	        <input class="button donatesubmit" data-url="'.$options['one_time'].'" name="donateonetime" type="submit" value="Give One-Time" />
	      </form>
			</div> 
		';
		return $html;
	}

	/**
	 * Prints the custom styles
	 *
	 * @since    1.0.0
	 */	
  public static function print_custom_styles(){
    $base_settings = get_option( 'pure_base_settings' );
    $pd_settings = get_option( 'purecharity_donations_settings' );

    // Default theme color
    if(@$pd_settings['plugin_color'] == NULL || @$pd_settings['plugin_color'] == ''){
      if(@$base_settings['main_color'] == NULL || @$base_settings['main_color'] == ''){
        $color = '#CA663A';
      }else{
        $color = @$base_settings['main_color'];
      }
    }else{
      $color = @$pd_settings['plugin_color'];
    }

    $html = '<style>';
    $html .= '
			.container form.pure-donations input.button { background: '.$color.' !important; }
    ';
    $html .= '</style>';

    return $html;
  }

	

}
