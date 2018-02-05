<?php

namespace Tribe\Project\Cards;


use Tribe\Project\Post_Types\Square;
use Tribe\Project\Settings\Page;
use Tribe\Project\Taxonomies\Difficulty;
use Tribe\Project\Taxonomies\Edition;

class Query {

	private $squares = [];

	public function make_card() {
		$this->shuffle();

		$free_space = [
			[
				'post_title' => __( 'FREE SQUARE', 'tribe' ),
			],
		];

		return array_column(
			array_merge(
				array_slice( $this->get_squares(), 0, 12 ),
				$free_space,
				array_slice( $this->get_squares(), - 12, 12 )
			),
			'post_title' );
	}

	private function get_squares() {
		if ( count( $this->squares ) ) {
			return $this->squares;
		}

		$this->query_squares();

		return $this->squares;
	}

	private function query_squares() {
		$args = [
			'post_type'      => Square::SLUG,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
		];

		if ( isset( $_POST[ Page::OPTION_NAME ][ Page::DIFFICULTY ], $_POST[ Page::OPTION_NAME ][ Page::EDITION ] ) ) {
			$args['tax_query'] = [
				'relation' => 'AND',
				$this->get_term_array( Difficulty::NAME ),
				$this->get_term_array( Edition::NAME ),
			];
		}

		$squares = new \WP_Query( $args );
		while ( count( $squares->posts ) < 24 ) {
			$squares->posts = array_merge( $squares->posts, $squares->posts );
		}
		$this->squares = $squares->posts;
		$this->shuffle();
	}

	private function get_term_array( $slug ) {
		return [
			'taxonomy' => $slug,
			'field'    => 'term_id',
			'terms'    => array_merge( $_POST[ Page::OPTION_NAME ][ Page::DIFFICULTY ], $_POST[ Page::OPTION_NAME ][ Page::EDITION ] ),
		];
	}

	private function shuffle() {
		if ( ! count( $this->squares ) ) {
			$this->get_squares();

			return;
		}
		shuffle( $this->squares );
	}

}
