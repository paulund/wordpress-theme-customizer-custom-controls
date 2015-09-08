<?php

/**
 * A class to create a dropdown for all google fonts.
 * Forked from https://github.com/paulund/wordpress-theme-customizer-custom-controls/
 */
 class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control {
	private $fonts = false;

	/**
	 * Fire the constructor up :)
	 *
	 * @param [type] $manager [description]
	 * @param [type] $id      [description]
	 * @param array  $args    [description]
	 * @param array  $options [description]
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		$this->fonts = $this->get_fonts();
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the content of the category dropdown
	 */
	public function render_content() {
		if ( ! empty( $this->fonts ) ) {
			?>
				<label>
					<span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
					<select <?php $this->link(); ?>>
						<?php
							foreach ( $this->fonts as $k => $v ) {
								printf( '<option value="%s" %s>%s</option>', esc_attr( $k ), selected( $this->value(), esc_html( $k ), false ), $v->family );
							}
						?>
					</select>
				</label>
			<?php
		}
	}

	/**
	 * Get the google fonts from the API or in the cache.
	 *
	 * @return string
	 */
	public function get_fonts() {

		// If the Google Fonts API is set, then pull data from Google, otherwise default to stored font data
		if ( defined( 'GOOGLE_FONTS_API_KEY' ) ) {

			// We cache the data from Google
			if ( false === ( $fonts = get_transient( $transient_key ) ) ) {
				$google_api = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=' . GOOGLE_FONTS_API_KEY;
				$fonts = wp_remote_get( $google_api, array( 'sslverify'   => false ) );
				set_transient( $transient_key, $fonts, HOUR_IN_SECONDS );
			}

		} else {
			$fonts['body'] = file_get_contents( 'google-web-fonts-request.txt' );
		}

		$content = json_decode( $fonts['body'] );

		return $content->items;
	}

}
