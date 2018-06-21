<?php

namespace Tribe\Bingo\Cards;

use Tribe\Bingo\Settings\Page;

class Csv {
	private $cards;

	public function __construct( $cards ) {
		$this->cards = $cards;
	}

	public function create_cards() {
		if ( ! isset( $_POST[ Page::OPTION_NAME ][ Page::QUANTITY ] ) ) {
			wp_die( 'whoops' );
		}

		$card_count = 1;
		while ( $card_count <= $_POST[ Page::OPTION_NAME ][ Page::QUANTITY ] ) {
			$this->cards->make_card();
			$card_count ++;
		}

	}
}