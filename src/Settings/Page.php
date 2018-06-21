<?php

namespace Tribe\Project\Settings;

use Tribe\Project\Taxonomies\Difficulty;
use Tribe\Project\Taxonomies\Edition;

class Page {

	const SLUG        = 'tribe-bingo';
	const SECTION     = 'tribe-bingo-option-group-section';
	const OPTION_NAME = 'tribe-bingo-option';
	const GROUP_NAME  = 'tribe-bingo-option-group';
	const ACTION      = 'tribe_bingo_cards';
	const TITLE       = 'bingo-title';
	const FREE        = 'bingo-free-square';
	const QUANTITY    = 'bingo-quantity';
	const DESCRIPTION = 'bingo-description';
	const RULES       = 'bingo-rules';
	const DIFFICULTY  = 'bingo-difficulty';
	const EDITION     = 'bingo-edition';

	private $options;

	public function add_settings_page() {
		add_menu_page(
			__( 'Tribe Bingo', 's8' ),
			__( 'Tribe Bingo', 's8' ),
			'manage_options',
			self::SLUG,
			[ $this, 'display_settings_page' ],
			'dashicons-grid-view'
		);
	}

	public function initialize_options() {
		register_setting(
			self::GROUP_NAME,
			self::OPTION_NAME,
			[ $this, 'sanitize' ]
		);

		add_settings_section(
			self::SECTION,
			__( 'Generate Bingo Cards!', 'tribe' ),
			[ $this, 'print_section_info' ],
			self::SLUG
		);

//		add_settings_field(
//			self::TITLE,
//			__( 'Title', 'tribe' ),
//			[ $this, 'title_callback' ],
//			self::SLUG,
//			self::SECTION
//		);
//
//		add_settings_field(
//			self::FREE,
//			__( 'Free Square Text', 'tribe' ),
//			[ $this, 'free_callback' ],
//			self::SLUG,
//			self::SECTION
//		);
//
//		add_settings_field(
//			self::DESCRIPTION,
//			__( 'Description', 'tribe' ),
//			[ $this, 'description_callback' ],
//			self::SLUG,
//			self::SECTION
//		);
//
//		add_settings_field(
//			self::RULES,
//			__( 'Rules', 'tribe' ),
//			[ $this, 'rules_callback' ],
//			self::SLUG,
//			self::SECTION
//		);

		add_settings_field(
			self::QUANTITY,
			__( 'Quantity', 'tribe' ),
			[ $this, 'quantity_callback' ],
			self::SLUG,
			self::SECTION
		);

		add_settings_field(
			self::DIFFICULTY,
			__( 'Difficulty', 'tribe' ),
			[ $this, 'difficulty_callback' ],
			self::SLUG,
			self::SECTION
		);

		add_settings_field(
			self::EDITION,
			__( 'Edition', 'tribe' ),
			[ $this, 'edition_callback' ],
			self::SLUG,
			self::SECTION
		);

	}

	public function title_callback() {
		printf(
			'<input type="text" id="%s" name="%s[%s]" value="%s" />',
			self::TITLE,
			self::OPTION_NAME,
			self::TITLE,
			isset( $this->options[ self::TITLE ] ) ? esc_attr( $this->options[ self::TITLE ] ) : ''
		);
	}

	public function free_callback() {
		printf(
			'<input type="text" id="%s" name="%s[%s]" value="%s" />',
			self::FREE,
			self::OPTION_NAME,
			self::FREE,
			isset( $this->options[ self::FREE ] ) ? esc_attr( $this->options[ self::FREE ] ) : ''
		);
	}

	public function description_callback() {
		printf(
			'<input type="text" id="%s" name="%s[%s]" value="%s" />',
			self::DESCRIPTION,
			self::OPTION_NAME,
			self::DESCRIPTION,
			isset( $this->options[ self::DESCRIPTION ] ) ? esc_attr( $this->options[ self::DESCRIPTION ] ) : ''
		);
	}

	public function rules_callback() {
		printf(
			'<input type="text" id="%s" name="%s[%s]" value="%s" />',
			self::RULES,
			self::OPTION_NAME,
			self::RULES,
			isset( $this->options[ self::RULES ] ) ? esc_attr( $this->options[ self::RULES ] ) : ''
		);
	}

	public function quantity_callback() {
		printf(
			'<input type="text" id="%s" name="%s[%s]" value="%s" />',
			self::QUANTITY,
			self::OPTION_NAME,
			self::QUANTITY,
			isset( $this->options[ self::QUANTITY ] ) ? esc_attr( $this->options[ self::QUANTITY ] ) : ''
		);
	}

	private function get_terms( $taxonomy ) {
		return wp_list_pluck( get_terms( [
			'taxonomy'   => $taxonomy,
			'hide_empty' => true,
		] ), 'name', 'term_id' );
	}

	public function difficulty_callback() {
		$checkboxes = '';

		foreach ( $this->get_terms( Difficulty::NAME ) as $id => $term ) {
			$checkboxes .= sprintf( '<input type="checkbox" name="%s[%s][]" value="%s" checked>%s<BR />',
				self::OPTION_NAME,
				self::DIFFICULTY,
				$id,
				$term
			);
		}

		echo $checkboxes;
	}

	public function edition_callback() {
		$checkboxes = '';

		foreach ( $this->get_terms( Edition::NAME ) as $id => $term ) {
			$checkboxes .= sprintf( '<input type="checkbox" name="%s[%s][]" value="%s" checked>%s<BR />',
				self::OPTION_NAME,
				self::EDITION,
				$id,
				$term
			);
		}

		echo $checkboxes;
	}

	public function print_section_info() {
	}

	public function display_settings_page() {
		$this->options = get_option( self::OPTION_NAME );
		?>
		<div class="wrap">
			<h1>Bingo</h1>
			<form method="post" action="/wp-admin/admin-post.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields( self::GROUP_NAME );
				do_settings_sections( self::SLUG );
				submit_button( 'Bingo!' );
				?>
				<input type="hidden" name="action" value="<?php echo self::ACTION; ?>">
			</form>
		</div>
		<?php
	}
}
