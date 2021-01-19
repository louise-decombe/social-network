<?php 
   // Dans cette page se trouve tout le traitemetn PHP du chat qui utilise la class Message. 
   
   
   session_start();
   // pour le moment la variable de session est en dur
   //$_SESSION['id'] = 1;
       include '../class/Config.php';
   
   	// on utilise la méthode supprimer 
   	if(isset($_POST['deleteMsg']) && !empty($_POST['deleteMsg'])){
   		$id   = $_SESSION['user']['id'];
   		$id_message = $_POST['deleteMsg'];
   		$message->deleteMsg($id_message, $id); 
   	}
   
   	// envoi du message en BDD
    	if(isset($_POST['sendMessage']) && !empty($_POST['sendMessage'])){
   
   		// if(!empty($_FILES['file']['name'][0])){
   		//	$img_chat = $message->uploadImage($_FILES['file']);
   		//  }
   
   
   		 $id  = $_SESSION['user']['id'];
   		 //$_SESSION['id'];
   		 $message  = $_POST['sendMessage'];
   		 $get_id   =  $_POST['get_id'];
    		if(!empty($message)){
    			$date = date('Y-m-d H:i:s');
    			$search->create('messages', array('messageTo' => $get_id, 'messageFrom' => $id, 'message_content' => $message, 'created_at' => $date));
   
    		}
    	}
   
   	 // on récup les msg en bdd
   	if(isset($_POST['showChatMessage']) && !empty($_POST['showChatMessage'])){
   		$id = $_SESSION['user']['id'];
   		$messageFrom = $_POST['showChatMessage'];
   		$message->getMessages($messageFrom, $id);
   	}
   
   	//on affiche la sélection d'envoi de msg
   	if(isset($_POST['showMessage']) && !empty($_POST['showMessage'])){
           $id = $_SESSION['user']['id'];
   		$messages = $message->recentMessages($id);
     		?>
<div class="popup-message-wrap">
   <input id="popup-message" type="checkbox" checked="unchecked"/>
   <div class="container-chat">
      <div class="message-send">
         <div class="message-header">
            <div class="message-h-left">
               <label for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
            </div>
            <div class="message-h-cen">
               <h4>Nouveau message</h4>
            </div>
            <div class="message-h-right">
               <label for="popup-message" ><i class="fa fa-times" aria-hidden="true"></i></label>
            </div>
         </div>
         <div class="message-input">
            <!-- envoi d'un message à un utilisateur désigné -->
            <h4>Envoyer un message à:</h4>
            <input type="text" placeholder="Chercher un utilisateur" class="search-user"/>
            <ul class="search-result down">
            </ul>
         </div>
         <div class="message-body">
            <h4>Récent</h4>
            <div class="message-recent">
               <?php
                  // cette boucle affiche le msg déjà existants : seulement les derniers des dernières conv -> seulement l'expéditeur.
                  foreach($messages as $message) :?>
               <div class="user-message" data-user="<?php echo $message->id;?>">
                  <div class="user-inner">
                     <div class="user-img">
                        <img src="<?php echo $message->photo;?>"/>
                     </div>
                     <div class="name-right2">
                        <span><a href="#"><?php echo $message->firstname;?></a></span><span><?php echo $message->lastname;?></span>
                     </div>
                     <span>
                     <?php echo 'le'.$message->created_at; ?>
                     </span>
                  </div>
               </div>
               <?php endforeach;?>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="js/search.js"></script>
      <!-- si l'inpu est checké on peut faire apparaître le nouveau chat -->
      <input id="mass" type="checkbox" checked="unchecked" />
      <div class="back">
         <div class="back-header">
            <div class="back-left">
               Chat avec 
            </div>
            <div class="back-right">
               <label for="mass"  class="new-message-btn">Nouveau messages</label>
               <label for="popup-message"><i class="fa fa-times" aria-hidden="true"></i></label>
            </div>
         </div>
         <div class="back-inner">
            <div class="back-body">
               <?php
                  // id du msg dans sa boucle + 
                  foreach($messages as $message) :?>
               <div class="user-message" data-user="<?php echo $message->id;?>">
                  <div class="user-inner">
                     <div class="user-img">
                        <img src="<?php echo $message->photo;?>"/>
                     </div>
                     <div class="name-right2">
                        <span><a href="#"><?php echo $message->firstname;?></a></span><span><?php echo $message->lastname;?></span>
                     </div>
                     <div class="msg-box">
                        <?php echo $message->message_content;?>
                     </div>
                     <span>
                     <?php echo $message->created_at;?>	
                     </span>
                  </div>
               </div>
               <?php endforeach;?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   }
   
   if(isset($_POST['showChatPopup']) && !empty($_POST['showChatPopup'])){
   	$messageFrom = $_POST['showChatPopup'];
   	$id     = $_SESSION['id'];
   	$user        = $message->userData($messageFrom);
   	?>
<div class="popup-message-body-wrap">
   <input id="popup-message" type="checkbox" checked="unchecked"/>
   <input id="message-body" type="checkbox" checked="unchecked"/>
   <div class="wrap">
      <div class="message-send2">
         <div class="message-header2">
            <div class="message-h-left">
               <label class="back-messages" for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
            </div>
            <div class="message-h-cen">
               <div class="message-head-img">
                  <img src="<?php echo $user->photo;?>"/>
                  <p>Chat avec <?php echo $user->firstname; echo $user->lastname?></p>
               </div>
            </div>
            <div class="message-h-right">
               <label class="close-msgPopup" for="message-body" ><i class="fa fa-times" aria-hidden="true"></i></label> 
            </div>
         </div>
         <div class="message-delete">
            <div class="message-delete-inner">
               <h4> Voulez vous vraiment supprimer ce message ?</h4>
               <div class="message-delete-box">
                  <span>
                  <button class="cancel" value="Cancel">Annuler</button>
                  </span>
                  <span>	
                  <button class="delete" value="Delete">Supprimer</button>
                  </span>
               </div>
            </div>
         </div>
         <div class="main-msg-wrap">
            <div id="chat" class="main-msg-inner">
            </div>
         </div>
         <!-- ici form qui ENVOI le msg. + upload img si nécessaire -->
         <div class="main-msg-footer">
            <div class="main-msg-footer-inner">
            <div class="send">  
            <ul>
                  <li><textarea id="msg" class="question" name="msg" placeholder="Ecrivez le message" ></textarea></li>
                  <!-- upload d'image dans le chat 
                  <li><input id="msg-upload" type="file" value="upload"/><label for="msg-upload"><i class="fa fa-camera" aria-hidden="true"></i></label></li> -->
                  <li>
                     <input class="" id="send" data-user="<?php echo $messageFrom;?>" type="submit" value="Send"/></li>
               </ul>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php	
   }
   ?>