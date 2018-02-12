<?php

namespace Tribe\Project\Post_Types;


class Square extends Post_Type {

	const SLUG = 'square';

	public function post_type(): string {
		return self::SLUG;
	}

	public function args(): array {
		return [
			'labels'    => [
				'name'          => __( 'Squares', 'tribe' ),
				'singular_name' => __( 'Square', 'tribe' ),
				'add_new'       => __( 'Add New', 'tribe' ),
				'add_new_item'  => __( 'Add New Sqaure', 'tribe' ),
			],
			'public'    => true,
			'supports'  => [
				'title',
			],
			'menu_icon' => 'dashicons-screenoptions',
		];
	}

}
