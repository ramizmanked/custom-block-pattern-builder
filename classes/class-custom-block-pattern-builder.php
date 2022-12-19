<?php
/**
 * Class file for Block Pattern Builder.
 *
 * @package custom-block-pattern-builder
 */

/**
 * Class Custom_Block_Pattern_Builder
 */
class Custom_Block_Pattern_Builder {

	/**
	 * Constructor method.
	 */
	public function __construct() {
		$this->_setup_hooks();
	}

	/**
	 * Setup hooks.
	 *
	 * @return void
	 */
	protected function _setup_hooks(): void {
		add_action( 'init', [ $this, 'block_pattern_builder_init_hook' ] );
	}

	/**
	 * Registers block pattern category and registers CPT.
	 *
	 * @return void
	 */
	public function block_pattern_builder_init_hook(): void {
		// Registers category to separate custom block patterns from build-in block-patterns.
		register_block_pattern_category(
			'ramiz',
			array( 'label' => esc_html( get_bloginfo( 'name' ) ) )
		);

		// Register custom post type to store block patterns at backend.
		$this->_block_pattern_builder_register_cpt();

		// Generate and register block-patterns dynamically.
		$this->_block_pattern_builder_register_block_patterns();
	}

	/**
	 * Register CPT
	 *
	 * @return void
	 */
	protected function _block_pattern_builder_register_cpt(): void {
		$labels = [
			'name'          => __( 'Block Patterns', 'custom-block-pattern-builder' ),
			'singular_name' => __( 'Block Pattern', 'custom-block-pattern-builder' ),
		];

		$args = [
			'label'                 => __( 'Block Patterns', 'custom-block-pattern-builder' ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'has_archive'           => false,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'delete_with_user'      => false,
			'exclude_from_search'   => true,
			'capability_type'       => 'post',
			'map_meta_cap'          => true,
			'hierarchical'          => false,
			'rewrite'               => [
				'slug'       => 'custom_block_pattern-builder',
				'with_front' => true,
			],
			'query_var'             => false,
			'menu_icon'             => 'dashicons-editor-kitchensink',
			'supports'              => [ 'title', 'editor' ],
		];

		register_post_type( 'block_pattern', $args );
	}

	/**
	 * Register custom block-patterns.
	 */
	protected function _block_pattern_builder_register_block_patterns(): void {
		$patterns = new WP_Query(
			array(
				'post_type'      => 'block_pattern',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
			)
		);

		if ( $patterns->have_posts() ) {
			while ( $patterns->have_posts() ) {
				$patterns->the_post();
				global $post;

				register_block_pattern(
					sanitize_title( get_the_title() ),
					array(
						'title'      => get_the_title(),
						'categories' => array( 'ramiz' ),
						'content'    => sprintf( '%s', $post->post_content ),
					)
				);
			}
		}
		wp_reset_postdata();
	}
}
