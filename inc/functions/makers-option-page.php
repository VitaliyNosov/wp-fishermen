<?php
class MySettingsPage{
    private $options;

    public function __construct(){
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    public function add_plugin_page(){
        add_options_page(
            'Settings Admin', 
            'Makers Creation', 
            'manage_options', 
            'makers-settings-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    public function create_admin_page(){
    $this->options = get_option( 'makers_option');
    ?>
    
    <div class="makers-actions">

        <div id="makers-get-positions">
            <button id="set-data-button" type="button" class="button button-primary">
                SET DATA
            </button>
        </div>

        <div class="makers-tabs-switch">
            <div class="makers-tabs-input">
                <label>Container Height</label>
                <input id="container-height-manual-input" type="number" name="" value="" min="10" max="6000">
            </div>
            <div class="makers-tabs-buttons">
                <button data-site="wide" id="site-wide-switch" type="button" class="makers-switch-button button button-primary">
                    Site Wide 1200
                </button>
                <button data-site="tablet" id="site-tablet-switch" type="button" class="makers-switch-button button">
                    Tablet 1024
                </button>
                <button data-site="mobile" d="site-mobile-switch" type="button" class="makers-switch-button button">
                    Mobile 600
                </button>
            </div>
        </div>

        <div class="makers-form">
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'makers_option_group' );
                    do_settings_sections( 'makers-settings-admin' );
                    submit_button();
                ?>
            </form>
        </div>

    </div>

    <?php
    $all_height_str = '3000';
    $makers_option = get_option('makers_option'); 
    if(!empty($makers_option)){
        $all_height_str = $makers_option['makers_container_height'];
    }
    ?>

    <div id="makers-page" class="makers-page wide" style="height: <?php echo $all_height_str; ?>px;">
        <?php
        $makers_query_args = array(
            'post_type' => 'makers',
            'order' => 'ASC',
            'orderby' => 'date',
            'posts_per_page'=> -1,
        );
        $makers_query = new WP_Query( $makers_query_args );
        ?>
        <?php if ( $makers_query->have_posts() ) { ?>
            <?php while ( $makers_query->have_posts() ) {  $makers_query->the_post(); ?>

                <?php 
                $image = get_field('image');
                $description = get_field('description');

                /**
                 * Sizes
                 */
                $w = '';
                $h = '';

                $sizes_wide = '';
                $width_wide = '';   
                $height_wide = '';

                $sizes_tablet = '';
                $width_tablet = ''; 
                $height_tablet = '';

                $sizes_mobile = '';
                $width_mobile = ''; 
                $height_mobile = '';

                $sizes = get_field('sizes');
                if (is_array($sizes)){
                    $sizes_wide = $sizes['site_wide'];
                    $sizes_tablet = $sizes['site_tablet'];
                    $sizes_mobile = $sizes['mobile'];

                    $width_wide = $sizes_wide['width'];
                    $height_wide = $sizes_wide['height'];

                    $width_tablet = $sizes_tablet['width'];
                    $height_tablet = $sizes_tablet['height'];

                    $width_mobile = $sizes_mobile['width'];
                    $height_mobile = $sizes_mobile['height'];

                }

                $w = $width_wide;
                $h = $height_wide;

                $image_id = '';
                $thumb_data = '';
                $img_src = '';
                if ($image){
                    $image_id = $image['ID'];
                    $thumb_data = wp_get_attachment_image_src($image_id, 'full');
                    $img_src = $thumb_data['0'];
                }
                ?>

                <div 
                id="maker-<?php echo get_the_ID(); ?>" class="maker" 
                data-width="<?php echo $w; ?>" 
                data-height="<?php echo $h; ?>" 
                data-width-tablet="<?php echo $width_tablet; ?>"
                data-height-tablet="<?php echo $height_tablet; ?>"
                data-width-mobile="<?php echo $width_mobile; ?>"
                data-height-mobile="<?php echo $height_mobile; ?>"
                data-index="1"
                data-text-position="left"
                >
                    <div class="maker-inner">
                        <div class="maker-layout" flex layout="row" layout-align="start center">
                            <div class="maker-desc" flex>
                                <div class="maker-name h4"><?php the_title(); ?></div>
                                <div class="maker-text body-2"><?php echo $description; ?></div>
                            </div>
                            <div class="maker-thumb" flex="none" style="height: <?php echo $h; ?>px; width: <?php echo $w; ?>px;">

                                <div class="maker-action">
                                    <button type="button" class="button maker-action-index-up">
                                        &uarr;
                                    </button> 
                                    <button type="button" class="button maker-action-index-down">
                                        &darr;
                                    </button> 
                                    <button type="button" class="button maker-action-text-position">
                                        &harr;
                                    </button> 
                                </div>

                                <img src="<?php echo $img_src; ?>">
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>
        <?php wp_reset_postdata(); ?>

    </div>

    
    <?php }

    public function page_init(){        
        register_setting(
            'makers_option_group', // Option group
            'makers_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'makers_section_creation_id', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'makers-settings-admin' // Page
        );  

        add_settings_field(
            'makers_container_height', // ID
            'Container Height', // Title 
            array( $this, 'makers_container_height_callback' ), // Callback
            'makers-settings-admin', // Page
            'makers_section_creation_id' // Section           
        );     
        add_settings_field(
            'makers_container_height_tablet', // ID
            'Container Height Tablet', // Title 
            array( $this, 'makers_container_height_tablet_callback' ), // Callback
            'makers-settings-admin', // Page
            'makers_section_creation_id' // Section           
        );     
        add_settings_field(
            'makers_container_height_mobile', // ID
            'Container Height Mobile', // Title 
            array( $this, 'makers_container_height_mobile_callback' ), // Callback
            'makers-settings-admin', // Page
            'makers_section_creation_id' // Section           
        );     


        add_settings_field(
            'makers_position_number', // ID
            'Data Positions', // Title 
            array( $this, 'makers_position_number_callback' ), // Callback
            'makers-settings-admin', // Page
            'makers_section_creation_id' // Section           
        );         
        add_settings_field(
            'makers_tablet_positions', // ID
            'Data Tablet Positions', // Title 
            array( $this, 'makers_tablet_positions_callback' ), // Callback
            'makers-settings-admin', // Page
            'makers_section_creation_id' // Section           
        );    
        add_settings_field(
            'makers_mobile_positions', // ID
            'Data Mobile Positions', // Title 
            array( $this, 'makers_mobile_positions_callback' ), // Callback
            'makers-settings-admin', // Page
            'makers_section_creation_id' // Section           
        );           
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        $inputs_data = array(
            'makers_container_height',
            'makers_container_height_tablet',
            'makers_container_height_mobile',
            'makers_position_number',
            'makers_tablet_positions',
            'makers_mobile_positions'
        );

        foreach($inputs_data as $e){
            if( isset( $input[$e] ) )
                $new_input[$e] = $input[$e]; 
        }

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        //print 'Makers Creation:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function makers_container_height_callback()
    {   
        printf(
            '<input type="number" id="makers_container_height" name="makers_option[makers_container_height]" value="%s" readonly />',
            isset( $this->options['makers_container_height'] ) ? esc_attr( $this->options['makers_container_height']) : ''
        );
    }
    public function makers_container_height_tablet_callback()
    {   
        printf(
            '<input type="number" id="makers_container_height_tablet" name="makers_option[makers_container_height_tablet]" value="%s" readonly />',
            isset( $this->options['makers_container_height_tablet'] ) ? esc_attr( $this->options['makers_container_height_tablet']) : ''
        );
    }
    public function makers_container_height_mobile_callback()
    {   
        printf(
            '<input type="number" id="makers_container_height_mobile" name="makers_option[makers_container_height_mobile]" value="%s" readonly />',
            isset( $this->options['makers_container_height_mobile'] ) ? esc_attr( $this->options['makers_container_height_mobile']) : ''
        );
    }

    public function makers_position_number_callback()
    {   
        printf(
            '<input type="text" id="makers_position_number" name="makers_option[makers_position_number]" value="%s" />',
            isset( $this->options['makers_position_number'] ) ? esc_attr( $this->options['makers_position_number']) : ''
        );
    }
    public function makers_tablet_positions_callback()
    {   
        printf(
            '<input type="text" id="makers_tablet_positions" name="makers_option[makers_tablet_positions]" value="%s" />',
            isset( $this->options['makers_tablet_positions'] ) ? esc_attr( $this->options['makers_tablet_positions']) : ''
        );
    }
    public function makers_mobile_positions_callback()
    {   
        printf(
            '<input type="text" id="makers_mobile_positions" name="makers_option[makers_mobile_positions]" value="%s" />',
            isset( $this->options['makers_mobile_positions'] ) ? esc_attr( $this->options['makers_mobile_positions']) : ''
        );
    }

}

if( is_admin() )
    $my_settings_page = new MySettingsPage();
?>

