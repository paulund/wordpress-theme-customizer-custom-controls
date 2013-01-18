<?php
/**
 * Customize for user select, extend the WP customizer
 *
 * @package    WordPress
 * @subpackage Wordpress-Theme-Customizer-Custom-Controls
 * @see        https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
 * @since      10/18/2018
 * @author     Frank Bültge <frank@bueltge.de>
 * @usage      https://gist.github.com/4564337
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
	return NULL;

class User_Select_Custom_Control extends WP_Customize_Control {
	
	/**
	 * @access public
	 * @var    string
	 */
	public $type = 'option';
	
	/**
	 * @access public
	 * @var    array
	 */
	public $statuses;
	
	/**
	 * @access public
	 * @var    array
	 */
	public $query = array( 'orderby' => 'nicename' );
	
	/**
	 * @access public
	 * @var    array
	 */
	public $description;
	
	/**
	 * @access public
	 * @var    string
	 */
	public $textdomain = 'default';
	
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
	 * @since   01/13/2013
	 * @return  void
	 */
	public function render_content() {
		
		$query = $this->query;
		$users = $this->get_user_array($query);
		?>
		<label>
			<span class="customize-control-title" ><?php echo esc_html( $this->label ); ?></span>
			<?php
			if ( empty( $users ) ) {
				_e( 'No users found.', $this->textdomain );
			} else {
			?>
			<select <?php $this->link(); ?>>
				<option></option>
			<?php foreach( $users as $key => $value ) { ?>
				<option value="<?php echo $key; ?>" <?php echo ( $key == $this->value() ? 'selected' : '' ); ?>>
				<?php echo $value; ?>
				</option>
			<?php } ?>
			</select>
			<span style="display: block;"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
		</label>
		<?php
	}
	
	/**
	 * 
	 * @since   01/13/2013
	 * @param   
	 * @return  void
	 */
	public function get_user_array( $args = FALSE ) {
		
		$array = get_users( $args );
		
		foreach( $array as $items ) {
			$users["{$items->ID}"] = $items->user_nicename;
		}
		
		if ( empty( $users ) )
			return NULL;
			//$users[1] = __( 'Can`t find a user in the role', 'textdomain' ) . ' ' . esc_attr( $args['role'] );
			
		return $users;
	}
	
} // end class
