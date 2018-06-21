<?php

namespace Tribe\Bingo;

use Pimple\Container;
use Tribe\Bingo\Service_Providers\{
	Cards, Post_Types, Settings, Taxonomies
};

class Core {

	protected static $_instance;

	/** @var Container */
	protected $container = null;

	/** @var Service_Loader */
	protected $service_loader = null;

	/**
	 * @param Container $container
	 */
	public function __construct( $container ) {
		$this->container = $container;
	}

	public function init() {
		$this->load_service_providers();
	}

	private function load_service_providers() {
		$this->container->register( new Post_Types() );
		$this->container->register( new Settings() );
		$this->container->register( new Cards() );
		$this->container->register( new Taxonomies() );
	}

	public function container() {
		return $this->container;
	}

	/**
	 * @param null|\ArrayAccess $container
	 *
	 * @return Core
	 * @throws \Exception
	 */
	public static function instance( $container = null ) {
		if ( ! isset( self::$_instance ) ) {
			if ( empty( $container ) ) {
				throw new \Exception( 'You need to provide a Pimple container' );
			}

			$className       = __CLASS__;
			self::$_instance = new $className( $container );
		}

		return self::$_instance;
	}

}
