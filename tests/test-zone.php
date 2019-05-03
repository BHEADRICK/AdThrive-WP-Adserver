<?php
/**
 * AdThrive WP Adserver Zone Tests.
 *
 * @since   0.0.0
 * @package AdThrive_WP_Adserver
 */
class ATWPA_Zone_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'ATWPA_Zone') );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( 'ATWPA_Zone', adthrive_wp_adserver()->zone );
	}

	/**
	 * Test that our taxonomy now exists.
	 *
	 * @since  0.0.0
	 */
	function test_taxonomy_exists() {
		$this->assertTrue( taxonomy_exists( 'atwpa-zone' ) );
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
