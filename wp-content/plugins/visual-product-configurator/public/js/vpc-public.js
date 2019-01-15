var VPC_CONFIG = (function ($, vpc_config) {
    'use strict';
    $(document).ready(function () {
        
        window.build_preview = function()
        {
            $("#vpc-preview").html("");
            var total_price = $("#vpc-add-to-cart").data("price");
            if(!total_price)
                total_price=0;
            $(wvpc_data.vpc_selected_items_selector).each(function ()
            {
                var src = $(this).data("img");
                var option_price = $(this).data("price");
//                console.log(option_price);
                if(option_price)
                    total_price += parseFloat(option_price);
                if (src)
                    $("#vpc-preview").append("<img src='" + src + "'>");
            });

            $.post(
                    ajax_object.ajax_url,
                    {
                        action: "get_design_price",
                        total_price: total_price,
                    },
                    function (data) {
                        $("#vpc-price").html(data);
                    });
        }
        
        window.wvpc_apply_rules = function()
        {
            var selector = ".vpc-options input[data-rulesgroup]";
            var check_selections = false;
            $(selector).each(function (i, e)
            {
//                console.log("checking group");
                var groups_indexes = $(this).data("rulesgroup");
                var groups_arr;

                //Option part of multiple groups
                if (typeof groups_indexes == "string")
                    groups_arr = groups_indexes.split(",");
                //Option part of single group
                else if (typeof groups_indexes == "number")
                    groups_arr = [groups_indexes];
                $.each(groups_arr, function (e, i)
                {
                    var rules_groups = wvpc_data.wvpc_conditional_rules[i];
                    var group_verified = true;
                    $.each(rules_groups.rules, function (rule_index, rule)
                    {
//                        console.log(rule.option);
                        var is_selected = $(".vpc-options input[data-oid='" + rule.option + "']").attr('checked') == "checked";
                        if (rule.trigger == "on_selection" && !is_selected)
                        {
                            group_verified = false;
                            return false;
                        }
                        else if (rule.trigger == "on_deselection" && is_selected)
                        {
                            group_verified = false;
                            return false;
                        }

                    });

                    //If all rules of the group are true
                    if (group_verified)
                    {
                        //We make sure that the group action has not been applied yet before applying it to avoid infinite loops
                        if (rules_groups.result.action == "hide")
                        {
                            check_selections = true;
                            hide_options_or_component(rules_groups);
                        }
                        else if (rules_groups.result.action == "show")
                        {
                            check_selections = true;
                            show_options_or_component(rules_groups);
                        }
                    } else if (rules_groups.apply_reverse == "on") {
//                         console.log('apply reverse')
                        if (rules_groups.result.action == "hide")
                        {
                            check_selections = true;
                            show_options_or_component(rules_groups)


                        }
                        else if (rules_groups.result.action == "show" && $("#" + rules_groups.result.apply_on).not("[style*='display: none;']").length)
                        {
                            check_selections = true;
                            hide_options_or_component(rules_groups);
                        }
                    }

                });
            });
            if (check_selections)
                build_preview();
        }
//
        $(document).on('click', '#vpc-qty-container .plus, #vpc-qty-container .minus', function () {

            // Get values
            var $qty = $("#vpc-qty");
            var currentVal = parseFloat($qty.val());
            var max = parseFloat($qty.attr('max'));
            var min = parseFloat($qty.attr('min'));
            var step = $qty.attr('step');

            // Format values
            if (!currentVal || currentVal === '' || currentVal === 'NaN')
                currentVal = 0;
            if (max === '' || max === 'NaN')
                max = '';
            if (min === '' || min === 'NaN')
                min = 0;
            if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
                step = 1;

            // Change the value
            if ($(this).is('.plus')) {

                if (max && (max == currentVal || currentVal > max)) {
                    $qty.val(max);
                } else {
                    $qty.val(currentVal + parseFloat(step));
                }

            } else {

                if (min && (min == currentVal || currentVal < min)) {
                    $qty.val(min);
                } else if (currentVal > 0) {
                    $qty.val(currentVal - parseFloat(step));
                }

            }

            // Trigger change event
//            $qty.trigger('change');
        });
//
        $("#vpc-add-to-cart").click(function (e)
        {
            var product_id = $(this).data("pid");
            var alt_products = [];
            $('#vpc-container input:checked').each(function (i)
            {
                if ($(this).data("product"))
                    alt_products.push($(this).data("product"));
            });

//            console.log(alt_products);
            var quantity = $("#vpc-qty").val();
            var recap = $('#vpc-container').find(':input').serializeJSON();//.serializeJSON();
//            console.log(product_id);
//            console.log(alt_products);
//            console.log(quantity);
//            console.log(recap);

            $.post(
                    ajax_object.ajax_url,
                    {
                        action: "add_vpc_configuration_to_cart",
                        product_id: product_id,
                        alt_products: alt_products,
                        quantity: quantity,
                        recap: recap
                    },
            function (data) {
                $("#debug").html(data);
                switch (wvpc_data.action_after_add_to_cart)
                {
                    case 'refresh':
                        setTimeout(function () {
                            window.location.reload(true);
                        }, 3000);
                        break;
                    case 'redirect':
                        window.location.href = wvpc_data.cart_url;
                        break;
                    case 'redirect_to_product_page':
                        window.location.href = wvpc_data.current_product_page;
                        break;
                    default:
                        break;
                }
            });
        });

        $("#vpc-save-config").click(function (e)
        {
            var product_id = $("#vpc-add-to-cart").data("pid");
//            var alt_products = [];
//            $('#vpc-container input:checked').each(function (i)
//            {
//                if($(this).data("product"))
//                    alt_products.push($(this).data("product"));
//            });

//            console.log(alt_products);
//            var quantity = $("#vpc-qty").val();
            var recap = $('#vpc-container').find(':input').serializeJSON();
            var name = prompt("Please enter the configuration name");
            var loaded_config = $(this).data("cid");
            if (name)
            {
                $.post(
                        ajax_object.ajax_url,
                        {
                            action: "save_vpc_config",
                            name: name,
                            product_id: product_id,
                            loaded_config: loaded_config,
                            config: recap
                        },
                function (data) {
//                            $("#debug").html(data);
                    location.reload();
                });
            }
            else
                alert("The name field is mandatory.");
        });
//        
        $(".vpc-delete-config").click(function (e)
        {
            if (confirm("Are you sure you want to delete this configuration?"))
            {
                var config_id = $(this).data("id");
                $.post(
                        ajax_object.ajax_url,
                        {
                            action: "delete_vpc_config",
                            config_id: config_id,
                        },
                        function (data) {
                            location.reload();
                        });
            }

        });
//        
        $( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) {
            // Fired when the user selects all the required dropdowns / attributes
            // and a final variation is selected / shown
            var variation_id = $("input[name='variation_id']").val();
            if (variation_id)
            {
                $(".vpc-configure-button").hide();
                $(".vpc-configure-button[data-id='"+variation_id+"']").show();
            }
        } );
        
        function hide_options_or_component(rules_groups) {
            //Check the scoop and apply the rule if it is required
            if (rules_groups.result.scope == "component" && ($("#vpc-container div.vpc-component[data-component_id=" + rules_groups.result.apply_on + "]").not("[style*='display: none;']").length))
            {
                $("#vpc-container div.vpc-component[data-component_id=" + rules_groups.result.apply_on + "]").hide();
                $("#vpc-container div.vpc-component[data-component_id=" + rules_groups.result.apply_on + "]").find('input:checked').removeAttr('checked').trigger('change');
            } else if (rules_groups.result.scope == "option" && $(".vpc-options div[data-oid='" + rules_groups.result.apply_on + "']").not("[style*='display: none;']").length) {
                $(".vpc-options div[data-oid='" + rules_groups.result.apply_on + "']").hide();
                $(".vpc-options div[data-oid='" + rules_groups.result.apply_on + "'] input:checked").removeAttr('checked').trigger('change');
            }
        }

        function show_options_or_component(rules_groups) {
            //Check the scoop and apply the rule if it is required
            if (rules_groups.result.scope == "component" && $("#vpc-container div.vpc-component[data-component_id='" + rules_groups.result.apply_on + "'][style*='display: none;']").length)
            {
                $("#vpc-container div.vpc-component[data-component_id=" + rules_groups.result.apply_on + "]").show();
                $("#vpc-container div.vpc-component[data-component_id=" + rules_groups.result.apply_on + "]").find(".vpc-options input").first().click();
            } else if (rules_groups.result.scope == "option" && $(".vpc-options div[data-oid='" + rules_groups.result.apply_on + "'][style*='display: none;']").length) {
                $(".vpc-options div[data-oid='" + rules_groups.result.apply_on + "']").show();
            }
        }
    });
    return vpc_config;
}(jQuery, VPC_CONFIG));