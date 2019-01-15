<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.orionorigin.com
 * @since      1.0.0
 *
 * @package    Vpc
 * @subpackage Vpc/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vpc
 * @subpackage Vpc/public
 * @author     ORION <help@orionorigin.com>
 */
class VPC_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Vpc_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Vpc_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/vpc-public.css', array(), $this->version, 'all');
//        wp_enqueue_style("o-flexgrid", VPC_URL . 'admin/css/flexiblegs.css', array(), $this->version, 'all');
//        wp_enqueue_style("FontAwesome", VPC_URL . 'public/css/font-awesome.min.css', array(), $this->version, 'all');
//        wp_enqueue_style("o-tooltip", VPC_URL . 'public/css/tooltip.min.css', array(), $this->version, 'all');
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Vpc_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Vpc_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
//        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/vpc-public.js', array('jquery'), $this->version, false);
//        wp_enqueue_script('wp-js-hooks', plugin_dir_url(__FILE__) . 'js/wp-js-hooks.min.js', array('jquery'), $this->version, false);
//        wp_localize_script($this->plugin_name, 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
        
        vpc_enqueue_core_scripts();
        
//        wp_enqueue_script("o-tooltip", VPC_URL . 'public/js/tooltip.min.js', array('jquery'), $this->version, false);
//        wp_enqueue_script("o-serializejson", VPC_URL . 'public/js/jquery.serializejson.min.js', array('jquery'), $this->version, false);
        
//        wp_register_script('o-widget', VPC_URL . 'public/js/upload/js/jquery.ui.widget.min.js');
//        wp_enqueue_script('o-widget', array('jquery'), $this->version, false);
//
//        wp_register_script('o-fileupload', VPC_URL . 'public/js/upload/js/jquery.fileupload.min.js');
//        wp_enqueue_script('o-fileupload', array('jquery'), $this->version, false);
//
//        wp_register_script('o-iframe-transport', VPC_URL . 'public/js/upload/js/jquery.iframe-transport.min.js');
//        wp_enqueue_script('o-iframe-transport', array('jquery'), $this->version, false);
//
//        wp_register_script('o-knob', VPC_URL . 'public/js/upload/js/jquery.knob.min.js');
//        wp_enqueue_script('o-knob', array('jquery'), $this->version, false);
//        
//        wp_register_script('o-upload', VPC_URL . 'public/js/upload/js/o-upload.js');
//        wp_enqueue_script('o-upload', array('jquery'), $this->version, false);
    }

    public function register_shortcodes() {
        add_shortcode('wpb_builder', array($this, 'get_vpc_editor_handlers'));
//        add_shortcode('vpc_saved_configs', array($this, 'get_library'));
    }
        
//        private function vpc_extract_configuration_images($saved_config, $original_config)
//        {
//            $components_by_names=  $original_config->get_components_by_name();
//            $output="";
//            
////            var_dump($components_by_names);
//            foreach ($saved_config as $saved_component_name=>$saved_options)
//            {
//                $original_options=$components_by_names[$saved_component_name];
//                if(!is_array($saved_options))
//                {
//                    $saved_options=array($saved_options);
//                }
//                
//                foreach ($saved_options as $saved_option)
//                {
//                    $original_option=  get_proper_value($original_options, $saved_option);
//                    $img_id=  get_proper_value($original_option, "image");
//                    if($img_id)
//                    {
//                        $img_url=  get_media_url($img_id);
//                        $output.="<img src='$img_url'>";
//                    }
//                }
//            }
//            
//            return $output;
//        }
    
//    function tests()
//    {
////        $variation=  wc_get_product(397);
////        var_dump($variation);
////        return;
//        $config_matches=array(
//            "541c0f7ca24a3"=>"1234567",
//            "541c2c7b70a7d"=>"1234567",
//            "541c2e877d899"=>"1234567",
//            "5617c421944eb"=>"1234567",
//        );
//        ob_start();
//        $args=array(
//            'post_type' => array('product', 'product_variation'),
//            'meta_key' => 'wvpc-meta',
//            'post_status'=> 'any',
//        );
//        $custom_products=  get_posts($args);
//        foreach ( $custom_products as $custom_product)
//        {
//            $product_obj=  wc_get_product($custom_product->ID);
//            $product_class=  get_class($product_obj);
//            if($product_class=="WC_Product_Simple")
//            {
//                $root_pid=$product_obj->ID;
//                $variable_pid=$product_obj->ID;
//            }
//            else
//            {
//                $root_pid=$custom_product->id;
//                $variable_pid=$custom_product->ID;
//            }
//                
//                
////            if($product_class=="WC_Product_Simple")
////            {
//                $meta=  get_post_meta($custom_product->ID, "wvpc-meta", true);
//                $old_config=$meta["product_config"];
//                
//                $new_config_id=$config_matches[$old_config];
//                
//                $new_meta=  get_post_meta($root_pid, "vpc-config", true);
//                if(empty($new_meta))
//                    $new_meta=array();
//                
//                $new_meta[$variable_pid]=array("config-id"=>$new_config_id);
//                update_post_meta($root_pid, "vpc-config", $new_meta);
//        }
//        $output = ob_get_contents();
//        ob_end_clean();
//        return $output;
//    }

//    private function sort_options_by_group($a, $b) {
//        return strcmp($a["group"], $b["group"]);
//    }
    
    public function get_vpc_editor_handlers($atts) {
        $product_id = get_query_var( "vpc-pid", false );
        
        extract( shortcode_atts( array(
                    'product' => '',
            ), $atts, 'wpb_builder' ) );
        
        //Maybe the product ID is included in the shortcode
        if(!$product_id)
            $product_id=$product;
        
        if(!$product_id)
            $output=__("Looks like you're trying to access the configuration page directly. This page can only be accessed by clicking on the Configure button from the product or the shop page.", "vpc");
        else
            $output=  $this->get_vpc_editor($product_id);
        
        return $output;       
        
    }
    
    private function get_vpc_editor($product_id)
    {
        $config=  get_product_config($product_id);
        $skin=  get_proper_value($config->settings, "skin", "VPC_Default_Skin");
        $editor = new $skin($product_id);        
        
        $to_load=  apply_filters("vpc_config_to_load", array(), $product_id);        
        
        return $editor->display($to_load);
    }

    public function add_query_vars($aVars) {
        $aVars[] = "vpc-pid";
        return $aVars;
    }

    public function add_rewrite_rules($param) {
        GLOBAL $vpc_settings;
        GLOBAL $wp_rewrite;
        $config_page_id = get_proper_value($vpc_settings, "config-page", false);
        if(!$config_page_id)
            return;
        if (function_exists("icl_object_id"))
            $config_page_id = icl_object_id($config_page_id, 'page', false, ICL_LANGUAGE_CODE);
        $wpc_page = get_post($config_page_id);
        if (is_object($wpc_page)) {
            //$slug = $wpc_page->post_name;
            $raw_slug = get_permalink($wpc_page->ID);
            $home_url = home_url('/');
            $slug = str_replace($home_url, '', $raw_slug);
            add_rewrite_rule(
                    // The regex to match the incoming URL
                    $slug . 'configure' . '/([^/]+)/?$',
                    // The resulting internal URL: `index.php` because we still use WordPress
                    // `pagename` because we use this WordPress page
                    // `designer_slug` because we assign the first captured regex part to this variable
                    'index.php?pagename=' . $slug . '&vpc-pid=$matches[1]',
                    // This is a rather specific URL, so we add it to the top of the list
                    // Otherwise, the "catch-all" rules at the bottom (for pages and attachments) will "win"
                    'top'
            );
            add_rewrite_rule(
                    // The regex to match the incoming URL
                    $slug . 'configure' . '/([^/]+)/([^/]+)/?$',
                    // The resulting internal URL: `index.php` because we still use WordPress
                    // `pagename` because we use this WordPress page
                    // `designer_slug` because we assign the first captured regex part to this variable
                    'index.php?pagename=' . $slug . '&vpc-pid=$matches[1]&tpl=$matches[2]',
                    // This is a rather specific URL, so we add it to the top of the list
                    // Otherwise, the "catch-all" rules at the bottom (for pages and attachments) will "win"
                    'top'
            );

            $wp_rewrite->flush_rules();
        }
    }
    
    function init_globals() {
        global $vpc_settings;
        $vpc_settings=  get_option("vpc-options");
    }
    
    function get_configure_btn() {
        $post_id = get_the_ID();
        $button=  $this->get_configuration_button($post_id, true);
        if($button)
            echo $button;
    }
    
    private function get_configuration_button($product_id, $wrap=false) {
//        global $vpc_settings;
        
        $metas = get_post_meta($product_id, 'vpc-config', true);
//        var_dump($metas);
        
        $product=  wc_get_product($product_id);
        if($product->product_type=="variable")
        {
            $variations=$product->get_available_variations();
            foreach ($variations as $variation)
            {
//                var_dump($variation);
                echo $this->get_button($variation["variation_id"], $metas, $wrap, false);
            }
        }
        else
        {
            echo $this->get_button($product_id, $metas, $wrap);
        }
        
    }
    
//    private function get_design_url($product_id, $saved_config_id=false)
//    {
//        global $vpc_settings;
//        $config_page_id = get_proper_value($vpc_settings, "config-page");
//        if(!$config_page_id)
//            return false;
//        if (function_exists("icl_object_id"))
//            $config_page_id = icl_object_id($config_page_id, 'page', false, ICL_LANGUAGE_CODE);
//        
//        $design_url = get_permalink($config_page_id);
//        if ($product_id) {
////                $query = parse_url($design_url, PHP_URL_QUERY);
//            // Returns a string if the URL has parameters or NULL if not
//            if (get_option('permalink_structure')) {
//                if (substr($design_url, -1) != '/') {
//                    $design_url .= '/';
//                }
//                $design_url .= 'configure/' . $product_id . '/';
//                if($saved_config_id)
//                    $design_url.="?cid=$saved_config_id";
//            } else {
//
//                $design_url .= '&vpc-pid=' . $product_id;
//                if($saved_config_id)
//                    $design_url.="&cid=$saved_config_id";
//            }
//        }
//            
//        return $design_url;
//    }
    
    private function get_button($id, $metas, $wrap, $display=true)
    {
        
        $configs=  get_proper_value($metas, $id, array());
//        var_dump($configs);
//        echo "<hr>";
        $config_id=  get_proper_value($configs, "config-id", false);
//        var_dump($config_id);
//        echo "<hr>";
        if(!$config_id)
            return false;

        $design_url=  vpc_get_configuration_url($id);
            
            if($display)
                $style="";
            else
                $style="style='display:none;'";
            
            if($wrap)
                $design_url="<a class='vpc-configure-button button' href='$design_url' data-id='$id' $style>".__("Build your own")."</a>";
            

        return $design_url;
    }

    function get_configure_btn_loop($html, $product) {
        $button=  $this->get_configuration_button($product->id, true);
        if($button)
            $html.=$button;
        return $html;
    }
    
    function set_variable_action_filters() {
        global $vpc_settings;
        $append_content_filter = get_proper_value($vpc_settings, "manage-config-page", "Yes");

        if ($append_content_filter === "Yes" && !is_admin()) {

            add_filter("the_content", array($this, "filter_content"), 99);
        }
    }

    function filter_content($content) {
        global $vpc_settings;
//        global $wp_query;
        $vpc_page_id = get_proper_value($vpc_settings, "config-page", false);
        if(!$vpc_page_id)
            return $content;
        if (function_exists("icl_object_id"))
            $vpc_page_id = icl_object_id($vpc_page_id, 'page', false, ICL_LANGUAGE_CODE);
        
        $current_page_id = get_the_ID();
        if ($vpc_page_id == $current_page_id) {
            $product_id = get_query_var( "vpc-pid", false );//$wp_query->query_vars["vpc-pid"];
            if(!$product_id)
                $content.=__("Looks like you're trying to access the configuration page directly. This page can only be accessed by clicking on the Configure button from the product or the shop page.", "vpc");
            else
                $content.=  $this->get_vpc_editor($product_id);
        }
        return $content;
    }
    
    public function get_design_price()
    {
        $price=$_POST["total_price"];
        echo wc_price($price);
        die();
    }
    
//    private function get_product_config($product_id)
//    {
//        $ids= $this->get_product_root_and_variations_ids($product_id);
//        $config_meta = get_post_meta($ids["product-id"], "vpc-config", true);
//        $configs=  get_proper_value($config_meta, $product_id, array());
//        $config_id=  get_proper_value($configs, "config-id", false);
//        
////        $config_meta = get_post_meta($product_id, "vpc-config", true);
////        $config_id=  get_proper_value($config_meta, "config-id");
//        if(!$config_id||empty($config_id))
//            return false;
//        
//        $config_obj=new VPC_Config($config_id);
//        return $config_obj;
//    }
    
//    private function get_product_root_and_variations_ids($id)
//    {
//        $product_id=0;
//        $variation_id=0;
//        $variation = array();
//        
//        $variable_product = wc_get_product($id);
//        if(!$variable_product)
//            return false;
////        var_dump($id);
////        $variation = array();
//        if ($variable_product->product_type == "simple")
//            $product_id = $id;
//        else {
//            $variation = $variable_product->variation_data;
//            $product_id = $variable_product->id;
//            $variation_id=$id;
//        }
//        
//        return array("product-id"=>$product_id, "variation-id"=>$variation_id, "variation"=>$variation);
//    }
    
    public function add_vpc_configuration_to_cart()
    {
        global $woocommerce;
        
        $message="";
        $cart_url = $woocommerce->cart->get_cart_url();
        
        $product_id= $_POST["product_id"];
        $quantity= $_POST["quantity"];
        $recap= $_POST["recap"];
        $alt_products=$_POST["alt_products"];
        if(!is_array($alt_products))
            $alt_products=array();
        
        $ids=  get_product_root_and_variations_ids($product_id);
//        var_dump($ids);
        $newly_added_cart_item_key = $woocommerce->cart->add_to_cart($ids["product-id"], $quantity, $ids["variation-id"], $ids["variation"]);
        do_action("vpc_add_to_cart_main", $ids["product-id"], $quantity, $ids["variation-id"]);
        if (method_exists($woocommerce->cart, "maybe_set_cart_cookies"))
            $woocommerce->cart->maybe_set_cart_cookies();
        if ($newly_added_cart_item_key) {
            if (!isset($_SESSION["vpc-cart-data"][$product_id][$newly_added_cart_item_key]))
                $_SESSION["vpc-cart-data"][$product_id][$newly_added_cart_item_key] = array();
            $_SESSION["vpc-cart-data"][$product_id][$newly_added_cart_item_key][] = $recap;
            
            //Alternate products
            foreach ($alt_products as $alt_product_id)
            {
                $ids=  get_product_root_and_variations_ids($alt_product_id);
                $woocommerce->cart->add_to_cart($ids["product-id"], $quantity, $ids["variation-id"], $ids["variation"]);
                if (method_exists($woocommerce->cart, "maybe_set_cart_cookies"))
                    $woocommerce->cart->maybe_set_cart_cookies();
                do_action("vpc_add_to_cart_alt", $ids["product-id"], $quantity, $ids["variation-id"]);
            }

            $message = "<div class='vpc-success f-right'>" . __("Product successfully added to basket.", "vpc") . " <a href='$cart_url'>View Cart</a></div>";
        } else
            $message = "<div class='vpc-failure f-right'>" . __("A problem occured. Please try again.", "vpc") . "</div>";
        
        echo $message;
        
        die();
    }
    
    public function remove_config_from_cart($cart_item_key) {
        foreach ($_SESSION["vpc-cart-data"] as $variation_id => $recap) {
            if (isset($_SESSION["vpc-cart-data"][$variation_id][$cart_item_key])) {
                unset($_SESSION["vpc-cart-data"][$variation_id][$cart_item_key]);
                if (empty($_SESSION["vpc-cart-data"][$variation_id]))
                    unset($_SESSION["vpc-cart-data"][$variation_id]);
                break;
            }
        }
    }
    
    function get_vpc_data($thumbnail_code, $values, $cart_item_key) {
        if($values["variation_id"])
            $product_id = $values["variation_id"];
        else
            $product_id = $values["product_id"];
        $config=  get_product_config($product_id);

        if (isset($_SESSION["vpc-cart-data"][$product_id][$cart_item_key])) {
            $thumbnail_code.="<br>";
            foreach ($_SESSION["vpc-cart-data"][$product_id][$cart_item_key] as $recap)
            {
                $config_image=$this->get_config_image($recap, $config->settings);
                $formatted_config=$this->get_formatted_config_data($recap, $config->settings);
                $thumbnail_code.=  "<div class='vpc-cart-config o-wrap'>".$config_image."<div class='col xl-2-3'>".$formatted_config."</div></div>";
            }
            
        }
        return $thumbnail_code;
    }
    
    private function get_config_image($recap, $config)
    {
        $output="";
        foreach ($recap as $component=>$raw_options)
        {
            if(is_array($raw_options))
            {
                $options=  implode (", ", $raw_options);
            }
            else
            {
                $options=$raw_options;
                $image=$this->extract_option_field_from_config($raw_options, $component, $config, "image");
                $img_code="";
                if($image)
                {
                    $img_src = wp_get_attachment_url($image);
                    $img_code="<img src='$img_src' data-original-title='$raw_options'>";
                    $output.=$img_code;
                }
            }
        }
        
        return "<div class='vpc-cart-config-image col xl-1-3'>$output</div>";
    }
    
    private function get_formatted_config_data($recap, $config, $show_icons=true)
    {
        $output="<div style='vpc-cart-options-container'>";
        foreach ($recap as $component=>$raw_options)
        {
                $options_arr=$raw_options;
                if(!is_array($raw_options))
                    $options_arr=array($raw_options);
                $options_html="";
                if($show_icons)
                {
                    foreach ($options_arr as $option)
                    {
                        $icon=$this->extract_option_field_from_config($option, $component, $config);
                        $img_code="";
                        if($icon)
                        {
                            $img_src = wp_get_attachment_url($icon);
                            $img_code="<img src='$img_src' data-original-title='$option'>";
                            $options_html.=$img_code;
                        }
                        else
                            $options_html.=$option;
                    }
                }
                else
                    $options_html=  implode (", ", $options_arr);
            
            $output.="<div><strong>$component</strong>: $options_html</div>";
        }
        $output.="</div>";
        
        return $output;
    }
    
    private function extract_option_field_from_config($searched_option, $searched_component, $config, $field="icon")
    {
        foreach ($config["components"] as $i=>$component)
        {
            if($component["cname"]==$searched_component)
            {
                foreach ($component["options"] as $component_option)
                {
                    if($component_option["name"]==$searched_option)
                    {
                        return $component_option[$field];
                    }
                }
            }
        }
        
        return false;
    }
    
    function save_customized_item_meta($item_id, $values, $cart_item_key) {
        if($values["variation_id"])
            $product_id = $values["variation_id"];
        else
            $product_id = $values["product_id"];
        
        if (isset($_SESSION["vpc-cart-data"][$product_id][$cart_item_key])) {
            wc_add_order_item_meta($item_id, 'vpc-cart-data', $_SESSION["vpc-cart-data"][$product_id][$cart_item_key]);
            $original_config=  get_product_config($product_id);
            wc_add_order_item_meta($item_id, 'vpc-original-config', $original_config->settings);
            unset($_SESSION["vpc-cart-data"][$product_id][$cart_item_key]);
        }
    }
    
    function get_user_account_products_meta($output, $item) {
        if(isset($item["vpc-cart-data"]))
        {
            $original_config=  unserialize($item["vpc-original-config"]);
            $output.="<br>";
            $data_arr=  unserialize($item["vpc-cart-data"]);
            foreach ($data_arr as $recap)
            {
                $config_image=$this->get_config_image($recap, $original_config);
                $formatted_config=$this->get_formatted_config_data($recap, $original_config);
                $output.=  "<div class='vpc-cart-config o-wrap'>".$config_image."<div class='col xl-2-3'>".$formatted_config."</div></div>";
            }
        }
        return $output;
    }
    
    function get_admin_products_metas($item_id, $item, $_product)
    {
        $output="";
        if(isset($item["vpc-cart-data"]))
        {
            $original_config=  unserialize($item["vpc-original-config"]);
            $output.="<br>";
            $data_arr=  unserialize($item["vpc-cart-data"]);
            foreach ($data_arr as $recap)
            {
                $config_image=$this->get_config_image($recap, $original_config);
                $formatted_config=$this->get_formatted_config_data($recap, $original_config);
                $output.=  "<div class='vpc-order-config o-wrap xl-gutter-8'>".$config_image."<div class='col xl-2-3'>".$formatted_config."</div></div>";
            }
        }
        echo $output;
    }
    
    private function get_config_price($product_id, $config)
    {
        $original_config=  get_product_config($product_id);
        $total_price=0;
        foreach ($config as $recap)
        {
            foreach ($recap as $component=>$raw_options)
            {
                    $options_arr=$raw_options;
                    if(!is_array($raw_options))
                        $options_arr=array($raw_options);
                    $options_html="";
                    foreach ($options_arr as $option)
                    {
                        $linked_product=$this->extract_option_field_from_config($option, $component, $original_config->settings, "product");
                        $option_price=$this->extract_option_field_from_config($option, $component, $original_config->settings, "price");
                        //We ignore the linked products prices since they're already added in the cart
                        if($linked_product)
                        {
                            $option_price=0;
                        }
                        //We make sure we're not handling any empty priced option
                        if(empty($option_price))
                            $option_price=0;
                        
                        $total_price+=$option_price;
                    }
            }
        }
        
        return $total_price;
    }
    
    function get_cart_item_price($cart) {
            foreach ($cart->cart_contents as $cart_item_key => $cart_item) {
                if($cart_item["variation_id"])
                    $product_id = $cart_item["variation_id"];
                else
                    $product_id = $cart_item["product_id"];

                if (isset($_SESSION["vpc-cart-data"][$product_id][$cart_item_key])) {
                    $a_price=$this->get_config_price($product_id, $_SESSION["vpc-cart-data"][$product_id][$cart_item_key]);
                    $cart_item['data']->price += $a_price;
//                    wc_add_order_item_meta($item_id, 'vpc-cart-data', $_SESSION["vpc-cart-data"][$product_id][$cart_item_key]);
//                    $original_config=  $this->get_product_config($product_id);
//                    wc_add_order_item_meta($item_id, 'vpc-original-config', $original_config->settings);
//                    unset($_SESSION["vpc-cart-data"][$product_id][$cart_item_key]);
                }
//                $variation_id = $cart_item["variation_id"];
//                if (isset($_SESSION["wpc_generated_data"][$variation_id][$cart_item_key])) {
//                    $data = $_SESSION["wpc_generated_data"][$variation_id][$cart_item_key];
//                    $a_price = $this->get_additional_price($variation_id, $data);
//                    $cart_item['data']->price += $a_price;
//                }
//                if (isset($_SESSION["wpc_design_pricing_options"][$cart_item_key]) && !empty($_SESSION["wpc_design_pricing_options"][$cart_item_key])) {
//                    //var_dump('get_cart_item_price');
//                    $a_price = $this->get_design_options_prices($_SESSION["wpc_design_pricing_options"][$cart_item_key]);
//                    $cart_item['data']->price += $a_price;
//                }
            }
        }
        
        public function set_email_order_item_meta($item_id, $item, $order){
            $output="";
            if(is_order_received_page())
                return;
            if(isset($item["vpc-cart-data"]))
            {
                $original_config=  unserialize($item["vpc-original-config"]);
                $output.="<br>";
                $data_arr=  unserialize($item["vpc-cart-data"]);
                foreach ($data_arr as $recap)
                {
//                    $config_image=$this->get_config_image($recap, $original_config);
                    $formatted_config=$this->get_formatted_config_data($recap, $original_config, false);
                    $output.=  "<div class='vpc-order-config o-wrap xl-gutter-8'><div class='col xl-2-3'>".$formatted_config."</div></div>";
                }
            }
            echo $output;
//        	if(isset($item["wvpc_data"]) && !empty($item["wvpc_data"])){
//        		echo "<table>";
//        		$wvpc_data = unserialize($item["wvpc_data"]);
//	        	foreach ($wvpc_data as $key => $value) {
//	        		if ($key != "wvpc_data") {
//	        			echo "<tr><td>$key:</td><td>$value</td></tr>";
//	        		}
//	        	}
//	        	echo "</table>";
//        	}
        		
        }
        
//        function vpc_handle_picture_upload() {
//            $nonce = $_POST['nonce'];
//            if (!wp_verify_nonce($nonce, 'vpc-picture-upload-nonce')) {
//                $busted = __("Cheating huh?", "vpc");
//                die($busted);
//            }
//
//            $upload_dir = wp_upload_dir();
//            $generation_path = $upload_dir["basedir"];
//            $generation_url = $upload_dir["baseurl"];
//            $file_name = uniqid();
////            $options = get_option('wpc-upload-options');
////            $valid_formats = $options['wpc-upl-extensions'];
////            if (!$valid_formats)
//                $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg"/*, "psd", "eps"*/); //wpc-upl-extensions
//
//
//
//
//    //    var_dump($valid_formats);
//            $name = $_FILES['userfile']['name'];
//            $size = $_FILES['userfile']['size'];
//
//            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
//                if (strlen($name)) {
//                    $success = 0;
//                    $message = "";
//                    $img_url = "";
//                    $img_id = uniqid();
//    //                    list($txt, $ext) = explode(".", $name);
//                    $path_parts = pathinfo($name);
//                    $ext = $path_parts['extension'];
//                    if (in_array($ext, $valid_formats)) {
//                        $tmp = $_FILES['userfile']['tmp_name'];
//                        if (move_uploaded_file($tmp, $generation_path . "/" . $file_name . ".$ext")) {
////                            $min_width = $options['wpc-min-upload-width'];
////                            $min_height = $options['wpc-min-upload-height'];
////                            $valid_formats_for_thumb = array("psd", "eps", "pdf");
////                            if (in_array($ext, $valid_formats_for_thumb)) {
////                                //                        $output_thumb=  uniqid().".png";
////                                $thumb_generation_success = $this->generate_adobe_thumb($generation_path, $file_name . ".$ext", $file_name . ".png");
////                                //If the thumb generation is a success, we force the extension to be png so the rest of the code can use it
////                                if ($thumb_generation_success)
////                                    $ext = "png";
////                            }
////                            if ($min_width > 0 || $min_height > 0) {
////                                list($width, $height, $type, $attr) = getimagesize($generation_path . "/" . $file_name . ".$ext");
////                                if (($min_width > $width || $min_height > $height) && $ext != "svg") {
////                                    $success = 0;
////                                    $message = sprintf(__('Uploaded file dimensions: %1$spx x %2$spx, minimum required ', 'vpc'), $width, $height);
////                                    if ($min_width > 0 && $min_height > 0)
////                                        $message.="dimensions: $min_height" . "px" . " x $min_height" . "px";
////                                    else if ($min_width > 0)
////                                        $message.="width: $min_width" . "px";
////                                    else if ($min_height > 0)
////                                        $message.="height: $min_height" . "px";
////                                }
////                                else {
////                                    $success = 1;
////                                    $message = "<span class='clipart-img'><img id='$img_id' src='$generation_url/$file_name.$ext'></span>";
////                                    $img_url = "$generation_url/$file_name.$ext";
////                                }
////                            } else {
//                                $success = 1;
//                                $message = "<span class='clipart-img'><img id='$img_id' src='$generation_url/$file_name.$ext'></span>";
//                                $img_url = "$generation_url/$file_name.$ext";
////                            }
//                            if ($success == 0)
//                                unlink($generation_path . "/" . $file_name . ".$ext");
//                        }
//                        else {
//                            $success = 0;
//                            $message = __('An error occured during the upload. Please try again later', 'vpc');
//                        }
//                    } else {
//                        $success = 0;
//                        $message = __('Incorrect file extension: ' . $ext . '. Allowed extensions: ', 'vpc') . implode(", ", $valid_formats);
//                    }
//                    echo json_encode(
//                            array(
//                                "success" => $success,
//                                "message" => $message,
//                                "img_url" => $img_url,
//                                "img_id" => $img_id,
//                            )
//                    );
//                }
//            }
//            die();
//        }

}
