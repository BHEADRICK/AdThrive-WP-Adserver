<?php
/**
 * AdThrive WP Adserver Ad.
 *
 * @since   0.0.0
 * @package AdThrive_WP_Adserver
 */

require_once dirname( __FILE__ ) . '/../vendor/cpt-core/CPT_Core.php';

/**
 * AdThrive WP Adserver Ad post type class.
 *
 * @since 0.0.0
 *
 * @see   https://github.com/WebDevStudios/CPT_Core
 */
class ATWPA_Ad extends CPT_Core {
	/**
	 * Parent plugin class.
	 *
	 * @var AdThrive_WP_Adserver
	 * @since  0.0.0
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * Register Custom Post Types.
	 *
	 * See documentation in CPT_Core, and in wp-includes/post.php.
	 *
	 * @since  0.0.0
	 *
	 * @param  AdThrive_WP_Adserver $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		// Register this cpt.
		// First parameter should be an array with Singular, Plural, and Registered name.
		parent::__construct(
			array(
				esc_html__( 'AdThrive WP Adserver Ad', $this->plugin->slug ),
				esc_html__( 'AdThrive WP Adserver Ads', $this->plugin->slug ),
				'atwpa-ad',
			),
			array(
				'supports' => array(
					'title',

					'thumbnail',
				),
				'menu_icon' => 'dashicons-admin-post', // https://developer.wordpress.org/resource/dashicons/
				'public'    => true,
			)
		);
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.0.0
	 */
	public function hooks() {
		add_action('add_meta_boxes', [$this, 'add_meta_box']);
		add_action('save_post_atwpa-ad', [$this, 'save_post']);
	}

	function save_post($post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! isset( $_POST['ad_url_nonce'] ) || ! wp_verify_nonce( $_POST['ad_url_nonce'], '_ad_url_nonce' ) ) return;
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;

		if ( isset( $_POST['atwpa_ad_url'] ) )
			update_post_meta( $post_id, '_atwpa_ad_url', esc_attr( $_POST['atwpa_ad_url'] ) );
	}

	function add_meta_box(){
		add_meta_box(
			'ad_url-ad-url',
			__( 'AD Url', 'ad_url' ),
			[$this, 'field_html'],
			'atwpa-ad',
			'normal',
			'default'
		);
	}

	function field_html($post){
		wp_nonce_field( '_ad_url_nonce', 'ad_url_nonce' ); ?>

		<p>
		<label for="ad_url_ad_url"><?php _e( 'Ad URL', $this->plugin->slug ); ?></label><br>
		<input type="text" name="atwpa_ad_url" id="ad_url_ad_url" value="<?php echo get_post_meta($post->ID, '_atwpa_ad_url', true); ?>">
		</p><?php
	}


	/**
	 * Registers admin columns to display. Hooked in via CPT_Core.
	 *
	 * @since  0.0.0
	 *
	 * @param  array $columns Array of registered column names/labels.
	 * @return array          Modified array.
	 */
	public function columns( $columns ) {
		$new_column = array();
		return array_merge( $new_column, $columns );
	}

	/**
	 * Handles admin column display. Hooked in via CPT_Core.
	 *
	 * @since  0.0.0
	 *
	 * @param array   $column   Column currently being rendered.
	 * @param integer $post_id  ID of post to display column for.
	 */
	public function columns_display( $column, $post_id ) {
		switch ( $column ) {
		}
	}
}
