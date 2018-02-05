<?php

namespace Tribe\Project\Taxonomies;

use Tribe\Project\Post_Types\Square;

class Edition extends Taxonomy {

	const NAME = 'edition';

	const POST_TYPES = [
		Square::SLUG,
	];

	public function taxonomy(): string {
		return self::NAME;
	}

	public function post_types(): array {
		return self::POST_TYPES;
	}

	public function args(): array {
		return [
			'labels' => [
				'name'          => __( 'Editions', 'tribe' ),
				'singular_name' => __( 'Edition', 'tribe' ),
			],
			'show_admin_column' => true,
		];
	}

}
