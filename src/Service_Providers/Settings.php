<?php

namespace Tribe\Bingo\Service_Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tribe\Bingo\Settings\Page;

class Settings implements ServiceProviderInterface {

	const PAGE = 'settings.page';

	public function register( Container $container ) {
		$container[ self::PAGE ] = function () {
			return new Page();
		};
		add_action( 'admin_menu', function () use ( $container ) {
			$container[ self::PAGE ]->add_settings_page();
		} );
		add_action( 'admin_init', function () use ( $container ) {
			$container[ self::PAGE ]->initialize_options();
		} );
	}

}