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

