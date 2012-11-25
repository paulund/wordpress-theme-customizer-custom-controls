<?php
if (class_exists('WP_Customize_Control'))
{
    /**
     * Class to create a custom post control
     */
    class Post_Dropdown_Custom_control extends WP_Customize_Control
    {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content()
           {

                ?>
                    <label>
                      <span class="customize-post-dropdown"><?php echo esc_html( $this->label ); ?></span>
                      <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                      <?php
                          $args = wp_parse_args($this->args, array('numberposts' => '-1'));

                          $posts = get_posts($args);
                          foreach ( $posts as $post ) {
                            echo '<option value="'.$post->ID.'" '.selected($this->value, $post->ID).'>'.$post->post_title.'</option>';
                          }
                        ?>
                      </select>
                    </label>
                <?php
           }
    }
}
?>