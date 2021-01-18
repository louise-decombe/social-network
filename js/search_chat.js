$(document).on('keyup', '.search-user', function(){
    console.log('oklmm');
    $('.message-recent').hide();
    var search = $(this).val();
    console.log('jusque la ca va');
    $.post('http://localhost/social-network/php/chat_search.php', {search:search}, function(data){
        $('.message-body').html(data);
    });
});
