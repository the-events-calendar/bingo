<?php

namespace Tribe\Project\Service_Providers;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tribe\Project\Cards\Display;
use Tribe\Project\Cards\Query;
use Tribe\Project\Settings\Page;

class Cards implements ServiceProviderInterface {

	const DISPLAY = 'cards.display';
	const CARDS   = 'cards.query';

	public function register( Container $container ) {
		$container[ self::CARDS ]   = function () use ( $container ) {
			return new Query();
		};
		$container[ self::DISPLAY ] = function () use ( $container ) {
			return new Display( $container[ self::CARDS ] );
		};
		add_action( 'admin_post_' . Page::ACTION, function () use ( $container ) {
			$container[ self::DISPLAY ]->create_cards();
		} );
	}

}