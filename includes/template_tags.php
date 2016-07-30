<?php 
/**
 * Template tags for donations
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Donations
 * @subpackage Purecharity_Wp_Donations/includes
 */

function pc_donation($options = array()){
	return Purecharity_Wp_Donations_Public::donation_form($options);
}