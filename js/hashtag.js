$(function(){
    var regex = /[#|@](\w+)$/ig;
  
    console.log('ça marche');
    $(document).on('keyup','.status', function(){
      var content = $.trim($(this).val());
      var text = content.match(regex);
      var max = 255;
      console.log('ça marche2');

      if(text != null){
        var dataString = 'hashtag='+text;
        console.log('ça marche3');

        $.ajax({
          type: "POST",
          url: "http://localhost/social-network/php/traitement_hashtag.php",
          data: dataString,
          cache: false,
          success: function(data){
            $('.hash-box ul').html(data);
            $('.hash-box li').click(function(){
              var value = $.trim($(this).find('.getValue').text());
              var avant = $('.status').val();
              var apres = avant.replace(regex, "");
  
              $('.status').val(apres+value+' ');
              $('.hash-box li').hide();
              $('.status').focus();
                console.log('ça marche4');

            })
          }
        })
      }else{
        $('.hash-box li').hide();
      }
    
    });
  });
  
  
  