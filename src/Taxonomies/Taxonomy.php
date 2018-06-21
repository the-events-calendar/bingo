<?php

namespace Tribe\Bingo\Taxonomies;

abstract class Taxonomy {

	public function register() {
		register_taxonomy( $this->taxonomy(), $this->post_types(), $this->args() );
	}

	abstract public function taxonomy(): string;

	abstract public function post_types(): array;

	abstract public function args(): array;

}