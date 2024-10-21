/**
 * Add Select Childs WooCommerce Single Product
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * Init max Qty
         *
         * @return {void}
         */
        function childs_single_product__init_max_qty(){
             $('body.single-product input.qty').attr('max',CHILDS.count);
        }

        /**
         * Controle QTY
         *
         * @return {int}
         */
        function childs_single_product__controle_qty(){

            //init
            let qty = parseInt($('body.single-product input.qty').val(),10);
            let childsCount = parseInt(CHILDS.count,10);

            //Limite Max Qty
            if(qty > childsCount){
                $('body.single-product input.qty').val(childsCount);
                qty = childsCount;
            }
            //Limite Qty Negative
            if(Number(qty) < 0){
                $('body.single-product input.qty').val(1);
                qty = 1;
            }

            return qty;
        }

        /**
         * Add Select Child
         *
         * @return {void}
         */
        function childs_single_product__addRemove_select(){

            //init
            let selectChildHtml = $('.single-product-childs').find('.single-product-childs__item').first().prop('outerHTML');
            let countSelectChild = $('.single-product-childs').children().length;
            let qty = childs_single_product__controle_qty();

            //Add || Remove select
            if(qty > countSelectChild){
                let numberAddSelect = qty - countSelectChild;
                let regex = new RegExp('childs\\[0\\]', 'g');
                let regex2 = new RegExp('<span class="number">1<\\/span>', 'g');
                for(let i = 0; i < numberAddSelect; i++){
                    let updatedHtml = selectChildHtml
                        .replace(regex, "childs[" + countSelectChild + "]")
                        .replace(regex2, '<span class="number">' + (countSelectChild+1) + '</span>');
                    $('.single-product-childs').append(updatedHtml);
                    countSelectChild++;
                }
            }else{
                let numberRemoveSelect = countSelectChild - qty;
                if(numberRemoveSelect>0){
                    $('.single-product-childs').children().slice(-numberRemoveSelect).remove();
                }
            }
        }

        /**
         * Events
         */
        childs_single_product__init_max_qty();
        $("body.single-product").on("change", "input.qty", function(event) {
            childs_single_product__addRemove_select();
        });

    });
}(jQuery));
