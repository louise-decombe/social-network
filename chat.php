
<?php $page_selected = 'chat'; 
   session_start();
   ?>
<html>
   <body>
      <?php
         include("includes/header.php");
         ?>
         
      <main>
         <!-- profile de l'utilisateur connecté -->
         <div class="container">
            <div class="row">
               <div class="col-sm-4 open">
                  <div class="user-profile">
                     <img src="images/default-profile.png" class="circle-profile" alt="image-profil">
                     <h4>Prénom Nom</h4>
                     <div class="horizontal"></div>

                     <h3>MESSAGERIE...</h3>
                     <!-- recherche d'un message d'une conv -->
                     <div class="input_container">
                     <span class="input_icon"><i class="fa fa-search" aria-hidden="true"></i></span>

                     <input type="text" name="search-message" placeholder="chercher un message...">
                    </div>  
               
                 </div>

                  <!-- discussions en cours -->
                  <div class="open-discussion">
                     <img src="images/default-profile.png" class="circle-profile" alt="image-profil">
                     <div class="open-p">
                     <p>Nom prénom</p>
                     <p>dernier message il y a 2 jours</p>
                     </div>
                  </div>
                  <div class="open-discussion">
                     <img src="images/default-profile.png" class="circle-profile" alt="image-profil">
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
                     <img src="images/default-profile.png" class="circle-profile" alt="image-profil">
                     <h2>Prénom Nom</h2>
                     <p>En ligne il y a 5mn...
                     </p>
                  </div>
                  <div class="box-message">
                     <img src="images/default-profile.png" class="circle-profile" alt="image-profil">
                     <p> 
                        Vivamus facilisis magna enim, at rutrum lorem congue in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam vitae ligula eu nunc egestas fringilla. Nullam bibendum, lacus nec pellentesque pellentesque, mi ipsum ornare erat, ut rutrum enim nulla at lacus. Vestibulum interdum quis dui et dignissim. Nunc consectetur et mauris non gravida. 
                     </p>
                     <br/>
                  </div>
                  <p>Il y a 1h</p>

                  <div class="box-message">
                     <img src="images/default-profile.png" class="circle-profile" alt="image-profil">
                  </div>
                  <!-- form d'envoi de message  -->
                  <div class="form-send-message">
                     <form action="post">
                        <textarea name="" placeholder="votre message..." id="message">
                        </textarea>
                        <button class="btn-envoyer"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
      <script src="js/chat.js"></script>


      