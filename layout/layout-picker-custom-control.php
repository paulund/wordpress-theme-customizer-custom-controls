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
                <label>
                  <span class="customize-layout-control"><?php echo esc_html( $this->label ); ?></span>
                  <ul>
                    <li><img src="<?php echo $finalImageDirectory; ?>1col.png" alt="Full Width" /><input type="radio" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[full_width]" value="1" /></li>
                    <li><img src="<?php echo $finalImageDirectory; ?>2cl.png" alt="Left Sidebar" /><input type="radio" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[left_sidebar]" value="1" /></li>
                    <li><img src="<?php echo $finalImageDirectory; ?>2cr.png" alt="Right Sidebar" /><input type="radio" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[right_sidebar]" value="1" /></li>
                  </ul>
                </label>
            <?php
       }
}
?>