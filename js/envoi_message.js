$(function(){

	// quand send est cliqué on envoi une data, qui correspond à l'id du destinataire + redirection vers traitement en PHP

	$(document).off('click','#send').on('click', '#send', function(){
		var message = $('#msg').val();
		var get_id   = $(this).data('user');
		console.log(get_id);
		$.post('http://localhost/social-network/php/chat.php', {sendMessage:message,get_id:get_id}, function(data){
			getMessages();
			$('#msg').val('');
			console.log('traitement du message en cours');
		});
		console.log('envoi message effectué');

	});
});
