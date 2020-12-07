$(function(){
	$('.search').keyup(function(){

        //console.log('ça marche');

		var search = $(this).val();
		$.post('http://localhost/social-network/php/search.php', {search:search}, function(data){
			$('.search-result').html(data);
			if(search == ""){
				$('.search-result').html("");
				$('.search-result li').click(function(){
					$('.search-result li').hide();
				});	
			}
		});
	});

});

$(document).on('keyup', '.search-user', function(){
	$('.message-recent').hide();
	var search = $(this).val();
	$.post('http://localhost/social-network/php/chat_search.php', {search:search}, function(data){
		$('.message-body').html(data);
	});
});
