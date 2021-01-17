<?php 

 include('../class/Config.php');

if(isset($_POST['search']) && !empty($_POST['search'])){
		$search3 = $search->checkInput($_POST['search']);
	$result = $search->search($search3);
		if(!empty($result)){
		echo '<ul> ';
		foreach ($result as $users) {
			echo '		 	
					<li>
				  		<div class="search-header-result">
                            <div class="photo-header-search">
								<a href="'.$users->firstname.'"><img src="'.$users->photo.'" width="30px"></a>
							</div>
									<a href="">'.$users->lastname. '  '.$users->firstname.'
                                    </a><hr>
							
						</div> 
					 </li> ';
		}
			echo '</div>';
		}
	}

?>