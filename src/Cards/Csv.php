<?php

namespace Tribe\Bingo\Cards;

use League\Csv\Reader;
use League\Csv\Writer;
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

		$csv = Writer::createFromString('');

		$csv->insertOne( [
			't1','r1','i1','b1','e1',
			't2','r2','i2','b2','e2',
			't3','r3','i3','b3','e3',
			't4','r4','i4','b4','e4',
			't5','r5','i5','b5','e5',
		] );

		$card_count = 1;
		while ( $card_count <= $_POST[ Page::OPTION_NAME ][ Page::QUANTITY ] ) {
			$csv->insertOne( $this->cards->make_card() );
			$card_count ++;
		}

		$reader = Reader::createFromString($csv->getContent());
		$reader->output('bingo.csv');

	}
}