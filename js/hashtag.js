$(function(){
  
  // REGEX pour vérifier que le mot saisit est un hashtag

  var regex = /[#|@](\w+)$/ig;
  
  // vérification 
    $(document).on('keyup','.status', function(){
      var content = $.trim($(this).val());
      var text = content.match(regex);
      var max = 255;

      // si le texte existe on ajout text rentré et hashtag
      if(text != null){
        var dataString = 'hashtag='+text;


        // requête AJAX qui va permettre d'envoyer le hashtag en traitement
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

            })
          }
        })
      }else{
        $('.hash-box li').hide();
      }
    
    });
  });
  
  
  