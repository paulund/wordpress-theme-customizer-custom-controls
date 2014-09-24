<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all google fonts
 */
 class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $fonts = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->fonts = $this->get_fonts();
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
    {
        if(!empty($this->fonts))
        {
            ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?>>
                        <?php
                            foreach ( $this->fonts as $k => $v )
                            {
                                printf('<option value="%s" %s>%s</option>', $v->family, selected($this->value(), $v->family, false), $v->family);
                            }
                        ?>
                    </select>
                </label>
            <?php
        } else {
        ?>
        	<p>The font list is empty.</p>
        <?php
        }
    }

    /**
     * Get the google fonts from the API or in the cache
     *
     * @param  integer $amount
     *
     * @return String
     */
    public function get_fonts( $amount = 600 )
    {
		global $wp_filesystem;
		// Initialize the WP filesystem, no more using 'file-put-contents' function
		if (empty($wp_filesystem)) {
			require_once (ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();
		}
		
        $selectDirectory = get_stylesheet_directory().'/tbnframework/admin/options/customizer-custon-controls/select/';
        $selectDirectoryInc = get_template_directory().'/tbnframework/admin/options/customizer-custon-controls/select/';

        $finalselectDirectory = '';

        if(is_dir($selectDirectory))
        {
            $finalselectDirectory = $selectDirectory;
        }

        if(is_dir($selectDirectoryInc))
        {
            $finalselectDirectory = $selectDirectoryInc;
        }

        $fontFile = $finalselectDirectory . '/cache/google-web-fonts.txt';
		
        //Total time the file will be cached in seconds, set to 180 days
        $cachetime = 86400 * 180;
        if(file_exists($fontFile) && time() - $cachetime < filemtime($fontFile))
        {
            $content = json_decode($wp_filesystem->get_contents($fontFile));
        } else {
			$Api = '';
            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key='.$Api;

            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );

			if( $wp_filesystem ) {
					$wp_filesystem->put_contents(
					$fontFile,
					$fontContent['body'],
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}

            $content = json_decode($fontContent['body']);
        }
	if( !empty($content->items) ) {
        	if($amount == 'all') {
            		return $content->items;
        	} else {
			return array_slice($content->items, 0, $amount);
        	}
        } else {
        	return false;
        }
    }
 }
?>
