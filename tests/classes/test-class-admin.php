<?php

namespace Custom_Block_Pattern_Builder\Admin\Tests;

use Custom_Block_Pattern_Builder\Admin;
use Custom_Block_Pattern_Builder\Util;

/**
 * Test suites for Admin class.
 *
 * @coversDefaultClass \Custom_Block_Pattern_Builder\Admin
 */
class Test_Admin extends \WP_Mock\Tools\TestCase {

	/**
	 * Test constructor method.
	 *
	 * @covers ::__construct
	 * @covers ::_setup_hooks
	 *
	 * @return void
	 */
	public function test_setup_hooks() {
		$instance = new Admin();
		$util = new Util();
		\WP_Mock::expectActionAdded( 'init', [ $instance, 'block_pattern_builder_init_hook' ], 10, 2 );
		$util->get_protected_method( $instance, '_setup_hooks', [] );
	}
}
