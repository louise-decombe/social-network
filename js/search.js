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


$(function(){
	$('.search2').keyup(function(){

        //console.log('ça fois 2');

		var search = $(this).val();
		$.post('http://localhost/social-network/php/search.php', {search:search}, function(data){
			$('.search-result2').html(data);
			if(search == ""){
				$('.search-result2').html("");
				$('.search-result2 li').click(function(){
					$('.search-result2 li').hide();
				});	
			}
		});
	});

});