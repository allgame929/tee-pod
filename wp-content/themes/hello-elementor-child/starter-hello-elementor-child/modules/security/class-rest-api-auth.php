<?php

/**
 * Api Auth
 *
 * @package BornDigital
 */

namespace BD\Security;

defined('ABSPATH') || die("Can't access directly");

use WP_Error;

/**
 * Api Auth class
 */
class Rest_API_Auth
{
	/**
	 * Setup the flow
	 */
	public function __construct()
	{
		add_action('rest_api_init', [$this, 'secure_default_endpoints']);
	}

	public function secure_default_endpoints()
	{
		$slug = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

		if (false !== stripos($slug, '/mi/') || false !== stripos($slug, '/elementor/') || false !== stripos($slug, '/elementor-pro/')) return;
		if (!is_user_logged_in() && !current_user_can('administrator')) return wp_die('Access denied!');
	}
}

new Rest_API_Auth();
