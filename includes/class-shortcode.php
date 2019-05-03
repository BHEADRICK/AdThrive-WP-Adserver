<?php
/**
 * AdThrive WP Adserver Shortcode.
 *
 * @since   0.0.0
 * @package AdThrive_WP_Adserver
 */

/**
 * AdThrive WP Adserver Shortcode.
 *
 * @since 0.0.0
 */
class ATWPA_Shortcode {
	/**
	 * Parent plugin class.
	 *
	 * @since 0.0.0
	 *
	 * @var   AdThrive_WP_Adserver
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  0.0.0
	 *
	 * @param  AdThrive_WP_Adserver $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.0.0
	 */
	public function hooks() {

	}
}
