<?php

namespace Tribe\Project\Post_Types;

abstract class Post_Type {

	public function register() {
		register_post_type( $this->post_type(), $this->args() );
	}

	abstract public function post_type(): string;

	abstract public function args(): array;

}