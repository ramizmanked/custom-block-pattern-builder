<?php
/**
 * Plugin Name:       Custom Block Pattern Builder
 * Description:       Simply allow you to create and register Custom Block Patterns right from WordPress Admin.
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Version:           1.0.0
 * Author:            Ramiz Manked
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       custom-block-pattern-builder
 * Domain Path:       /languages
 *
 * @package custom-block-pattern-builder
 */

const BLOCK_PATTERN_BUILDER_VERSION = '1.0.0';
const BLOCK_PATTERN_BUILDER_DIR     = __DIR__;

require_once BLOCK_PATTERN_BUILDER_DIR . '/classes/class-admin.php';

new Custom_Block_Pattern_Builder\Admin();
