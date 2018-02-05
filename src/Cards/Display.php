<?php

namespace Tribe\Project\Cards;

use Tribe\Project\Settings\Page;

class Display {

	private $cards;

	public function __construct( $cards ) {
		$this->cards = $cards;
	}

	public function create_cards() {
		if ( ! isset( $_POST[ Page::OPTION_NAME ][ Page::QUANTITY ] ) ) {
			$this->panic();
		}

		$card_count = 1;
		$path       = dirname( __FILE__, 3 ) . '/templates/card.html';
		$file       = file_get_contents( $path );
		$cards      = '';
		while ( $card_count <= $_POST[ Page::OPTION_NAME ][ Page::QUANTITY ] ) {
			$cards .= sprintf(
				$file,
				$card_count % 2 == 0 ? 'even' : 'odd',
				$_POST[ Page::OPTION_NAME ][ Page::TITLE ],
				$_POST[ Page::OPTION_NAME ][ Page::DESCRIPTION ],
				$this->create_grid( $this->cards->make_card() ),
				$_POST[ Page::OPTION_NAME ][ Page::RULES ]
			);

			$card_count ++;
		}

		echo $this->get_header() . $cards . $this->get_footer();
	}

	private function get_header() {
		$css_url = plugins_url( 'tribe-bingo/assets/style.css' );

		return sprintf(
			'<html><head>
				<link rel="stylesheet" href="%s">
			</head><body>',
			$css_url
		);
	}

	private function get_footer() {
		return '</body>';
	}

	private function create_grid( $squares ) {
		$row  = 1;
		$card = '<TABLE>';
		$path = dirname( __FILE__, 3 ) . '/templates/row.html';
		$file = file_get_contents( $path );
		while ( $row <= 5 ) {
			$card .= vsprintf(
				$file,
				array_slice( $squares, ( $row - 1 ) * 5, 5 )
			);

			$row ++;
		}

		return $card . '</TABLE>';
	}

	private function panic() {
		wp_die( 'whoops!' );
	}

}
