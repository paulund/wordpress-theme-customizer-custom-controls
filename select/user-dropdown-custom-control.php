<?php
/**
 * Customize for user select, extend the WP customizer
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
	return NULL;

class User_Dropdown_Custom_Control extends WP_Customize_Control
{

    private $users = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->users = get_users( $options );

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
	public function render_content()
    {
        if(empty($this->users))
        {
            return false;
        }

		?>
		<label>
			<span class="customize-control-title" ><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?>>
			<?php foreach( $this->users as $user )
            {
                printf('<option value="%s" %s>%s</option>',
                                $user->data->ID,
                                selected($this->value(), $user->data->ID, false),
                                $user->data->display_name);
            } ?>
			</select>
		</label>
		<?php
	}
} // end class
?>