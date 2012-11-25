<?php
if (class_exists('WP_Customize_Control'))
{
     class Category_Dropdown_Custom_control extends WP_Customize_Control
     {
          public function render_content()
           {

                ?>
                    <label>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                $args = array();
                                $cats = get_categories($args);
                             		foreach ( $cats as $cat ) {
                			             echo '<option value="'.$cat->term_id.'"'.selected($this->value(), $cat->term_id).'>'.$cat->name.'</option>';
                		            }
                           ?>
                      </select>
                    </label>
                <?php
           }
     }
}
?>