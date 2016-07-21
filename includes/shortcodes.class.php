<?php

/**
 * Used on public display of the Donation form
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Donations
 * @subpackage Purecharity_Wp_Donations/includes
 */

/**
 * Used on public display of the Donation form.
 *
 * This class defines all the shortcodes necessary.
 *
 * @since      1.0.0
 * @package    Purecharity_Wp_Donations
 * @subpackage Purecharity_Wp_Donations/includes
 * @author     Pure Charity <dev@purecharity.com>
 */
class Purecharity_Wp_Donations_Shortcode {


  /**
   * The Base Plugin.
   *
   * @since    1.0.0
   * @access   public
   * @var      Object    $base_plugin    The Base Plugin.
   */
  public static $base_plugin;

  /**
   * Initialize the class and Base Plugin functionality.
   *
   * @since    1.0.0
   */
  public function __construct() {
    $this->actions = array();
    $this->filters = array();

  }

  /**
   * Initialize the shortcodes to make them available on page runtime.
   *
   * @since    1.0.0
   */
  public static function init()
  {
    if(Purecharity_Wp_Donations::base_present()){
      add_shortcode('donation', array('Purecharity_Wp_Donations_Shortcode', 'donation_shortcode'));

      self::$base_plugin = new Purecharity_Wp_Base();
    }
  }

  /**
   * Initialize the Donation Form Shortcode
   *
   * @since    1.0.1
   */
  public static function donation_shortcode($atts)
  { 
    $options = get_option( 'purecharity_donations_settings' );

    return Purecharity_Wp_Donations_Public::donation_form($options);
  }

}