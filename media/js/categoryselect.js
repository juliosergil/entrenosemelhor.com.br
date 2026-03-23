jQuery(document).ready(function($) {

   $('.select-placeholder').click(function(event){
		$('.options-container').toggle();
   });

   $('.selectoption').click(function(event){
   		$(this).find('.optionfilhas').toggle();
   });

   $('.filha').click(function(event){
   		$('#group_id').val($(this).attr('data-id'));
   		$(this).toggleClass('selected');

   		$('.filha').not($(this)).removeClass("selected");

         $('.select-placeholder').html($(this).html());
   });




});