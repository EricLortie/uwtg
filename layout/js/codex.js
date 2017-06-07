jQuery(document).on('ready', function(){


    jQuery('.spell_expander').on('click', function(){
      jQuery('#spell_info').html(jQuery(this).siblings('.spell_info').html())
      jQuery('#spell_modal').modal();
    });

});
