<?php
/**
 * AdThrive_WP_Adserver.
 *
 * @since   0.0.0
 * @package AdThrive_WP_Adserver
 */
class AdThrive_WP_Adserver_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'AdThrive_WP_Adserver') );
	}

	/**
	 * Test that our main helper function is an instance of our class.
	 *
	 * @since  0.0.0
	 */
	function test_get_instance() {
		$this->assertInstanceOf(  'AdThrive_WP_Adserver', adthrive_wp_adserver() );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  0.0.0
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
