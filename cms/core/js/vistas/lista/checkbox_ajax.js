
$(document).ready(function() {

    $('.js-checkbox-ajax').click(function(){

        var id_item   = $(this).parents('tr').first().data('id');
        var key_campo = $(this).parents('td').first().data('key');
        var $fa       = $(this).find('.fa');

        $.ajax({
            type: 'get',
            url: DOCUMENT_ROOT + CONTROLLER +'/actualizarCheckbox/'+ id_item +'/'+ key_campo,
            beforeSend: function() {
                console.log('Actualizando...');
            },
            complete: function() {

                $fa.toggleClass('fa-check-square-o');
                $fa.toggleClass('fa-square-o');

                console.log('Actualizado!');
            },
        });

        return false;
    });

});