<?php
/**
 * AdThrive WP Adserver Zone.
 *
 * @since   0.0.0
 * @package AdThrive_WP_Adserver
 */

require_once dirname( __FILE__ ) . '/../vendor/taxonomy-core/Taxonomy_Core.php';

/**
 * AdThrive WP Adserver Zone.
 *
 * @since 0.0.0
 *
 * @see   https://github.com/WebDevStudios/Taxonomy_Core
 */
class ATWPA_Zone extends Taxonomy_Core {
	/**
	 * Parent plugin class.
	 *
	 * @var    AdThrive_WP_Adserver
	 * @since  0.0.0
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * Register Taxonomy.
	 *
	 * See documentation in Taxonomy_Core, and in wp-includes/taxonomy.php.
	 *
	 * @since  0.0.0
	 *
	 * @param  AdThrive_WP_Adserver $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		parent::__construct(
			// Should be an array with Singular, Plural, and Registered name.
			array(
				__( 'AdThrive WP Adserver Zone', 'adthrive-wp-adserver' ),
				__( 'AdThrive WP Adserver Zones', 'adthrive-wp-adserver' ),
				'atwpa-zone',
			),
			// Register taxonomy arguments.
			array(
				'hierarchical' => true,
			),
			// Post types to attach to.
			array(
				'atwpa-ad',
			)
		);
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since 0.0.0
	 */
	public function hooks() {

	}
}
