<?php
/**
 * Customize for textarea, extend the WP customizer
 *
 * @package    WordPress
 * @subpackage Wordpress-Theme-Customizer-Custom-Controls
 * @see        https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
 * @since      10/16/2012
 * @author     Frank Bültge <frank@bueltge.de>
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
	return NULL;

class Textarea_Custom_Control extends WP_Customize_Control {
	
	/**
	 * @access public
	 * @var    string
	 */
	public $type = 'textarea';
	
	/**
	 * @access public
	 * @var    array
	 */
	public $statuses;
	
	/**
	 * Constructor.
	 *
	 * If $args['settings'] is not defined, use the $id as the setting ID.
	 *
	 * @since   10/16/2012
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
	 * @since   10/16/2012
	 * @return  void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
				<?php echo esc_textarea( $this->value() ); ?>
			</textarea>
		</label>
		<?php
	}
	
}
