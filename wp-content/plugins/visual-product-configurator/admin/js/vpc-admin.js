(function( $ ) {
	'use strict';
        $(document).ready(function () {
            $("[data-original-title]").tooltip();
            
            $(document).on("change", ".default-config", function (e) {
                $(this).closest(".repeatable-fields-table").find("input[type=radio]").not($(this)).attr('checked',false);
                build_preview();
            });
            
            function build_preview()
            {
                $("#vpc-preview").html("");
                $(".default-config:checked").each(function()
                {
                    var src=$(this).closest(".vpc-option-row").find(".vpc-option-img img").attr("src");
                    if(src)
                        $("#vpc-preview").append("<img src='"+src+"'>");
                });
            }
            
            build_preview();
            
            
                    
            //Activation of conditionnal logic on item
            $(document).on('change', ".wvpc_enable_conditional_logic", function() {
                if($(this).is(':checked')){
                    $(this).parents('.wvpc-conditional-logic-main-container').find(".wvpc-wvpc-conditional-logic-tr").show();
                } else {
                    $(this).parents('.wvpc-conditional-logic-main-container').find(".wvpc-wvpc-conditional-logic-tr").hide();
                }
        });

            $(document).on("change",".wvpc-extraction-group-scope",function(e){
                var selected_scope=$(this).val();
                var apply_on_select = $(this).parent().parent().find('.wvpc-extraction-group-apply_on')
                //var componement_data_for_html_select = wvpc_get_componement_data_for_html_select(global_part);

                if (selected_scope == 'option'){
                    var componement_option_html_select = wvpc_set_select_options(wvpc_cond_rules_data.current_configuration.components, apply_on_select.data('selected_option'));
                    apply_on_select.html(componement_option_html_select);
                }else if (selected_scope == 'component'){
                    var componement_html_select = wvpc_set_select_componement(wvpc_cond_rules_data.current_configuration.components, apply_on_select.data('selected_option'));
                    apply_on_select.html(componement_html_select);
                }
            });

            function wvpc_get_componement_data_for_html_select(global_part){
//                console.log(global_part);
                var componement_data_for_html_select = {};
//                $.each(global_part, function(part_id, part_data){
//                    var option = {};
//                    if(part_data.hasOwnProperty('img_s')){
//
//                        $.each(part_data.img_s, function(index, data){
//                            var img_id = data.img_id;
//                            var img_name = data.img_name;
//                            option[index] = {'option_name': 'wvpc_img_'+part_id+'_'+img_id, 'option_label': img_name}; 
//                        });
//                    }
//                    if(part_data.hasOwnProperty('category')){
//                        $.each(part_data.category,function(category_index, category_data){
//                                if(category_data.hasOwnProperty('img')){
//                                        $.each(category_data.img, function(img_index, img_data){
//                                        var img_id = img_data.img_id;
//                                        var img_name = img_data.img_name
//                                        option[category_index+'_'+img_index] = {'option_name': 'wvpc_img_'+part_id+'_'+img_id, 'option_label': img_name}; 
//                                    });
//                                }
//
//                        });
//
//                    }
//                    componement_data_for_html_select[part_id]= {'group_label' : part_data.name, 'options' : option}
//                });
        //        console.log(componement_data_for_html_select);
                return componement_data_for_html_select;
            }

            //set all options selector
            function wvpc_set_select_options(componement_data_for_html_select, selected_option){
                var html_select = '';
        //        console.log(componement_data_for_html_select);
                if(componement_data_for_html_select != undefined){
//                   console.log(componement_data_for_html_select);
                    $.each(componement_data_for_html_select, function(componement_index, componement_data){
                        if (componement_data.cname !== undefined && componement_data.options !== undefined){
                            html_select += '<optgroup label="'+componement_data.cname+'">';
                            $.each(componement_data.options, function(options_index, options_data){
                                var selected = ' ';
                                var option_value = 'component_'+urlencode(componement_data.cname.replace(/ /g,''))+'_group_'+urlencode(options_data.group.replace(/ /g,''))+'_option_'+urlencode(options_data.name.replace(/ /g,''));
                                if (selected_option != undefined && selected_option == option_value){
                                    selected = 'selected="selected"';
                                }
                                html_select += '<option value="'+option_value+'"  '+selected+'>'+options_data.name+'</option>';
                            });
                            html_select += '</optgroup>';
                        }
                    });
                }
//                console.log(html_select);
                return html_select;
            }

function urlencode(str) {
  //       discuss at: http://phpjs.org/functions/urlencode/
  //      original by: Philip Peterson
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: Brett Zamir (http://brett-zamir.me)
  //      improved by: Lars Fischer
  //         input by: AJ
  //         input by: travc
  //         input by: Brett Zamir (http://brett-zamir.me)
  //         input by: Ratheous
  //      bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Joris
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //             note: This reflects PHP 5.3/6.0+ behavior
  //             note: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
  //             note: pages served as UTF-8
  //        example 1: urlencode('Kevin van Zonneveld!');
  //        returns 1: 'Kevin+van+Zonneveld%21'
  //        example 2: urlencode('http://kevin.vanzonneveld.net/');
  //        returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
  //        example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
  //        returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'

  str = (str + '')
    .toString();

  // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
  // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
  return encodeURIComponent(str)
    .replace(/!/g, '%21')
    .replace(/'/g, '%27')
    .replace(/\(/g, '%28')
    .
  replace(/\)/g, '%29')
    .replace(/\*/g, '%2A')
    .replace(/%20/g, '+');
}


            //set component selector
            function wvpc_set_select_componement(componement_data_for_html_select, selected_option){
                var html_select = '';
                if(componement_data_for_html_select != undefined){
                    $.each(componement_data_for_html_select, function(componement_index, componement_data){
                        if (componement_data.cname !== undefined && componement_data.options !== undefined){
                            //console.log(selected_option)
                            //console.log(componement_data)
                            var selected = ' ';
                            var option_value = 'component_'+urlencode(componement_data.cname.replace(/ /g,''));
                            if (selected_option != undefined && selected_option == option_value){
                                //html_select += '<option value="'+'layer_wrap_'+componement_index+'" selected="selected" >'+componement_data.group_label +'</option>';
                                 selected = 'selected="selected"';
//                            }else{
//                                html_select += '<option value="'+'layer_wrap_'+componement_index+'">'+componement_data.group_label +'</option>';                            
                            }
                            html_select += '<option value="'+option_value+'" '+selected+'>'+componement_data.cname +'</option>';    
                        }
                    });
                }
                return html_select;
            }

            function wvpc_load_conditionnal_rule_panel(){
//                console.log(wvpc_cond_rules_data)
                if ($('.wvpc-conditional-rule-wrap').length > 0) {
                    var conditional_rules = wvpc_cond_rules_data.current_configuration.conditional_rules;
//                    console.log(conditional_rules);
                    //if(conditional_rules && conditional_rules['enable_rules']=='enabled'){
                    if(conditional_rules && conditional_rules.groups != undefined){
                        var html_rules = '';
                        $.each(conditional_rules.groups, function(group_index, group_object){
        //                    group_index = group_index.replace('group_','');
                            var raw_tpl=wvpc_cond_rules_data.wvpc_conditional_rule_tpl;
                            var html_group_rules = '';
                           //console.log(group_object);

                                $.each(group_object.rules, function(rule_index, rule){
        //                            rule_index = rule_index.replace('rule_','');
                                    var tpl2=wvpc_cond_rules_data.wvpc_conditional_rule_tpl.replace(/{rule-index}/g,rule_index);

                                    tpl2 = wvpc_set_new_single_rule(rule_index, group_index, rule, group_object.result);
                                    html_group_rules += tpl2;
                                });
                            var html_rule =  wvpc_cond_rules_data.wvpc_cl_group_container_tpl
                                    .replace(/{rule-group}/g, html_group_rules)
                                    .replace(/{enable-reverse-cb}/g, get_enable_reverse_cb(group_object, group_index));

                            html_rules += set_rules_index(html_rule, group_index);
                        })
                        var wvpc_rules_table = $(".wvpc-rules-table-container").html();
                        wvpc_rules_table = wvpc_rules_table.replace(/{rules-editor}/g,html_rules);
                        $(".wvpc-rules-table-container").html(wvpc_rules_table);

                    }else{
                        var rule_tpl = wvpc_set_new_single_rule(0, 0);
                        rule_tpl = wvpc_cond_rules_data.wvpc_cl_group_container_tpl
                                .replace(/{rule-group}/g, rule_tpl)
                                .replace(/{enable-reverse-cb}/g, get_enable_reverse_cb('', 0));;
                        var wvpc_rules_table = $(".wvpc-rules-table-container").html();
                        wvpc_rules_table = wvpc_rules_table.replace(/{rules-editor}/g,rule_tpl);
                        $(".wvpc-rules-table-container").html(wvpc_rules_table);
                    }
                    wvpc_update_rowspan();
                };
            }
            wvpc_load_conditionnal_rule_panel();

            function set_rules_index(html, group_index, rule_index){
                if (html){
                    if( group_index != undefined ){
                        html = html.replace(/{rule-group-index}/g,group_index);
                    }
                    if( rule_index != undefined ){
                        html = html.replace(/{rule-index}/g, rule_index);
                    }
                }

                return html;
            }

            function wvpc_reload_conditionnal_rule_panel(){
                var componement_data_for_html_select = wvpc_get_componement_data_for_html_select(global_part);
                $('.wvpc-extraction-group-option').each(function(){
                    var componement_option_html_select = wvpc_set_select_options(wvpc_cond_rules_data.current_configuration.components, $(this).val()); 
                    $(this).html(componement_option_html_select);
                });

                $('.wvpc-extraction-group-apply_on').each(function(){
                    var scope = $(this).parents('.wvpc-rules-table-tr').find('.wvpc-extraction-group-scope').val();
                    if (scope == 'option'){
                        var componement_option_html_select = wvpc_set_select_options(wvpc_cond_rules_data.current_configuration.components, $(this).val()); 
                        $(this).html(componement_option_html_select);
                    }else if (scope == 'component') {
                        var componement_apply_on_html_select = wvpc_set_select_componement(wvpc_cond_rules_data.current_configuration.components, $(this).val());
                        $(this).html(componement_apply_on_html_select);
                    };

                });
                wvpc_update_rowspan();
            }

            function wvpc_set_html_select(select_name, select_id,  select_class, opt_list, selected_opt){
                //console.log(selected_opt);
                var html_select = '<select name="'+select_name+'" id="'+select_id+'" class="'+select_class+'">';
                $.each(opt_list, function(opt_name, opt_label){
                    if ( opt_name == selected_opt){
                            html_select +=  '<option value="'+opt_name+'"  selected="selected" >'+opt_label+'</option>'
                    }else{
                        html_select +=  '<option value="'+opt_name+'">'+opt_label+'</option>'
                    }   
                });
                html_select += '</select>';
                return html_select;
            }

            function wvpc_update_rowspan(){
                $.each($('.wvpc-shared-td'), function(index, shared_td) {
                    var rowspan = $(shared_td).parents('table.wvpc-rules-table').find('tr').length;
                    $(shared_td).attr('rowspan', rowspan);
                });
            }
            //Add single rule to item
            function wvpc_set_new_single_rule(new_rule_index, group_index, rules, group_result){
                //console.log(new_rule_index)
                //console.log(rules['apply_on']);
        //        console.log(group_result);
                var raw_tpl="";
                if (new_rule_index == 0 ) {
                    raw_tpl=wvpc_cond_rules_data.wvpc_conditional_rule_tpl_first_row;
                }else{
        //            console.log(wvpc_cond_rules_data.wvpc_conditional_rule_tpl);
                    raw_tpl=wvpc_cond_rules_data.wvpc_conditional_rule_tpl;
                }

                var trigger_select = wvpc_set_html_select("vpc-config[conditional_rules][groups][{rule-group-index}][rules][{rule-index}][trigger]","wvpc-group_{rule-group-index}_rule_{rule-index}_trigger", "select wvpc-extraction-group-trigger",wvpc_cond_rules_data.wvpc_cl_trigger, (rules)?rules['trigger']:"")
                //ToDo: updtate the lines bellow to the new struct
                //var global_part = ;
                var componement_data_for_html_select = wvpc_get_componement_data_for_html_select(wvpc_cond_rules_data.current_configuration);
                var componement_option_html_select = wvpc_set_select_options(wvpc_cond_rules_data.current_configuration.components, (rules)?rules['option']:"");
                var componement_scope_html_select = wvpc_set_html_select("vpc-config[conditional_rules][groups][{rule-group-index}][result][scope]", "wvpc-group_{rule-group-index}_rule_{rule-index}_scope",  "select wvpc-extraction-group-scope",wvpc_cond_rules_data.wvpc_cl_scope, (group_result)?group_result['scope']:"")

                var componement_apply_on_html_select = "";
                if (rules && group_result['scope'] && group_result['scope'] == 'component'){
                    componement_apply_on_html_select = wvpc_set_select_componement(wvpc_cond_rules_data.current_configuration.components, (group_result)?group_result['apply_on']:"");
                }else{
                    componement_apply_on_html_select = wvpc_set_select_options(wvpc_cond_rules_data.current_configuration.components, (group_result)?group_result['apply_on']:"");
                }
                var componement_action_html_select = wvpc_set_html_select("vpc-config[conditional_rules][groups][{rule-group-index}][result][action]", "wvpc-group_{rule-group-index}_rule_{rule-index}_action",  "select wvpc-extraction-group-action", wvpc_cond_rules_data.wvpc_cl_action, (group_result)?group_result['action']:"");
                var tpl2 = raw_tpl.replace(/{wvpc-extraction-group-trigger}/g,trigger_select);
        //        console.log(componement_option_html_select)
                tpl2 = tpl2.replace(/{wvpc-extraction-group-option}/g,componement_option_html_select);
                tpl2 = tpl2.replace(/{wvpc-extraction-group-scope}/g,componement_scope_html_select);
                tpl2 = tpl2.replace(/{wvpc-extraction-group-action}/g,componement_action_html_select);
                tpl2 = tpl2.replace(/{wvpc-extraction-group-apply_on}/g,componement_apply_on_html_select);

                tpl2 = set_rules_index(tpl2, group_index, new_rule_index);
                //tpl2=tpl2.replace(/{rule-group-index}/g,group_index);
                //tpl2=tpl2.replace(/{rule-index}/g,new_rule_index);
                return tpl2;

            }
            
            
            function get_enable_reverse_cb(rules, group_index){
                var is_checked = '';
                //console.log(rules)
                if(rules.apply_reverse == 'on'){
                    is_checked = 'checked="checked"';
                }

                var enable_reverse_cb = '<div class="enable-reverse"><label for=""><input type="checkbox" name="vpc-config[conditional_rules][groups][{rule-group-index}][apply_reverse]" '+is_checked+' />'+string_translations.reverse_cb_label+'</label> </div>';

                return set_rules_index(enable_reverse_cb, group_index);
            }
            
            $(document).on("click",".wvpc-add-rule",function(e)
            {
                var new_rule_index=$(".wvpc-rules-table tr").length;
                var group_index=$(this).data("group");

                var tpl2 = wvpc_set_new_single_rule(new_rule_index, group_index);
                $(this).parents(".wvpc-rules-table").find("tbody").append(tpl2);
                wvpc_update_rowspan();
            });

            //Add group rule to item
            $(document).on("click",".wvpc-add-group",function(e)
            {
                var new_rule_index=0;
                var group_index=$(".wvpc-rules-table").length;
                var tpl2 = wvpc_set_new_single_rule(new_rule_index, group_index);
                var enable_reverse_cb = get_enable_reverse_cb('', group_index);
                var html = wvpc_cond_rules_data.wvpc_cl_group_container_tpl.replace(/{rule-group}/g, tpl2);
                html = html.replace(/{enable-reverse-cb}/g, enable_reverse_cb);
                html = html.replace(/{rule-group-index}/g,group_index);
                html = html.replace(/{rule-index}/g,new_rule_index);
                $(".wvpc-rules-table-container").append(html);
                //wvpc_load_conditionnal_rule_panel();
            });

            //Fix the selected value for a rule while loading for edition
            $(".wvpc-rules-table td.value select[data-selected]").each(function(){ 
                var selected=$(this).data("selected");
                $(this).val(selected);
            });
            
            //Remove rule
            $(document).on("click",".wvpc-remove-rule",function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
            });
            
            $(".vpc-config-skin").change(function()
            {
                var selected_skin=$(this).val();
                var component_skins=vpc_components_skins[selected_skin];
                $(".vpc-behaviour").html(component_skins);
            });


        });

})( jQuery );
