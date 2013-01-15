<?php
/**
 * Customize for taxonomy with dropdown, extend the WP customizer
 *
 * @package    WordPress
 * @subpackage Wordpress-Theme-Customizer-Custom-Controls
 * @see        https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
 * @since      11/14/2012
 * @author     Frank Bültge <frank@bueltge.de>
 * @usage      https://gist.github.com/4538951
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
	return NULL;

class Taxonomy_Dropdown_Custom_Control extends WP_Customize_Control {
	
	/**
	 * @access public
	 * @var    string
	 */
	public $type = 'taxonomy_dropdown';
	
	/**
	 * @access public
	 * @var    array
	 */
	public $statuses;
	
	/**
	 * @access public
	 * @var    array
	 */
	public $defaults = array();
	
	/**
	 * @access public
	 * @var    array
	 */
	public $args = array();
	/**
	 * Constructor.
	 *
	 * If $args['settings'] is not defined, use the $id as the setting ID.
	 *
	 * @since   11/14/2012
	 * @uses    WP_Customize_Control::__construct()
	 * @param   WP_Customize_Manager $manager
	 * @param   string $id
	 * @param   array $args
	 * @return  void
	 */
	public function __construct( $manager, $id, $args = array() ) {
		
		$this->statuses = array( '' => __( 'Default' ) );
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
	public function render_content() {
		
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
			$this->args,
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
	public function wp_dropdown_cats( $output ) {
		
		// Search for '<select'
		// Replace it with '<select data-customize=setting-link="my_control_id"'
		$output = str_replace( '<select', '<select ' . $this->get_link(), $output );
		
		return $output;
	}
	
}
