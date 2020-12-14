
<?php 
$_SESSION['id'] = 1;
?>
<html>
<head>
    <meta http-equiv="Content-Type" const="text/html;charset=UTF-8" />
    <!--Socket.io script nécessaire-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
      <script src="js/chat.js"></script>


    <title>chat socket</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php include('../includes/header.php') ?>
<body>
            <!-- profile de l'utilisateur connecté -->
            <div class="container">
            <div class="row">
               <div class="col-sm-4 open">
                  <div class="user-profile">
                     <img src="../uploads/default_avatar.png" class="circle-profile" alt="image-profil">
                     <h4>Prénom Nom</h4>
                     <div class="horizontal"></div>

                     <h3>MESSAGERIE...</h3>
                     <!-- recherche d'un message d'une conv -->
                     <div class="input_container">

					<input type="text" placeholder="Chercher un utilisateur"  class= "search2 form-control mr-sm-2"/>
					<div class="search-result2">
					</div>
				</li>

                    </div>  


               
                 </div>

                  <!-- discussions en cours 
                ici il me faut une boucle avec les utilisateurs -->
                  <div class="open-discussion">
                     <img src="../uploads/default_avatar.png" class="circle-profile" alt="image-profil">
                     <div class="open-p">
                     <p>Nom prénom</p>
                     <p>dernier message il y a 2 jours</p>
                     </div>
                     
                  </div>
                  <div class="open-discussion">
                     <img src="../uploads/default_avatar.png" class="circle-profile" alt="image-profil">
                     <div class="open-p">
                     <p>Nom prénom</p>
                     <p>dernier message il y a 2 jours</p>
                     </div>
                  </div>

               </div>
               <div class="col-sm-1">
                    <div class="separation"></div>            
                </div>

               <!-- discussion ouverte et active  -->
               <div class="col-sm-7">
                  <div class="head-discussion">
                     <img src="../uploads/default_avatar.png" class="circle-profile" alt="image-profil">
                     <h2>Prénom Nom</h2>
                     <p>En ligne il y a 5mn...
                     </p>
             
                  </div>
                            <!--Messages container-->
            <div id="chatroom">
                <!--un utilisateur tape quelque chose va ici-->
            </div>
            <div id="feedback"></div>

                  <!-- form d'envoi de message  -->
                  <div class="form-send-message">
                    
                     <div class="chat-wrapper">
            <div class="super-chat-title-container">
               
            </div>

          

            <!-- Input area (jedois rajouter une classe emoji pour que ça s'envoie mais pb du serveur on y reviens plus tard) -->
            <div id="input_zone">
                <input id="message" class="vertical-align custom-input " type="text" />
                <button id="send_message" class="vertical-align btn btn-envoyer" type="button"><i class="fa fa-paper-plane" aria-hidden="true" require></i></button>
            </div>
            <form action="/" enctype="multipart/form-data" method="post">
    <input type="file" name="upload" multiple>
    <input type="submit" value="Upload">
</form>
        </div>
                  </div>
               </div>
            </div>
         </div>
 
            <h4 class="modal-title">choix nom user</h4>
            <input id="nickname-input" class="custom-input" type="text" />


    <div class="">
        <!-- Left Column-->
        <div class="online-user-wrapper">
            <div class="online-user-header-container">
                <header>
                    <h2>Online Users</h2>
                </header>
            </div>
            <div>
                <!--Gens en ligne-->
                <ul id="users-list">

                </ul>
            </div>
        </div>
        <!--Chat  -->
     
    </div>

    <h1 id="socketio"> not connected </h1>
    <div id="display"> </div>
    <script src="../app.js"></script>

<script>
      var socket = io();
      socket.on('connect', function() {
        document.getElementById("socketio").innerHTML = "socket connected";
      });
      socket.on('showrows', function(rows) {
        var html='';
        for (var i=0; i<rows.length; i++) {
          html += rows[i].firstname + ' ' + rows[i].lastname + '<br>';
        }  
        document.getElementById("display").innerHTML = html;
        console.log(rows);
      });
    </script>
    
    <!--jQuery script-->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!--Scripts-->
    <script src="./chat.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
      <script src="../js/chat.js"></script>
      <script src="../js/search.js"></script>


</body>
</html>