<?php

namespace Tribe\Bingo\Service_Providers;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tribe\Bingo\Cards\Csv;
use Tribe\Bingo\Cards\Display;
use Tribe\Bingo\Cards\Query;
use Tribe\Bingo\Settings\Page;

class Cards implements ServiceProviderInterface {

	const DISPLAY = 'cards.display';
	const CSV     = 'cards.csv';
	const CARDS   = 'cards.query';

	public function register( Container $container ) {
		$container[ self::CARDS ]   = function () use ( $container ) {
			return new Query();
		};
		$container[ self::DISPLAY ] = function () use ( $container ) {
			return new Display( $container[ self::CARDS ] );
		};
		$container[ self::CSV ] = function () use ( $container ) {
			return new Csv( $container[ self::CARDS ] );
		};
		add_action( 'admin_post_' . Page::ACTION, function () use ( $container ) {
			$container[ self::CSV ]->create_cards();
		} );
	}

}