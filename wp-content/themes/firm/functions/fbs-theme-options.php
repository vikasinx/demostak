<?php
/*
** Theme Options Page
*/
// text editor


if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/*Repeater Custom Control*/
// include('custom-repeater.php');
/**
 * Class to create a custom tags control
 */
class Text_Editor_Custom_Control extends WP_Customize_Control
{
    /**
     * Render the content on the theme customizer page
     */
    public function render_content()
    {
        ?>
        <label>
            <span class="customize-text_editor"><?php echo esc_html( $this->label ); ?></span>
            <input class="wp-editor-area" type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
            <?php
            $settings = array(
                'textarea_name' => $this->id,
                'media_buttons' => true,
                'drag_drop_upload' => false,
                'teeny' => true,
                'quicktags' => true,
                'textarea_rows' => 5,
                'remove_linebreaks'=>true,
            );
            $this->filter_editor_setting_link();
            wp_editor($this->value(), $this->id, $settings );
            ?>
        </label>
        <?php
        do_action('admin_footer');
        do_action('admin_print_footer_scripts');
    }
    private function filter_editor_setting_link() {
        add_filter( 'the_editor', function( $output ) { return preg_replace( '/<textarea/', '<textarea ' . $this->get_link(), $output, 1 ); } );
    }
}

function editor_customizer_script() {
    wp_enqueue_script( 'wp-editor-customizer', get_template_directory_uri() . '/js/customize.js', array( 'jquery' ), rand(), true );
}
add_action( 'customize_controls_enqueue_scripts', 'editor_customizer_script' );



/*Add customize Js*/

/*function fbs_customize_backend_init(){

	wp_enqueue_script('fbs_customizer_js', get_template_directory_uri.'/js/customize.js');
}
add_action( 'fbs_customize_enqueue_scripts', 'fbs_customize_backend_init' );
*/

/**
 * Add our Customizer content
 */
function fbs_customize_register( $wp_customize ) {
 
 /**
 * Add Homepage pannel
 */
 $wp_customize->add_panel( 'fbs_home_page_panel',
   array(
      'title' => __( 'FrontPage Sections' ),
      'description' => esc_html__( 'Adjust sections on homepage.' ), // Include html tags such as 
 
      'priority' => 160, // Not typically needed. Default is 160
      'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
      'theme_supports' => '', // Rarely needed
      'active_callback' => '', // Rarely needed
   )
);

/**
 * Add slider section
 */
$wp_customize->add_section( 'fbs_home_slider_section',
   array(
      'title' => __( 'Homepage Slider' ),
      'description' => esc_html__( 'Add remove sliders on homepage.' ),
      'panel' => 'fbs_home_page_panel', // Only needed if adding your Section to a Panel
      'priority' => '', // Not typically needed. Default is 160
      'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
      'theme_supports' => '', // Rarely needed
      'active_callback' => '', // Rarely needed
      'description_hidden' => 'false', // Rarely needed. Default is False
   )
);

/*Slider 1  Image*/

$wp_customize->add_setting( 'fbs_home_slider_one_image',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'absint'
   )
);
 
$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbs_home_slider_one_image',
   array(
      'label' => __( 'Slider 1' ),
      'description' => esc_html__( 'selecte image to show in slider 1' ),
      'section' => 'fbs_home_slider_section',
      'mime_type' => 'image',  // Required. Can be image, audio, video, application, text
      'button_labels' => array( // Optional
         'select' => __( 'Select File' ),
         'change' => __( 'Change File' ),
         'default' => __( 'Default' ),
         'remove' => __( 'Remove' ),
         'placeholder' => __( 'No file selected' ),
         'frame_title' => __( 'Select File' ),
         'frame_button' => __( 'Choose File' ),
      )
   )
) );

/*Slider 1  title*/

$wp_customize->add_setting( 'fbs_home_slider_one_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_one_title',
   array(
      'label' => __( 'Slider 1 Title' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Title...' ),
      ),
   )
);


/*Slider 1 description*/

$wp_customize->add_setting( 'fbs_home_slider_one_description',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_one_description',
   array(
      'label' => __( 'Slider 1 description' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'textarea',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'fbs_slider_section_ct_desc',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter slider description...' ),
      ),
   )
);


$wp_customize->add_setting( 'fbs_home_slider_one_link',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_one_link',
   array(
      'label' => __( 'Slider URL' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'http://google.com/' ),
      ),
   )
);

/*Slider 2  Image*/

$wp_customize->add_setting( 'fbs_home_slider_two_image',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'absint'
   )
);
 
$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbs_home_slider_two_image',
   array(
      'label' => __( 'Slider 2' ),
      'description' => esc_html__( 'selecte image to show in slider 2' ),
      'section' => 'fbs_home_slider_section',
      'mime_type' => 'image',  // Required. Can be image, audio, video, application, text
      'button_labels' => array( // Optional
         'select' => __( 'Select File' ),
         'change' => __( 'Change File' ),
         'default' => __( 'Default' ),
         'remove' => __( 'Remove' ),
         'placeholder' => __( 'No file selected' ),
         'frame_title' => __( 'Select File' ),
         'frame_button' => __( 'Choose File' ),
      )
   )
) );

/*Slider 2  title*/

$wp_customize->add_setting( 'fbs_home_slider_two_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_two_title',
   array(
      'label' => __( 'Slider 2 Title' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Title...' ),
      ),
   )
);


/*Slider 2 description*/

$wp_customize->add_setting( 'fbs_home_slider_two_description',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_two_description',
   array(
      'label' => __( 'Slider 2 description' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'textarea',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'fbs_slider_section_ct_desc',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter slider description...' ),
      ),
   )
);

$wp_customize->add_setting( 'fbs_home_slider_two_link',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_two_link',
   array(
      'label' => __( 'Slider URL' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'http://google.com/' ),
      ),
   )
);

/*Slider 3  Image*/

$wp_customize->add_setting( 'fbs_home_slider_three_image',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'absint'
   )
);
 
$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbs_home_slider_three_image',
   array(
      'label' => __( 'Slider 3' ),
      'description' => esc_html__( 'selecte image to show in slider 3' ),
      'section' => 'fbs_home_slider_section',
      'mime_type' => 'image',  // Required. Can be image, audio, video, application, text
      'button_labels' => array( // Optional
         'select' => __( 'Select File' ),
         'change' => __( 'Change File' ),
         'default' => __( 'Default' ),
         'remove' => __( 'Remove' ),
         'placeholder' => __( 'No file selected' ),
         'frame_title' => __( 'Select File' ),
         'frame_button' => __( 'Choose File' ),
      )
   )
) );

/*Slider 3  title*/

$wp_customize->add_setting( 'fbs_home_slider_three_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_three_title',
   array(
      'label' => __( 'Slider 3 Title' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Title...' ),
      ),
   )
);


/*Slider 3 description*/

$wp_customize->add_setting( 'fbs_home_slider_three_description',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_three_description',
   array(
      'label' => __( 'Slider 3 description' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'textarea',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'fbs_slider_section_ct_desc',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter slider description...' ),
      ),
   )
);


$wp_customize->add_setting( 'fbs_home_slider_three_link',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_slider_three_link',
   array(
      'label' => __( 'Slider URL' ),
      'section' => 'fbs_home_slider_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'http://google.com/' ),
      ),
   )
);


/**
 * Add About Us section
 */

$wp_customize->add_section( 'fbs_home_about_section',
   array(
      'title' => __( 'Homepage About Us' ),
      'description' => esc_html__( 'Add Content To Show on About Us section on Homepage.' ),
      'panel' => 'fbs_home_page_panel', // Only needed if adding your Section to a Panel
      'priority' => '', // Not typically needed. Default is 160
      'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
      'theme_supports' => '', // Rarely needed
      'active_callback' => '', // Rarely needed
      'description_hidden' => 'false', // Rarely needed. Default is False
   )
);

/* About Us section title*/
$wp_customize->add_setting( 'fbs_home_about_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_about_title',
   array(
      'label' => __( 'About Us Section Title' ),
      'section' => 'fbs_home_about_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Title...' ),
      ),
   )
);

/*About us section Content*/

$wp_customize->add_setting( 'fbs_home_about_description',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'fbs_home_about_description',
   array(
      'label' => __( 'About Us section content' ),
      'section' => 'fbs_home_about_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'textarea',
      'capability' => 'edit_theme_options',
   )
)
);

$wp_customize->add_setting( 'fbs_home_about_link',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_about_link',
   array(
      'label' => __( 'Slider URL' ),
      'section' => 'fbs_home_about_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'http://google.com/' ),
      ),
   )
);

/* Service section title*/

$wp_customize->add_section( 'fbs_home_service_section',
   array(
      'title' => __( 'Homepage Services' ),
      'description' => esc_html__( 'Add Services' ),
      'panel' => 'fbs_home_page_panel', // Only needed if adding your Section to a Panel
      'priority' => '', // Not typically needed. Default is 160
      'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
      'theme_supports' => '', // Rarely needed
      'active_callback' => '', // Rarely needed
      'description_hidden' => 'false', // Rarely needed. Default is False
   )
);


$wp_customize->add_setting( 'fbs_home_service_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_title',
   array(
      'label' => __( 'Service Section Title' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Title...' ),
      ),
   )
);

/* Service Image 1*/
$wp_customize->add_setting( 'fbs_home_service_one_image',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'absint'
   )
);
 

$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbs_home_service_one_image',
   array(
      'label' => __( 'Service Image 1' ),
      'section' => 'fbs_home_service_section',
      'mime_type' => 'image',  // Required. Can be image, audio, video, application, text
      'button_labels' => array( // Optional
         'select' => __( 'Select File' ),
         'change' => __( 'Change File' ),
         'default' => __( 'Default' ),
         'remove' => __( 'Remove' ),
         'placeholder' => __( 'No file selected' ),
         'frame_title' => __( 'Select File' ),
         'frame_button' => __( 'Choose File' ),
      )
   )
) );


/*Service 1  title*/

$wp_customize->add_setting( 'fbs_home_service_one_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_one_title',
   array(
      'label' => __( 'Service 1 Title' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Searvice Name...' ),
      ),
   )
);


/*service 1 description*/

$wp_customize->add_setting( 'fbs_home_service_one_description',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_one_description',
   array(
      'label' => __( 'Service 1 description' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'textarea',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'fbs_slider_section_ct_desc',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter slider description...' ),
      ),
   )
);

$wp_customize->add_setting( 'fbs_home_service_one_link',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_one_link',
   array(
      'label' => __( 'Service 1 Read More Link' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'http://google.com/' ),
      ),
   )
);


/* Service Image 2*/
$wp_customize->add_setting( 'fbs_home_service_two_image',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'absint'
   )
);
 

$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbs_home_service_two_image',
   array(
      'label' => __( 'Service Image 2' ),
      'section' => 'fbs_home_service_section',
      'mime_type' => 'image',  // Required. Can be image, audio, video, application, text
      'button_labels' => array( // Optional
         'select' => __( 'Select File' ),
         'change' => __( 'Change File' ),
         'default' => __( 'Default' ),
         'remove' => __( 'Remove' ),
         'placeholder' => __( 'No file selected' ),
         'frame_title' => __( 'Select File' ),
         'frame_button' => __( 'Choose File' ),
      )
   )
) );


/*Service 2  title*/

$wp_customize->add_setting( 'fbs_home_service_two_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_two_title',
   array(
      'label' => __( 'Service 2 Title' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Searvice Name...' ),
      ),
   )
);


/*service 2 description*/

$wp_customize->add_setting( 'fbs_home_service_two_description',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_two_description',
   array(
      'label' => __( 'Service 2 description' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'textarea',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'fbs_slider_section_ct_desc',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter slider description...' ),
      ),
   )
);

$wp_customize->add_setting( 'fbs_home_service_two_link',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_two_link',
   array(
      'label' => __( 'Service 1 Read More Link' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'http://google.com/' ),
      ),
   )
);

/* Service Image 3*/
$wp_customize->add_setting( 'fbs_home_service_three_image',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'absint'
   )
);
 

$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbs_home_service_three_image',
   array(
      'label' => __( 'Service Image 2' ),
      'section' => 'fbs_home_service_section',
      'mime_type' => 'image',  // Required. Can be image, audio, video, application, text
      'button_labels' => array( // Optional
         'select' => __( 'Select File' ),
         'change' => __( 'Change File' ),
         'default' => __( 'Default' ),
         'remove' => __( 'Remove' ),
         'placeholder' => __( 'No file selected' ),
         'frame_title' => __( 'Select File' ),
         'frame_button' => __( 'Choose File' ),
      )
   )
) );


/*Service 3  title*/

$wp_customize->add_setting( 'fbs_home_service_three_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_three_title',
   array(
      'label' => __( 'Service 3 Title' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Searvice Name...' ),
      ),
   )
);


/*service 3 description*/

$wp_customize->add_setting( 'fbs_home_service_three_description',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_three_description',
   array(
      'label' => __( 'Service 3 description' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'textarea',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'fbs_slider_section_ct_desc',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter slider description...' ),
      ),
   )
);


$wp_customize->add_setting( 'fbs_home_service_three_link',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_service_three_link',
   array(
      'label' => __( 'Service 1 Read More Link' ),
      'section' => 'fbs_home_service_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'http://google.com/' ),
      ),
   )
);


/**
 * Add Our skills section
 */

$wp_customize->add_section( 'fbs_home_skills_section',
   array(
      'title' => __( 'Homepage Our Skills' ),
      'description' => esc_html__( 'Add Your Skills' ),
      'panel' => 'fbs_home_page_panel', // Only needed if adding your Section to a Panel
      'priority' => '', // Not typically needed. Default is 160
      'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
      'theme_supports' => '', // Rarely needed
      'active_callback' => '', // Rarely needed
      'description_hidden' => 'false', // Rarely needed. Default is False
   )
);

/* Our skills section title*/
$wp_customize->add_setting( 'fbs_home_skills_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);


$wp_customize->add_control( 'fbs_home_skills_title',
   array(
      'label' => __( 'Our Skills Title' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Title...' ),
      ),
   )
);


/* Skill Section Background-image*/
$wp_customize->add_setting( 'fbs_home_skills_bg_image',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'absint'
   )
);
 

$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbs_home_skills_bg_image',
   array(
      'label' => __( 'Skills Section Background Image' ),
      'section' => 'fbs_home_skills_section',
      'mime_type' => 'image',  // Required. Can be image, audio, video, application, text
      'button_labels' => array( // Optional
         'select' => __( 'Select File' ),
         'change' => __( 'Change File' ),
         'default' => __( 'Default' ),
         'remove' => __( 'Remove' ),
         'placeholder' => __( 'No file selected' ),
         'frame_title' => __( 'Select File' ),
         'frame_button' => __( 'Choose File' ),
      )
   )
) );


 $wp_customize->add_setting( 'fbs_home_skills_description',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'fbs_home_skills_description',
   array(
      'label' => __( 'Skills section content' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'textarea',
      'capability' => 'edit_theme_options',
   )
)
);



$wp_customize->add_setting( 'fbs_home_skill_one_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_skill_one_title',
   array(
      'label' => __( 'Skill One Title' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Skill Title...' ),
      ),
   )
);

$wp_customize->add_setting( 'fbs_home_skill_one_percentage',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_skill_one_percentage',
   array(
      'label' => __( 'Skill One Percentage' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( '78' ),
      ),
   )
);



$wp_customize->add_setting( 'fbs_home_skill_two_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_skill_two_title',
   array(
      'label' => __( 'Skill two Title' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Skill Title...' ),
      ),
   )
);

$wp_customize->add_setting( 'fbs_home_skill_two_percentage',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_skill_two_percentage',
   array(
      'label' => __( 'Skill Two Percentage' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( '78' ),
      ),
   )
);


$wp_customize->add_setting( 'fbs_home_skill_three_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_skill_three_title',
   array(
      'label' => __( 'Skill three Title' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Skill Title...' ),
      ),
   )
);

$wp_customize->add_setting( 'fbs_home_skill_three_percentage',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_skill_three_percentage',
   array(
      'label' => __( 'Skill three Percentage' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( '78' ),
      ),
   )
);

$wp_customize->add_setting( 'fbs_home_skill_four_title',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_skill_four_title',
   array(
      'label' => __( 'Skill four Title' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( 'Enter Skill Title...' ),
      ),
   )
);

$wp_customize->add_setting( 'fbs_home_skill_four_percentage',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => ''
   )
);
 
$wp_customize->add_control( 'fbs_home_skill_four_percentage',
   array(
      'label' => __( 'Skill four Percentage' ),
      'section' => 'fbs_home_skills_section',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'input_attrs' => array( // Optional.
         'class' => 'section_ct_title',
         'style' => 'border: 1px solid #999',
         'placeholder' => __( '78' ),
      ),
   )
);



}
add_action( 'customize_register', 'fbs_customize_register' );
?>