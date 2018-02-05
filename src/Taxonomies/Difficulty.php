<?php

namespace Tribe\Project\Taxonomies;

use Tribe\Project\Post_Types\Square;

class Difficulty extends Taxonomy {

	const NAME = 'bingo_difficulty';

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
				'name'          => __( 'Difficulty Levels', 'tribe' ),
				'singular_name' => __( 'Difficulty', 'tribe' ),
			],
			'public' => true,
			'show_admin_column' => true,
		];
	}

}
