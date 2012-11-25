<?php
if (class_exists('WP_Customize_Control'))
{
    /**
     * Class to create a custom tags control
     */
    class Tags_Dropdown_Custom_control extends WP_Customize_Control
    {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content()
           {

                ?>
                    <label>
                      <span class="customize-tags-dropdown"><?php echo esc_html( $this->label ); ?></span>
                      <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                      <?php
                          $args = wp_parse_args($this->args, array());

                          $tags = get_tags($args);
                          foreach ( $tags as $tag ) {
                            echo '<option value="'.$tag->term_id.'" '.selected($this->value, $tag->term_id).'>'.$tag->name.'</option>';
                          }
                        ?>
                      </select>
                    </label>
                <?php
           }
    }
}
?>