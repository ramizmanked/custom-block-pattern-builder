<?php

namespace Custom_Block_Pattern_Builder;

class Util{

	/**
	 * Get protected method of class.
	 *
	 * @param $obj
	 * @param $name
	 * @param array $args
	 *
	 * @return mixed
	 * @throws \ReflectionException
	 */
	public function get_protected_method( $obj, $name, array $args ) {
		$class  = new \ReflectionClass( $obj );
		$method = $class->getMethod( $name );
		$method->setAccessible( true );

		return $method->invokeArgs( $obj, $args );
	}
}
