<?php

namespace Tribe\Bingo\Service_Providers;

use Pimple\{
	Container, ServiceProviderInterface
};
use Tribe\Bingo\Post_Types\Square;

class Post_Types implements ServiceProviderInterface {

	const SQUARE = 'cpt.square';

	public function register( Container $container ) {
		$container[ self::SQUARE ] = function () {
			return new Square();
		};
		add_action( 'init', function () use ( $container ) {
			$container[ self::SQUARE ]->register();
		} );
	}

}