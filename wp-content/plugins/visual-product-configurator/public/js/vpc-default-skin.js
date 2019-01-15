var VPC_CONFIG = (function ($, vpc_config) {
    'use strict';
    $(document).ready(function () {
        $("[data-original-title]").tooltip();

        $(document).on("change", ".vpc-options input", function (event) {
            //e.preventDefault();
            wp.hooks.doAction('vpc.option_change', $(this), event);
            build_preview();
            wvpc_apply_rules();
            $(this).parents('.vpc-component').find('.vpc-selected-icon img').attr('src', $(this).data('img'));
            $(this).parents('.vpc-component').find('.vpc-selected').html($(this).attr('value'));
        });
        
        function load_options() {
            $('.vpc-options :input').each(function () {
                $(this).trigger('change');
            });
        }

        $('.vpc-component-header').click(function () {
            $(this).parents('.vpc-component').find('.vpc-options').slideToggle('fast');
        });

        load_options();
    });

    return vpc_config;
}(jQuery, VPC_CONFIG));