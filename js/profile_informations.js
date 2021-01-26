/*----------------------------------------------------*/
/* MESSAGES
------------------------------------------------------ */

const modification_ok = "la modification a bien été prise en compte";
const modification_ko = "la modification n'a pas pu être effectuée";
const site_error = "veuillez entrer une adresse url valide";
const error_input = "veuillez entrer une valeur pour la valider la modification";


/*----------------------------------------------------*/
/* UPLOAD PROFILE PIC
------------------------------------------------------ */
$(document).ready(function() {

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //console.log(input.files[0].size)
            reader.onload = function (e) {
                console.log(e)
                $('.profile-pic').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $(".file-upload").on('change', function(){
        console.log(this.files[0]);
        readURL(this);
        /*var photo = (this.files[0].name);
        var type = (this.files[0].type);
        var size = (this.files[0].size);
        var id_user = $('.id_user').val();*/

        $(".upload-button").remove();
        $("#button_pic_profile").css("visibility", "visible");
        $("#button_pic_profile").css("background-color", "#88c1d0");
        //$(".upload-button").append();
        
    });
    
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
/*----------------------------------------------------*/
/* UPLOAD COVER PIC
------------------------------------------------------ */
$(document).ready(function() {

    var readCover = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //console.log(input.files[0].size)
            reader.onload = function (e) {
                console.log(e)
                $('.cover-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".cover-upload").on('change',function(){
        console.log(this.files[0]);
        readCover(this);

        $(".upload-cover").remove();
        $(".submit-cover").css("visibility", "visible");
        $(".submit-cover").css("background-color", "#88c1d0");
        
    });

    $(".upload-cover").on('click', function() {
        $(".cover-upload").click();
    });
    
});


/*----------------------------------------------------*/
/* LOCALITE AUTOCOMPLETION
------------------------------------------------------ */
//console.log('document ok')
$(document).ready(function () {

    $('#modify_city').keyup(function () {

        var nom = $(this).val();
        //alert(nom);

        $.ajax({
            url: "https://geo.api.gouv.fr/communes", // on donne l'URL du fichier de traitement
            type: "get", // la requête est de type POST
            dataType: 'json',
            data: ({ nom: nom }),// et on envoie nos données
            success: function (response) {
                console.log(response);

                $('#result_city ul').empty();

                $.each(response, function (i) {

                    nomCity = response[i].nom;
                    console.log(nomCity);

                    $('#result_city ul').append('<li>' + response[i].nom + '</li>');
                });

                $('#result_city ul li').mouseover(function (event) {

                    console.log($(this))
                    $(this).css("background-color", "yellow");
                    $(this).click(function (event) {
                        console.log(event)
                        //$('#modify_city').val('');
                        $('#modify_city').val(event.target.innerText);
                        $('#result_city ul li').remove();
                    });
                });
            }
        });
    });
});

/*----------------------------------------------------*/
/* LOCALITE UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_localite').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_localite = $(this).find("input[name=modify_city]").val();
        //alert(id_user);
        //alert(new_localite);

        if(new_localite == ''){

            $('#message_city').append(error_input);

        }else{

            $('#message_city').empty();

            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_localite: new_localite}),// et on envoie nos données
                success:function(response){
                    
                    response = response.replace(/\s/g, ''); 
                    console.log(response);
                    //alert(response);

                    if(response == 'city'){

                    $('#user_city').empty();
                    $('#user_city').append('&nbsp;' + new_localite);
                    $('#message_city').append(modification_ok);

                    }else{

                    $('#message_city').append(modification_ko);

                    }
                    
                }
            });

        }
                        
    });
});

/*----------------------------------------------------*/
/* CURSUS UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_cursus').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_cursus = $('#modify_cursus').val();
        //alert(new_cursus);
        var name_cursus = $(this).find('option:selected').attr("name");
        //alert(name_cursus);



        if(new_cursus == 'Sélectionner le cursus'){

            $('#message_cursus').append(error_input);

        }else{

            $('#message_cursus').empty();
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_cursus: new_cursus}),// et on envoie nos données
                success:function(response){
                    
                    response = response.replace(/\s/g, ''); 
                    console.log(response);
                    //alert(response);

                    if(response == 'cursus'){
                        
                        $('#user_role').empty();
                        $('#user_role').append('&nbsp;' + name_cursus);
                        $('#message_cursus').append(modification_ok);
                     
                    }else{

                        $('#message_cursus').append(modification_ko);
    
                    }
                    
                }
            });
        };
    });
});

/*----------------------------------------------------*/
/* ENTREPRISE UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_entreprise').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_entreprise = $('#modify_entreprise').val();
        //alert(new_entreprise);

        if(new_entreprise == ''){

            $('#message_entreprise').append(error_input);

        }else{

            $('#message_entreprise').empty();
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_entreprise: new_entreprise}),// et on envoie nos données
                success:function(response){
                    response = response.replace(/\s/g, ''); 
                    console.log(response);
                    //alert(response);

                    if(response == 'entreprise'){

                    $('#user_cie').empty();
                    $('#user_cie').append('&nbsp;' + new_entreprise);
                    $('#message_entreprise').append(modification_ok);

                    }else{
                        
                    $('#message_entreprise').append(modification_ko);

                    }
                    
                }
            });
        };
    });
});

/*----------------------------------------------------*/
/* WEBSITE UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_site').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
          
        var urlregex = /^(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])+(.[a-z])?/;
        var id_user = $(this).find("input[name=id_user]").val();
        var new_website = $('#modify_website').val();;
        //alert(new_website);

        if(new_website == ''){

            $('#message_site').append(error_input);

        }else if (!(new_website).match(urlregex)){

            //alert(new_website);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_website: new_website}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    alert(response);

                    $('#user_website').empty();
                    $('#user_website').append(new_website);
                    $('#message_site').append(modification_ok);
                }
            });
            }else{
                $('#message_site').append(site_error);
            };
         
        });
});

/*----------------------------------------------------*/
/* BIO UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_bio').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_bio = $('#modify_bio').val();;
        //alert(new_bio);

        if(new_bio == ''){

            $('#message_bio').append(error_input);

        }else{
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_bio: new_bio}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);

                    $('#user_details_bio').empty();
                    $('#user_details_bio').append(new_bio);
                    $('#message_bio').append(modification_ok);
                    
                }
            });
        }
    });
});

/*----------------------------------------------------*/
/* HOBBIES UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_hobbies').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_hobbies = $('#modify_hobbies').val();
        alert(new_hobbies);

        if(new_hobbies == ''){

            $('#message_hobbies').append(error_input);

        }else{
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_hobbies: new_hobbies}),// et on envoie nos données
                success:function(response){
                    response = response.replace(/\s/g, ''); 
                    console.log(response);
                    //alert(response);


                    $('#user_loisirs').empty();
                    $('#user_loisirs').append(new_bio);
                    $('#message_hobbies').append(modification_ok);

                    
                }
            });
        }
    });
});


/*----------------------------------------------------*/
/* BIRTHDAY UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_birthday').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_birthday = $('#modify_birthday').val();

        //alert(new_birthday);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_birthday: new_birthday}),// et on envoie nos données
                success:function(response){

                    response = response.replace(/\s/g, ''); 
                    console.log(response);

                    if(response == 'birthday'){
                    //alert(response);
                    $('#user_birth').empty();
                    $('#user_birth').append(new_birthday);
                    $('#message_birthday').append(modification_ok);

                    }else{

                    $('#message_birthday').append(modification_ko);

                    }
                }
            });
    });
});

/*----------------------------------------------------*/
/* SKILLS UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_tech').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        //var checkedValue = $('.techCheckbox:checked').val();
        var new_tech = [];

        $(".techCheckbox").each(function(){
            if ($(this).is(":checked")) {
                new_tech.push($(this).val());
            }
        });

        /*$('.techCheckbox:checked').each(function() {
            //console.log(this.value);
            alert(this.value);
         });*/

         if (id_user !=="" && new_tech.length > 0) {
            $.ajax({
              url : "php/form_profile.php",
              type: "POST",
              cache: false,
              data : {id_user:id_user,new_tech:new_tech},
              success:function(result){
                if (result==1) {
                    $("#user_tech").trigger("reset");
                    alert("Data insert in database successfully");
                }
              }
            });
          }else{
            alert("Fill the required fields");
          }
                    
    });
});

/*----------------------------------------------------*/
/* FOLLOW
------------------------------------------------------ */

$(document).ready(function(){

    $('#button_follow').click(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
         
        var id_user = $('#id_user').val();
        var id_user_follow = $('#id_user_follow').val();
        //alert(id_user_follow);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, id_user_follow: id_user_follow}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    $('#button_follow').empty();
                    $('#button_follow').append('suivi');
                    window.location.href = window.location.href; 
                    
                }
            });
    });
});

/*----------------------------------------------------*/
/* UNFOLLOW
------------------------------------------------------ */

$(document).ready(function(){

    $('#button_unfollow').click(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
         
        var id_user = $('#id_user').val();
        var id_user_unfollow = $('#id_user_follow').val();
        //alert(id_user_unfollow);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, id_user_unfollow: id_user_unfollow}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    $('#button_follow').empty();
                    $('#button_follow').append('follow');
                    window.location.href = window.location.href; 
                    
                }
            });
    });
});

/*----------------------------------------------------*/
/* CHARGEMENT DIV MODIFICATION PARAMÈTRES PERSOS
------------------------------------------------------ */
$(document).ready(function(){

    $('#contentParameters').click(function(e){
        console.log('ruben');
        var id_user = $(".id_user").val();

        $.ajax({
            url : "operation3.php",
            type : "POST", // la requête est de type POST
            data : ({id_user: id_user}),// et on envoie nos données

            success: function(data){
                $("#profile_publications").empty();
                    let form_content = $(data).find("#essai");
                    $("#profile_publications").append(data);
                    //$(form_content).fadeIn(350);
                console.log(data);
                
            }
            
        })

    });


});






