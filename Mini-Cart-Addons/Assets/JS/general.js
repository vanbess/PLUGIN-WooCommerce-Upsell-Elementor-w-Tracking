jQuery(document).ready(function ($) {

    // ***************************************************************
    // retrieve variation img src/variation id on load/dropdown change
    // ***************************************************************
    setTimeout(() => {
        $('.upsell-v2-minicart-addon-inner-table.variable').each(function () {

            // retrieve json object
            var json = $(this).data('variations');
            var selected = $(this).find('.upsell-v2-minicart-addon-variable-product-variation-select').val();
            var variation_id = json[selected]['variation_id'];

            // console.log(variation_id);

            // set correct variation id
            $(this).parents('.upsell-v2-minicart-addon-table').find('.upsell-v2-minicart-addon-atc').attr('data-variation-id', variation_id);

        });
    }, 1000);

    // *****************************
    // variation dropdown on change
    // *****************************
    $(document).on('change', '.upsell-v2-minicart-addon-variable-product-variation-select', function () {

        console.log('changed');
        

        // retrieve json object
        var json = $(this).parents('.upsell-v2-minicart-addon-table').find('.upsell-v2-minicart-addon-inner-table.variable').data('variations');
        console.log(json);
        
        var selected = $(this).val();
        var variation_id = json[selected]['variation_id'];

        // console.log(variation_id);

        // set correct variation id
        $(this).parents('.upsell-v2-minicart-addon-table').find('.upsell-v2-minicart-addon-atc').attr('data-variation-id', variation_id);

    });

});
