<?php 
/**
 * Enqueue scripts
 *
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 */
function giantblog_scripts() {
	wp_enqueue_style( 'giantblog-css', get_template_directory_uri() . '/css/klimiss.css' );
	wp_enqueue_script( 'giantblog-js', get_template_directory_uri() . '/js/klimiss.js', array( 'jquery' ), false, false);
}

add_action( 'wp_enqueue_scripts', 'giantblog_scripts' );
