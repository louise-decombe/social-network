<?php 

session_start();
	include ('../class/Config.php');
	if(isset($_POST['search']) && !empty($_POST['search'])){
		$id = $_SESSION['id'];
		$search  = $_POST['search'];
		$result  = $user->search($search);
		echo '<h4>Utilisateur</h4><div class="message-recent"> ';
		foreach ($result as $user) {
			if($user->id != $id){
				
			echo '<div class="user-message" data-user="'.$user->id.'">
								<span><a>'.$user->firstname.'</a></span><span>'.$user->lastname.'</span>
					
					 </div>
					 </div>';
			}
		}
		echo '</div>';
	}

?>

<script src="../js/search.js"></script>
<script src="../js/chat.js"></script>