<?php 
session_start();
	include '../class/Config.php';
	if(isset($_POST['search']) && !empty($_POST['search'])){
		$id = $_SESSION['id'];
		$search  = $_POST['search'];
		$result  = $user->search($search);
		echo '<h4>People</h4><div class="message-recent"> ';
		foreach ($result as $user) {
			if($user->id != $id){
			echo '<div class="people-message" data-user="'.$user->id.'">
						<div class="people-inner">
							<div class="name-right">
								<span><a>'.$user->firstname.'</a></span><span>'.$user->lastname.'</span>
							</div>
						</div>
					 </div>';
			}
		}
		echo '</div>';
	}
?>