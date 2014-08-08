<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom layout control
 */
class Layout_Picker_Custom_Control extends WP_Customize_Control
{
      /**
       * Render the content on the theme customizer page
       */
      public function render_content()
       {
            $imageDirectory = '/wordpress-theme-customizer-custom-controls/layout/img/';
            $imageDirectoryInc = '/inc/wordpress-theme-customizer-custom-controls/layout/img/';

            $finalImageDirectory = '';

            if(is_dir(get_stylesheet_directory().$imageDirectory))
            {
                $finalImageDirectory = get_stylesheet_directory_uri().$imageDirectory;
            }

            if(is_dir(get_stylesheet_directory().$imageDirectoryInc))
            {
                $finalImageDirectory = get_stylesheet_directory_uri().$imageDirectoryInc;
            }
            ?>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	
	       <label>
	            <img src="<?php echo $finalImageDirectory; ?>1col.png" alt="Full Width" />
		        <input type="radio" value="full_width" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); checked( $this->value(), "full_width"); ?> />
		        <br/>
	        </label>
        	<label>
	           	<img src="<?php echo $finalImageDirectory; ?>2cl.png" alt="Left Sidebar" />
	        	<input type="radio" value="left_sidebar" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); checked( $this->value(), "left_sidebar"); ?> />
	        	<br/>
	        </label>
        	<label>
	        	<img src="<?php echo $finalImageDirectory; ?>2cr.png" alt="Right Sidebar" />
	        	<input type="radio" value="right_sidebar" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); checked( $this->value(), "right_sidebar"); ?> />
	        	<br/>
        	</label>
            <?php
       }
}
?>
