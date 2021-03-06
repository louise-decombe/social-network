


// montrer le chat

$(function(){
	$(document).on('click', '#messagePopup', function(){
		console.log('ok popup');
		var getMessages = 1;
		$.post('http://localhost/social-network/php/chat.php', {showMessage:getMessages}, function(data){
			$('.popupChat').html(data);
			$('#messages').hide();
  		});
	});

	//récup les données demandées de chaque conversation

	$(document).on('click', '.user-message', function(){
		var get_id = $(this).data('user');
		$.post('http://localhost/social-network/php/chat.php', {showChatPopup:get_id}, function(data){
			$('.popupChat').html(data);
			if(autoscroll){
				scrollDown();
			}
			$('#chat').on('scroll', function(){
				if($(this).scrollTop() < this.scrollHeight - $(this).height()){
					autoscroll = false;
				}else{
					autoscroll = true;
				}
			});

			//fermeture du chat
		$('.close-msgPopup').click(function(){
			 clearInterval(timer);
		});
		});



		getMessages = function(){
			$.post('http://localhost/social-network/php/chat.php', {showChatMessage:get_id}, function(data){
				$('.main-msg-inner').html(data);
				if(autoscroll){
					scrollDown();
				}
				$('#chat').on('scroll', function(){
					if($(this).scrollTop() < this.scrollHeight - $(this).height()){
						autoscroll = false;
					}else{
						autoscroll = true;
					}
				});
				$('.close-msgPopup').click(function(){
				   clearInterval(timer);
				});
			});
		}
		// ici interval rechargement page Ajax
		var timer = setInterval(getMessages, 4000);
		getMessages();


		// ici définition du scroll sur le chat
		autoscroll = true;
		scrollDown = function(){
			var chat  = $('#chat')[0];
 			if(chat !== undefined){
				$('#chat').scrollTop(chat.scrollHeight);
			}
		}

		$(document).on('click', '.back-messages', function(){
			var getMessages = 1;
			$.post('http://localhost/social-network/php/chat.php', {showMessage:getMessages}, function(data){
				$('.popupChat').html(data);
				clearInterval(timer);
			});	
		});

					//suppression message par l'utilisateur


		$(document).on('click', '.deleteMsg', function(){
			var id_message  = $(this).data('message');
			$('.message-delete-inner').height('100px');

			$(document).on('click', '.cancel', function(){
				$('.message-delete-inner').height('0px');
			});


			$(document).on('click', '.delete', function(){
				$.post('http://localhost/social-network/php/chat.php', {deleteMsg:id_message}, function(data){
					$('.message-delete-inner').height('');
					getMessages();
				})
			});

		});

	});

})



