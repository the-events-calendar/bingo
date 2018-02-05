<?php
/*
Plugin Name: Tribe Bingo
Description: Saves time...
Author:      Gary Kovar
Version:     1.0
Author URI:  https://tri.be
*/

require_once trailingslashit( __DIR__ ) . 'vendor/autoload.php';


// Start the core plugin
add_action( 'plugins_loaded', function () {
	tribe_bingo()->init();
}, 1, 0 );

function tribe_bingo() {
	return Tribe\Project\Core::instance( new Pimple\Container( [ 'plugin_file' => __FILE__ ]) );
}
