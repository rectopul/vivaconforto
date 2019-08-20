<?php
/**
* Class for registering a new settings page under Settings.
*/

/**
 * Load Styles and Javascript changes in admin area 
*/
function admin_style() 
{
    wp_enqueue_style('Admin Styles', get_template_directory_uri().'/assets/css/admin/customizer/options_theme.css');
    wp_enqueue_script('Options Theme JS', get_template_directory_uri() . '/assets/js/admin/options_theme.js', array('jquery'), '0.0.1', true); 
}
add_action('admin_enqueue_scripts', 'admin_style');

// Função para verificar e retornar nossas opções
function rgm_check ( $array, $key ) {
	if ( isset( $array[$key] ) ) {
		return $array[$key];
	} else {
		return false;
	}
}

class RGB_Options_Page {
    /**
    * Constructor.
    */

    // As opções
    protected $options;

    function __construct() {
        global $rgb_options;
        // Configura as opções dentro da classe        
        $this->options = $rgb_options;

        # Check if is Admin page
        if( is_admin() ){
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );

            // Registra nossas opções
            add_action( 'admin_init', array( $this, 'registra_opcoes' ) );

            add_action( 'wp_ajax_insert_slides', '_insert_slides' );
        }           
    } # Constructor
    
    /**
    * Registers a new settings page under Settings.
    */

    function admin_menu() {
        add_theme_page(
            __( 'Opçoes de administraçao do seu Tema', 'textdomain' ),
            __( 'Opçoes do tema', 'textdomain' ),
            'manage_options',
            'options_page_slug',
            array(
                $this,
                'settings_page'
            )
        );
    }
    
    // Same handler function...
    
    
    
    public function registra_opcoes() {
		
        register_setting( 
            'options_theme', 
            'options_theme', 
            array( $this, 'callback_slides' ) // Função de callback
        );

        function _insert_slides() {
            /* $optionsExist = get_options('slides_theme');
            $optionsExist[] = $_POST['slides_theme']; */
            if ( update_option('options_theme', $_POST['options_theme'] ) ){                
                echo 'Cadastrado com sucesso';
            }else{
                echo "error";
            }
            wp_die();
        } 
        
    }

    /**
     * Funçao de Callback ao registra opçoes
     */
    
    
     public function callback_slides( $results_options )
     {          
        //echo json_encode($results_options);
        if ( $results_options['slides'] ){
            $results_options = $_POST['options_theme'];
        } 
        //update_option('options_theme', $results_options);
        return $results_options;
     }
    /**
     * Settings page display callback.
     */
    function settings_page() 
    {    
        wp_enqueue_media();    
        ?><div class="conainer-options-theme">
            <?php 
                //var_dump( get_option( 'options_theme' )  );
            ?>
            <header><h1>Opçoes de do Tema</h1></header>
            <div class="wraper-options-theme">
                <ul class="head">
                    <li goto="slides" class="option-active">Slides</li>
                    <li goto="partners">Parceiros</li>
                    <li goto="contact">Contato</li>
                </ul>

                <div class="wraper-options-content">
                    <!-- Content Slides -->
                    <form method="post" class="form_options" id="form-options" action="options.php">
                        <div class="slides">
                            <header>Selecione as Imagens do Slide</header>                            
                        <?php 
                            settings_fields( 'options_theme' );
                            do_settings_sections( 'options_theme' );
                            $check_theme = get_option('options_theme');
                            //var_dump($check_theme);
                            if( $check_theme['slides'] ){
                                $cl = 0;
                                foreach ($check_theme['slides'] as $n => $image_url) {
                                    # code...
                                    $cl++;
                                    ?>
                                    <div class="slide-1">                            
                                        <span>
                                            <label for="">Imagem - <?php echo $cl; ?></label>
                                            <input class="inpt-img-1" type="hidden" name="options_theme[slides][image-<?php echo $cl; ?>]" value="<?php echo $image_url; ?>"> 
                                            <div class="img-default">
                                                <?php 
                                                    printf('<img src="%s" alt="image default rgb themes">',
                                                        $image_url ? $image_url : get_template_directory_uri().'/assets/images/admin/woocommerce-placeholder-300x300.png'
                                                    );
                                                ?>
                                                <button class="img-select">Selecionar Imagem</button>
                                                <button class="img-remove">Remover Imagem</button> 
                                            </div>                         
                                        </span>                                                            
                                    </div>
                                    <?php
                                }
                            }else{                           
                        ?>
                                <div class="slide-1">                            
                                    <span>
                                        <label for="">Imagem - 1</label>
                                        <input class="inpt-img-1" type="hidden" name="options_theme[slides][slide-1]" value="Slide1"> 
                                        <div class="img-default">
                                            <img src="<?php bloginfo( 'template_directory' ); ?>/assets/images/admin/woocommerce-placeholder-300x300.png" alt="image default rgb themes">
                                            <button class="img-select">Selecionar Imagem</button>
                                            <button class="img-remove">Remover Imagem</button> 
                                        </div>                         
                                    </span>                                                            
                                </div> 
                            <?php }?>    
                            <button class="theme-add-image">Adicionar Imagens</button>                    
                        </div>
                            
                        <!-- Content Partners -->
                        <div class="partners">
                        </div>
                        <!-- Content Contact -->
                        <div class="contact">
                        </div>
                        <?php submit_button(); ?>
                    </form>
                </div>
            </div>
            <script>
                theme_directory = "<?php echo get_template_directory_uri() ?>";
            </script>
            
        </div> <?php
    }
} 
new RGB_Options_Page;


/* add_action('admin_menu', 'add_global_custom_options'); #Adiciona Opção no menu de admin
function add_global_custom_options()
{
    add_options_page('Global Custom Options', 'Global Custom Options', 'manage_options', 'functions','global_custom_options');
} */