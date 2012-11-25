<?php
if (class_exists('WP_Customize_Control'))
{
    /**
     * Class to create a custom post type control
     */
    class Post_Type_Dropdown_Custom_control extends WP_Customize_Control
    {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content()
           {

                ?>
                    <label>
                      <span class="customize-post-type-dropdown"><?php echo esc_html( $this->label ); ?></span>
                      <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                      <?php
                          $args = wp_parse_args($this->args, array('public' => true));

                          $post_types = get_post_types($args, 'object');
                          foreach ( $post_types as $k => $post_type ) {
                            echo '<option value="'.$k.'" '.selected($this->value, $k).'>'.$post_type->labels->name.'</option>';
                          }
                        ?>
                      </select>
                    </label>
                <?php
           }
    }
}
?>