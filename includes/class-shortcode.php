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
		add_shortcode('which ', [$this, 'shortcode']);
		add_action('wp_enqueue_scripts', [$this, 'scripts']);
	}

	public function scripts(){
		wp_register_script(get_class($this->plugin). '_ad_script', $this->plugin->url . 'assets/js/ads.js', ['jquery'], null, true );
		$settings = [

			'root' => esc_url_raw( rest_url('adthrive-wp-adserver/v1') ),
			'nonce' => wp_create_nonce( 'wp_rest' )

		];
		wp_localize_script(get_class($this->plugin). '_ad_script', get_class($this->plugin), $settings);
	}
	public function shortcode($atts){
		wp_enqueue_script(get_class($this->plugin). '_ad_script');
		if(isset($atts['zone'])){

			if(is_numeric($atts['zone'])){
				$zone_id = $atts['zone'];
			}else{
				$zone = get_term_by('slug', $atts['zone'], 'atwpa-zone');

				$zone_id = $zone->term_id;
			}

			return "<div class='adthrive-ad' data-zone-id='$zone_id'></div>";
		}

	}
}
