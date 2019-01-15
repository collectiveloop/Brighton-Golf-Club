<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-mb-confog
 *
 * @author HL
 */
class VPC_Default_Skin {

    public $product;
    public $product_id;
    public $settings;
    public $config;

    public function __construct($product_id=false, $config=false) {
        if ($product_id)
        {
            $this->product = new WC_Product( $product_id );
            $this->product_id=$product_id;
            $this->config=  get_product_config($product_id);
        }
        else if($config)
        {
            $this->config=new VPC_Config($config);
        }
    }
    
    public function display($config_to_load=array()) {
        $this->enqueue_styles_scripts();
        
        ob_start();
        global $woocommerce;
        if($this->product)
        {
            $product = $this->product;
            $product_price=$product->get_price();
        }
        else
            $product_price="";
        
        if(!$this->config||empty($this->config))
            return __("No valid configuration linked to this product.", "vpc");
        
        $skin_name=  get_class($this);
        
        $config=  $this->config->settings;
        $rules_structure=  get_proper_value($config, "conditional_rules", array());
        
        $options_style="";
        $components_aspect=  get_proper_value($config, "components-aspect", "closed");
        if($components_aspect=="closed")
            $options_style="display: none";
        
        $rules_enabled=  get_proper_value($rules_structure, "enable_rules", false);        
        global $vpc_settings;
        $action_after_add_to_cart = get_proper_value($vpc_settings, "action-after-add-to-cart", "Yes");
        $wvpc_conditional_rules = array();
        $reorganized_rules=false;
        if($rules_enabled=="enabled")
        {
            
            $rules_groups=  get_proper_value($rules_structure, "groups", array());
            $reorganized_rules=  get_rules_groups_per_option($rules_groups);
            $wvpc_conditional_rules = (!empty($rules_groups))?$rules_groups:array();
            
        }
        
        if(is_admin())
        {
            $cart_url="";
            $product_url="";
        }
        else
        {
            $cart_url=$woocommerce->cart->get_cart_url();//Déclenche une erreur lorsqu'utilisée dans l'interface de conception d'un template
            $product_url=get_permalink($product->id);
        }
        
        
        $wvpc_editor_data = array(
            'action_after_add_to_cart' =>$action_after_add_to_cart,
            'wvpc_conditional_rules' =>$wvpc_conditional_rules,
            'cart_url' => $cart_url,
            'current_product_page' => $product_url,
            'vpc_selected_items_selector' => apply_filters("vpc_selected_items_selector", ".vpc-options input:checked"),
        );
            ?>
            <script>
            var wvpc_data = <?php echo json_encode($wvpc_editor_data) ?>
            </script>
            <?php
        
        ?>
        <div id="vpc-container" class="o-wrap <?php echo $skin_name;?>">
            <div class="col xl-1-3" id="vpc-components">
                <?php
                foreach ($config["components"] as $component_index=>$component) {
                    $this->get_components_block($component, $options_style, $reorganized_rules, $config_to_load);
                }
                        ?>
            </div>
            <div class="col xl-2-3">
                <?php vpc_get_price_container();?>
                <div id="vpc-preview">

                </div>
            </div>
        </div>
        <div id="debug"></div>
        <?php
        
        echo vpc_get_action_buttons($this->product_id);
        
//        if(!is_admin())
//        {
//            $this->get_user_saved_configs_block ();
//            $this->get_predesigned_configs_block ();
//        }
        
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    private function get_components_block($component, $options_style, $reorganized_rules, $config_to_load = array()) {
        $skin_name= get_class($this);
        $c_icon = "";
        $options = $component["options"];
        if ($options)
            usort($options, "sort_options_by_group");
        $component_id="component_".urlencode(str_replace(' ', '', $component["cname"]));
        
        //We make sure we have an usable behaviour
        $handlable_behaviours=vpc_get_behaviours();
//        var_dump($handlable_behaviours);
        if(!isset($handlable_behaviours[$component["behaviour"]]))
                $component["behaviour"]="radio";

        if ($component["cimage"])
            $c_icon = "<img src='" . wp_get_attachment_url($component["cimage"]) . "'>";
        
        $components_attributes_string=  apply_filters("vpc_component_attributes", "data-component_id = '$component_id'", $this->product_id, $component);
        ?>
        <div class="vpc-component" <?php echo $components_attributes_string ?>>

            <div class="vpc-component-header">
                <?php
                echo "$c_icon<span style='display: inline-block;'><span>" . $component["cname"] . "</span>";
                ?>

                <span class="vpc-selected txt"><?php _e('none', 'vpc'); ?></span></span>
                <span class="vpc-selected-icon"><img width="24" src="" alt="..."></span>

            </div>
            <div class="vpc-options" style="<?php echo $options_style; ?>">
                <?php
                do_action('vpc_' . $component["behaviour"]."_begin", $component, $skin_name);
                
                $current_group = "";
                foreach ($options as $option_index => $option) {
                    if (
                            ($option["group"] && $option["group"] != $current_group) || ($option_index == 0 && $option["group"])) {
                        if ($option["group"] != $current_group && $current_group)
                            echo "</div>";
                        echo "<div class='vpc-group'><div class='vpc-group-name'>" . $option["group"] . "</div>"; //."</div>";// . "<br>";
                    }
                    $o_image = "";
                    if ($option["image"])
                        $o_image = wp_get_attachment_url($option["image"]);

                    $o_icon = "";
                    if ($option["icon"])
                        $o_icon = wp_get_attachment_url($option["icon"]);

                    $o_name = $component["cname"];


                    $input_id = uniqid();
                    $label_id = "cb$input_id";

                    $checked = "";
                    if ($config_to_load && isset($config_to_load[$component["cname"]])) {
                        $saved_options = $config_to_load[$component["cname"]];
                        if ((is_array($saved_options) && in_array($option["name"], $saved_options)) || ($option["name"] == $saved_options)
                        )
                            $checked = "checked='checked'";
                    }
                    else if (isset($option["default"]) && $option["default"] == 1)
                        $checked = "checked='checked'";

                    $data_rulesgroup = "";

                    $price = get_proper_value($option, "price", 0);
                    $linked_product = get_proper_value($option, "product", false);
                    if ($linked_product) {
                        $product = new WC_Product($linked_product);
                        if(!$product->is_purchasable())
                            continue;
                        $price = $product->get_price();
                    }
                    $formated_price_raw = wc_price($price);
                    $formated_price = strip_tags($formated_price_raw);
                    $option_id="component_".urlencode(str_replace(' ', '', $component["cname"]))."_group_".urlencode(str_replace(' ', '', $option["group"]))."_option_".urlencode(str_replace(' ', '', $option["name"]));
                    if (isset($reorganized_rules[$option_id]))
                        $data_rulesgroup = "data-rulesgroup='" . $reorganized_rules[$option_id] . "'";

                    switch ($component["behaviour"]) {
                        case 'radio':
                        case 'checkbox':
                            $input_type = "radio";
                            if ($component["behaviour"] == "checkbox") {
                                $o_name.="[]";
                                $input_type = "checkbox";
                            }
                            
                            $tooltip=$option["name"];
                            if ($price)
                                $tooltip.=" (+$formated_price)";
                            ?>
                            <div class="vpc-single-option-wrap" data-oid="<?php echo $option_id; ?>" >
                                <input id="<?php echo $input_id; ?>" type="<?php echo $input_type; ?>" name="<?php echo $o_name; ?>" value="<?php echo $option["name"]; ?>" data-img="<?php echo $o_image; ?>" data-price="<?php echo $price; ?>" data-product="<?php echo $option["product"]; ?>" data-oid="<?php echo $option_id; ?>" <?php echo $checked; ?>  <?php echo $data_rulesgroup; ?>>
                                <label id="<?php echo $label_id; ?>" for="<?php echo $input_id; ?>" data-original-title="<?php echo $tooltip; ?>" class="custom"></label>
                                <style>
                                    #<?php echo $label_id; ?>:before
                                    {
                                        background-image: url("<?php echo $o_icon; ?>");
                                    }
                                </style>
                            </div>
                            <?php
                            break;
                        default:
//                            do_action('vpc_'.$skin_name.'_' . $component["behaviour"], $component);
                            do_action('vpc_' . $component["behaviour"], $option, $o_image, $price, $option_id, $data_rulesgroup, $component, $skin_name);
                            break;
                    }
                    if ($option["group"] && $option_index == count($options) - 1) {
                        echo "</div>";
                    }
                    $current_group = $option["group"];
                }
                do_action('vpc_' . $component["behaviour"]."_end", $component, $skin_name);
                ?>
            </div>
        </div>
        <?php
    }

    private function get_user_saved_configs_block() {
        if (!is_user_logged_in())
            return;

        $saved_configs = get_user_saved_configs();
        if (empty($saved_configs))
            return;
        ?>
        <div class="o-wrap col">
            <h3><?php _e("Saved designs", "vpc"); ?></h3>
        </div>
        <div class="o-wrap xl-gutter-8 user">

            <?php
            foreach ($saved_configs as $config_id => $config) {
                if (!$config[0])
                    $config[0] = __("No name", "vpc");
                
                $pid = $config[1];

                $url = vpc_get_configuration_url($pid, $config_id);
                $original_config = get_product_config($pid);
                ?>

                <div class="col xl-1-7" data-id="<?php echo $config_id; ?>">
                    <a href="<?php echo $url; ?>">
                        <div class="saved-config-preview">
                            <?php echo vpc_extract_configuration_images($config[2], $original_config); ?>

                        </div>
                        <div class="vpc-saved-config-name"><?php echo $config[0]; ?></div>
                    </a>
                    <button class="vpc-delete-config" data-id="<?php echo $config_id; ?>"><?php _e("Delete", "vpc"); ?></button>
                </div>

                <?php
            }
            ?>
        </div>
        <?php
    }
    
    private function get_predesigned_configs_block() {
        $config_templates = get_config_templates($this->config->id);
        if (empty($config_templates))
            return;
        
        ?>
        <div class="col">
            <h3><?php _e("Design Ideas", "vpc"); ?></h3>
        </div>
        <div class="o-wrap xl-gutter-8 user">
            <?php
            foreach ($config_templates as $template) {
                $meta = get_post_meta($template->ID, "vpc-config", true);
                $to_load_str=  get_proper_value($meta, "recap");
                $to_load=json_decode($to_load_str, true);

                $url = vpc_get_configuration_url($this->product_id, false, $template->ID);
                $original_config = get_product_config($this->product_id);
                ?>

                <div class="col xl-1-7" data-id="<?php echo $this->config->id; ?>">
                    <a href="<?php echo $url; ?>">
                        <div class="saved-config-preview">
                            <?php echo vpc_extract_configuration_images($to_load, $original_config); ?>

                        </div>
                        <div class="vpc-saved-config-name"><?php echo $template->post_title; ?></div>
                    </a>
                </div>

                <?php
            }
            ?>
        </div>
        <?php
    }
    
    private function enqueue_styles_scripts()
    {
        if(is_admin())
            vpc_enqueue_core_scripts ();
        wp_enqueue_style("vpc-default-skin", VPC_URL . 'public/css/vpc-default-skin.css', array(), false, 'all');
        wp_enqueue_style("o-flexgrid", VPC_URL . 'admin/css/flexiblegs.css', array(), false, 'all');
        wp_enqueue_style("FontAwesome", VPC_URL . 'public/css/font-awesome.min.css', array(), false, 'all');
        wp_enqueue_style("o-tooltip", VPC_URL . 'public/css/tooltip.min.css', array(), false, 'all');
        
        wp_enqueue_script("o-tooltip", VPC_URL . 'public/js/tooltip.min.js', array('jquery'), false, false);
        wp_enqueue_script("vpc-default-skin", VPC_URL . 'public/js/vpc-default-skin.js', array('jquery'), false, false);
        wp_localize_script("vpc-default-skin", 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
        wp_enqueue_script("o-serializejson", VPC_URL . 'public/js/jquery.serializejson.min.js', array('jquery'), false, false);
        
        
    }

}