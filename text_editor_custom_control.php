<?php
if (class_exists('WP_Customize_Control'))
{
    /**
     * Class to create a custom tags control
     */
    class Text_Editor_Custom_control extends WP_Customize_Control
    {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content()
           {
                ?>
                    <label>
                      <span class="customize-text_editor"><?php echo esc_html( $this->label ); ?></span>
                      <?php
                        $settings = array(
                          'textarea_name' => $this->id
                          );

                        wp_editor($this->value(), $this->id, $settings );
                      ?>
                    </label>
                <?php
           }
    }
}
?>