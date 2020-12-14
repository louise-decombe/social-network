<?php 
  include '../class/Config.php';


   if(isset($_POST['hashtag'])){	
   	  if(!empty($_POST['hashtag'])){


   	  	 $hashtag = $_POST['hashtag'];

		  if(substr($hashtag, 0,1) === '#'){
		  	 $trend   = str_replace('#', '', $hashtag);
		  	 $trend   = $tendance->getHashtag($trend);
			  
			   
		  	 foreach ($trend as $hashtag) {
		 	   echo '<li><a href="#"><span class="getValue">#'.$hashtag->hashtag.'</span></a></li>';
		  	 }
		   }

   	  
   	  }
   }
 
?>
