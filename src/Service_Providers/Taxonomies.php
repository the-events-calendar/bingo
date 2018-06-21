<?php

namespace Tribe\Bingo\Service_Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tribe\Bingo\Taxonomies\{
	Difficulty, Edition
};

class Taxonomies implements ServiceProviderInterface {

	const DIFFICULTY = 'taxonomy.difficulty';
	const EDITION    = 'taxonomy.edition';

	public function register( Container $container ) {
		$container[ self::DIFFICULTY ] = function () {
			return new Difficulty();
		};
		$container[ self::EDITION ]    = function () {
			return new Edition();
		};

		add_action( 'init', function () use ( $container ) {
			$container[ self::EDITION ]->register();
			$container[ self::DIFFICULTY ]->register();
		} );
	}

}