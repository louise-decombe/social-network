<?php 

include('../class/Config.php');

if(isset($_POST['search']) && !empty($_POST['search'])){
		$search3 = $search->checkInput($_POST['search']);
		$result = $search->search($search3);
		if(!empty($result)){
		echo ' <div class="nav-right-down-wrap"><ul> ';
		foreach ($result as $users) {
			echo '		 	
					<li>
				  		<div class="nav-right-down-inner">
                            <div class="nav-right-down-left">
								<a href="'.$users->firstname.'"><img src="'.$users->photo.'"></a>
							</div>
							<div class="nav-right-down-right">
								<div class="nav-right-down-right-headline">
									<a href=""><p>'.$users->lastname.'</p><p>'.  $users->firstname.'</p>
                                    </a><hr>
								</div>
								<div class="nav-right-down-right-body">
								 
							    </div>
							</div>
						</div> 
					 </li> ';
		}
			echo '</ul></div>';
		}
	}

	if(isset($_POST['search']) && !empty($_POST['search'])){
		$search2 = $search->checkInput($_POST['search']);
		$result = $search->search($search2);
		if(!empty($result)){
		echo ' <div class="nav-right-down-wrap"><ul> ';
		foreach ($result as $users) {
			echo '		 	
					<li>
				  		<div class="nav-right-down-inner">
                            <div class="nav-right-down-left">
								<a href="'.$users->firstname.'"><img src="'.$users->photo.'"></a>
							</div>
							<div class="nav-right-down-right">
								<div class="nav-right-down-right-headline">
									<a href=""><p>'.$users->lastname.'</p><p>'.  $users->firstname.'</p>
                                    </a><hr>
								</div>
								<div class="nav-right-down-right-body">
								 
							    </div>
							</div>
						</div> 
					 </li> ';
		}
			echo '</ul></div>';
		}
	}
?>