<?php
/**
 * AdThrive WP Adserver Frontend.
 *
 * @since   0.0.0
 * @package AdThrive_WP_Adserver
 */

/**
 * Endpoint class.
 *
 * @since   0.0.0
 * @package AdThrive_WP_Adserver
 */
if ( class_exists( 'WP_REST_Controller' ) ) {
	class ATWPA_Frontend extends WP_REST_Controller {
		/**
		 * Parent plugin class.
		 *
		 * @var   AdThrive_WP_Adserver
		 * @since 0.0.0
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
		 * Add our hooks.
		 *
		 * @since  0.0.0
		 */
		public function hooks() {
			add_action( 'rest_api_init', array( $this, 'register_routes' ) );
		}

		/**
	     * Register the routes for the objects of the controller.
	     *
	     * @since  0.0.0
	     */
		public function register_routes() {

			// Set up defaults.
			$version = '1';
			$namespace = 'adthrive-wp-adserver/v' . $version;
			$base = 'frontend';


			// Example register_rest_route calls.
			register_rest_route( $namespace, '/' . $base, array(
				array(
					'methods' => WP_REST_Server::READABLE,
					'callback' => array( $this, 'get_items' ),
					'permission_callback' => array( $this, 'get_items_permission_check' ),
					'args' => array(),
				),
			) );

			register_rest_route( $namespace, '/' . $base . '/(?P<id>[\d]+)', array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_item' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
					'args'                => array(
						'context' => array(
							'default' => 'view',
						),
					),
				),
				array(
					'methods'             => WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'update_item' ),
					'permission_callback' => array( $this, 'update_item_permissions_check' ),
					'args'                => $this->get_endpoint_args_for_item_schema( false ),
				),
				array(
					'methods'             => WP_REST_Server::DELETABLE,
					'callback'            => array( $this, 'delete_item' ),
					'permission_callback' => array( $this, 'delete_item_permissions_check' ),
					'args'                => array(
						'force' => array(
							'default' => false,
							),
						),
					),
				)
			);

			register_rest_route( $namespace, '/' . $base . '/schema', array(
				'methods'  => WP_REST_Server::READABLE,
				'callback' => array( $this, 'get_public_item_schema' ),
			) );
		}

		/**
		 * Get items.
		 *
		 * @since  0.0.0
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 */
		public function get_items( $request ) {}

		/**
		 * Permission check for getting items.
		 *
		 * @since  0.0.0
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 */
		public function get_items_permission_check( $request ) {}

		/**
		 * Get item.
		 *
		 * @since  0.0.0
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 */
		public function get_item( $request ) {
			$zone_id = $request->get_param('id');
			$ads = get_posts([
				'posts_per_page'=>1,
				'post_type'=>'atwpa-ad',
				'orderby'=>'rand',
				'tax_query'=>[
					'taxonomy'=>'atwpa-zone',
					'field'=>'term_id',
					'terms'=>$zone_id
				]
			]);

			if(count($ads) > 0){
				$ad = $ads[0];

				return [
					'title'=>$ad->post_title,
					'url'=>get_post_meta($ad->ID, '_atwpa_ad_url', true),
					'image'=>get_the_post_thumbnail_url($ad->ID)
				];

			}


		}

		/**
		 * Permission check for getting item.
		 *
		 * @since  0.0.0
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 */
		public function get_item_permissions_check( $request ) {
			return true;
		}

		/**
		 * Update item.
		 *
		 * @since  0.0.0
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 */
		public function update_item( $request ) {}

		/**
		 * Permission check for updating items.
		 *
		 * @since  0.0.0
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 */
		public function update_item_permissions_check( $request ) {}

		/**
		 * Delete item.
		 *
		 * @since  0.0.0
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 */
		public function delete_item( $request ) {}

		/**
		 * Permission check for deleting items.
		 *
		 * @since  0.0.0
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 */
		public function delete_item_permissions_check( $request ) {}

		/**
		 * Get item schema.
		 *
		 * @since  0.0.0
		 */
		public function get_public_item_schema() {}
	}
}
