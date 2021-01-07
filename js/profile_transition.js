$(document).ready(function(){

        $(".lien").click(function(e) {
          e.preventDefault();
          var content = $(this).html();
          alert(content);
        });
    
});

   /*$("#profile_relations").on("click", function(event){

            $("#profile_publications").hide('');
            $(".profile_content").load('profile_relations.php');
        });
        $("#profile_pub").on("click", function(event){

$("#profile_realations").hide('');
$(".profile_content").load('profile_relations.php');
});*/

