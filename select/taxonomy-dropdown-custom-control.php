<?php
/**
 * Customize for taxonomy with dropdown, extend the WP customizer
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
	return NULL;

class Taxonomy_Dropdown_Custom_Control extends WP_Customize_Control
{
	private $options = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->options = $options;

        parent::__construct( $manager, $id, $args );
    }

	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 *
	 * @since   11/14/2012
	 * @return  void
	 */
	public function render_content()
    {
        // call wp_dropdown_cats to get data and add to select field
        add_action( 'wp_dropdown_cats', array( $this, 'wp_dropdown_cats' ) );

		// Set defaults
		$this->defaults = array(
			'show_option_none' => __( 'None' ),
			'orderby'          => 'name',
			'hide_empty'       => 0,
			'id'               => $this->id,
			'selected'         => $this->value()
		);

		// parse defaults and user data
		$cats = wp_parse_args(
			$this->options,
			$this->defaults
		);

		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php wp_dropdown_categories( $cats ); ?>
		</label>
		<?php
	}

    /**
     * Replace WP default dropdown
     *
     * @since   11/14/2012
     * @return  String $output
     */
    public function wp_dropdown_cats( $output )
    {
        $output = str_replace( '<select', '<select ' . $this->get_link(), $output );

        return $output;
    }
}
?>