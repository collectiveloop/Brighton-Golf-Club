<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_product_config($product_id) {
    $ids = get_product_root_and_variations_ids($product_id);
    $config_meta = get_post_meta($ids["product-id"], "vpc-config", true);
    $configs = get_proper_value($config_meta, $product_id, array());
    $config_id = get_proper_value($configs, "config-id", false);

//        $config_meta = get_post_meta($product_id, "vpc-config", true);
//        $config_id=  get_proper_value($config_meta, "config-id");
    if (!$config_id || empty($config_id))
        return false;

    $config_obj = new VPC_Config($config_id);
    return $config_obj;
}

function vpc_get_price_container() {
    if (is_admin())
        return;
    ?>
    <div id="vpc-price-container">
        <span class="vpc-price-label" style="font-weight: normal;color:#768e9d"> <?php _e("Total:", "vpc"); ?> </span>
        <span id="vpc-price"></span>   
    </div>
    <?php
}

function vpc_get_action_buttons_arr($product_id)
{
    $product=  wc_get_product($product_id);
    $product_price=$product->get_price();
    
    $add_to_cart = array(
        "id"=>"vpc-add-to-cart",
        "label"=>__("Add to cart", "vpc"),
        "class"=>"",
        "attributes"=>array(
            "data-pid"=>$product_id,
            "data-price"=>$product_price,
        ),
    );
    
    $cid="";
    if(isset($_GET["cid"]))
        $cid=$_GET["cid"];
    
//    $save = array(
//        "id"=>"vpc-save-config",
//        "label"=>__("Save", "vpc"),
//        "class"=>"",
//        "attributes"=>array(
//            "data-cid"=>$cid,
//        ),
//        "requires_login"=>true,
//        "visible_admin"=>false
//    );
    
    $buttons=array(
//        $save,
        $add_to_cart,
    );
    return apply_filters("vpc_action_buttons", $buttons);
}

function vpc_get_action_buttons($product_id)
{
    if(!$product_id)
        return;
    $buttons=vpc_get_action_buttons_arr($product_id);
    ob_start();
    ?>
    <div class="vpc-action-buttons col xl-2-3">
        <div class="col xl-1-1">
        <?php

        vpc_get_quantity_container();
        
        foreach ($buttons as $button)
        {
            if(!isset($button["requires_login"]))
                $button["requires_login"]=false;
            if(!isset($button["visible_admin"]))
                $button["visible_admin"]=true;
            if(!isset($button["attributes"]))
                $button["attributes"]=array();
            
            if(!is_user_logged_in()&&$button["requires_login"])
                continue;
            else if(is_admin()&&!$button["visible_admin"])
                continue;
            // Custom attribute handling
        $custom_attributes = array();
        
        foreach ($button['attributes'] as $attribute => $attribute_value) {
            $custom_attributes[] = esc_attr($attribute) . '="' . esc_attr($attribute_value) . '"';
        }
        ?>
            <button
                    id="<?php echo esc_attr($button['id']); ?>"
                    class="<?php echo esc_attr($button['class']); ?>"
                    <?php echo implode(' ', $custom_attributes); ?>
                    >
                        <?php echo esc_attr($button["label"]); ?>
            </button>
            
            <?php

        }
        ?>
        </div>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return apply_filters("vpc_action_buttons_html", $output);
}

function vpc_enqueue_core_scripts()
{
    wp_enqueue_script("vpc-public", VPC_URL . 'public/js/vpc-public.js', array('jquery'), false, false);
    wp_localize_script("vpc-public", 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_script('wp-js-hooks', VPC_URL . 'public/js/wp-js-hooks.min.js', array('jquery'), false, false);    
}
function vpc_get_quantity_container() {
    if (is_admin())
        return;
    ?>
    <div id="vpc-qty-container" class="">
        <input type="button" value="-" class="minus">
        <input id="vpc-qty" type="number" step="1" value="1" min="1">
        <input type="button" value="+" class="plus">
    </div>
    <?php
}

function get_product_root_and_variations_ids($id) {
    $product_id = 0;
    $variation_id = 0;
    $variation = array();

    $variable_product = wc_get_product($id);
    if (!$variable_product)
        return false;
//        var_dump($id);
//        $variation = array();
    if ($variable_product->product_type == "simple")
        $product_id = $id;
    else {
        $variation = $variable_product->variation_data;
        $product_id = $variable_product->id;
        $variation_id = $id;
    }

    return array("product-id" => $product_id, "variation-id" => $variation_id, "variation" => $variation);
}

/**
 * reorganige rules
 * @param array $rules_groups
 * @return array
 */
function get_rules_groups_per_option($rules_groups) {
    //var_dump($rules_groups);
    $output = array();
    if (is_array($rules_groups) && !empty($rules_groups)) {
        foreach ($rules_groups as $group_index => $rules) {
            foreach ($rules["rules"] as $rule_index => $rule) {
                if (!isset($output[$rule["option"]]))
                    $output[$rule["option"]] = $group_index;
                else
                    $output[$rule["option"]].=",$group_index";
                //            array_push($output[$rule["option"]], $group_index);
            }
        }
    }
    //var_dump($output);
    return $output;
}

function sort_options_by_group($a, $b) {
    return strcmp($a["group"], $b["group"]);
}

//function get_user_saved_configs($user_id = false) {
//    global $wpdb;
//    $configs_arr = array();
//    if (!$user_id)
//        $user_id = get_current_user_id();
//    $sql = "select umeta_id, meta_value from $wpdb->usermeta where user_id=$user_id and meta_key='vpc-config'";
//    $results = $wpdb->get_results($sql);
//
//    foreach ($results as $config) {
//        $configs_arr[$config->umeta_id] = unserialize($config->meta_value);
//    }
//
//    return $configs_arr;
//}
//
//function get_config_templates($config_id)
//{
//    $args = array(
//                "post_type" => "vpc-template",
//                "nopaging" => true,
//                array(
//                    'key' => "vpc-config",
//                    'value' => '"config-id";s:'.strlen($config_id).':"'.$config_id.'"',
//                    'compare' => "LIKE"
//                )
//            );
//    $templates = get_posts($args);
//    
//    return $templates;
//}

function vpc_get_configuration_url($product_id, $saved_config_id = false, $template_id=false) {
    global $vpc_settings;
    $config_page_id = get_proper_value($vpc_settings, "config-page");
    if (!$config_page_id)
        return false;
    if (function_exists("icl_object_id"))
        $config_page_id = icl_object_id($config_page_id, 'page', false, ICL_LANGUAGE_CODE);

    $design_url = get_permalink($config_page_id);
    if ($product_id) {
//                $query = parse_url($design_url, PHP_URL_QUERY);
        // Returns a string if the URL has parameters or NULL if not
        if (get_option('permalink_structure')) {
            if (substr($design_url, -1) != '/') {
                $design_url .= '/';
            }
            $design_url .= 'configure/' . $product_id . '/';
            if ($saved_config_id)
                $design_url.="?cid=$saved_config_id";
            else if ($template_id)
                $design_url.="?tid=$template_id";
        } else {

            $design_url .= '&vpc-pid=' . $product_id;
            if ($saved_config_id)
                $design_url.="&cid=$saved_config_id";
            else if ($template_id)
                $design_url.="&tid=$template_id";
        }
    }

    return $design_url;
}

function vpc_extract_configuration_images($saved_config, $original_config) {
    $components_by_names = $original_config->get_components_by_name();
    $output = "";
    
    foreach ($saved_config as $saved_component_name => $saved_options) {
        $original_options = $components_by_names[$saved_component_name];
        if (!is_array($saved_options)) {
            $saved_options = array($saved_options);
        }

        foreach ($saved_options as $saved_option) {
            $original_option = get_proper_value($original_options, $saved_option);
            $img_id = get_proper_value($original_option, "image");
            if ($img_id) {
                $img_url = get_media_url($img_id);
                $output.="<img src='$img_url'>";
            }
        }
    }

    return $output;
}

function vpc_get_behaviours()
{
    $behaviours_arr=  apply_filters("vpc_configuration_behaviours", array(
                    "radio"=>__("Single choice", "vpc"),
                    "checkbox"=>__("Multiple choices", "vpc"),                     
                    ));
    
    return $behaviours_arr;
}
