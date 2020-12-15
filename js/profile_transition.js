$(document).ready(function(){

    $("#profile_category a").on("click", function(event){

        event.preventDefault();

        $.get('path_to/profile_relations.php', function (data) {
            $('.profile_content').append('<p>' + data + '</p>');
        });


    })

});