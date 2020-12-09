
<?php 

Class Hashtag  {

    private $db;

    public function __construct($db){
        $this->db = $db;
        $this->connect = $this->db->connectDb();

    }

    // fonction qui récup et affiche les hashtag en autocompletion ensuite
	public function getHashtag($hashtag){
		$stmt = $this->connect->prepare("SELECT * FROM `hashtag_trend` WHERE `hashtag` LIKE :hashtag LIMIT 5");
		$stmt->bindValue(":hashtag", $hashtag.'%');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

//method qui ajoute un hashtag s'il n'existe pas
	public function addTrend($hashtag){
		preg_match_all("/#+([a-zA-Z0-9_]+)/i", $hashtag, $matches);
		if($matches){
			$result = array_values($matches[1]);
		}
		$sql = "INSERT INTO `hashtag_trend` (`hashtag`) VALUES (:hashtag)";
		foreach ($result as $trend) {
			if($stmt = $this->connect->prepare($sql)){
				$stmt->execute(array(':hashtag' => $trend));
			}
		}
    }


    //method qui récupère les post qui contiennent le hashtag -> surement un JOIN entre les tables de post et de hashtag
    public function getHashtagPosts($hashtag){
	
	}

        //method qui récupère les utilisateurs qui utilisent le hashtag -> surement un JOIN entre les tables de user et de hashtag

	public function getUsersHashtag($hashtag){
	
	}
    
}