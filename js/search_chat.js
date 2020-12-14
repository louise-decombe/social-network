$(document).on('keyup', '.search-user', function(){
    $('.message-recent').hide();
    var search = $(this).val();
    $.post('http://localhost/social-network/php/chat_search.php', {search:search}, function(data){
        $('.message-body').html(data);
    });
});
