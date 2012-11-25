<?php
if (class_exists('WP_Customize_Control'))
{
    /**
     * Class to create a custom menu control
     */
    class Menu_Dropdown_Custom_control extends WP_Customize_Control
    {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content()
           {

                ?>
                    <label>
                      <span class="customize-menu-dropdown"><?php echo esc_html( $this->label ); ?></span>
                      <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                        <?php
                          $menus = wp_get_nav_menus($args);
                          if($menus){
                            foreach ( $menus as $menu ) {
                              echo '<option value="'.$menu->term_id.'"'.selected($this->value, $menu->term_id).'>'.$menu->name.'</option>';
                            }
                          }
                        ?>
                      </select>
                    </label>
                <?php
           }
    }
}
?>