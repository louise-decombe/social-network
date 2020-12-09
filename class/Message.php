<?php 

Class Message extends User {

    private $db;

    public function __construct($db){
        $this->db = $db;
        $this->connect = $this->db->connectDb();

    }

    public function userData($id){
		$stmt = $this->connect->prepare('SELECT * FROM `users` WHERE `id` = :id');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ);
	}


  
        public function recentMessages($id){
          $stmt = $this->connect->prepare("SELECT * FROM `messages` LEFT JOIN users ON `messageFrom` = `id` AND `id_message` IN (SELECT max(`id_message`) FROM `messages` WHERE `messageFrom` = `id`) WHERE `messageTo` = :id and `messageFrom` = id GROUP BY `id` ORDER BY `id_message` DESC ");
          $stmt->bindParam(":id", $id, PDO::PARAM_INT);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    
         public function getMessages($messageFrom, $id){
          $stmt = $this->connect->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom` = `id` WHERE `messageFrom` =:messageFrom AND `messageTo` =:id OR `messageTo` =:messageFrom AND `messageFrom` =:id");
          $stmt->bindParam(":messageFrom", $messageFrom, PDO::PARAM_INT);
          $stmt->bindParam(":id", $id, PDO::PARAM_INT);
          $stmt->execute();
          $messages = $stmt->fetchAll(PDO::FETCH_OBJ);
          foreach ($messages as $message) {
            if ($message->messageFrom === $id) {
              echo '<div class="main-msg-body-right">
                  <div class="main-msg">
                    <div class="msg-img">
                      <a href="#"><img src="'.$message->photo.'"/></a>
                    </div>
                    <div class="msg">'.$message->message_content.'
                      <div class="msg-time">
                      </div>
                    </div>
                    <div class="msg-btn">
                      <a class="deleteMsg" data-message="'.$message->id_message.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                  </div>
                </div>';
            }else{
              echo '<div class="main-msg-body-left">
                <div class="main-msg-l">
                  <div class="msg-img-l">
                    <a href="#"><img src="'.$message->photo.'"/></a>
                  </div>
                  <div class="msg-l">'.$message->message_content.'
                

                  </div>
                 
                  <div class="msg-btn-l">
                    <a class="deleteMsg" data-message="'.$message->id_message.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </div>
                </div>
                <p>'.$message->firstname.'</p>
                <p>'.$message->lastname.'</p>
              </div> ';
            }
          }
        }

        public function ajoutMessage($id, $message, $get_id,$created_at)
        {
      
            $query = $this->connect->prepare("INSERT INTO messages (message, messageTo, messageFrom, created_at)
            VALUES(:id,:message, :get_id, :created_at)");
            $query->bindParam(':id', $id);
            $query->bindParam(':message', $message);
            $query->bindParam(':get_id', $get_id);
            $query->bindParam(':created_at', $created_at);
            $query->execute();
      
        
        }

    
        public function deleteMsg($id_message, $id){
          $stmt = $this->connect->prepare("DELETE FROM `messages` WHERE `id_message` =:id_message AND `messageFrom` =:id OR `id_message` =:id_message AND `messageTo` =:id");
          $stmt->bindParam(":id_message", $id_message, PDO::PARAM_INT);
          $stmt->bindParam(":id", $id, PDO::PARAM_INT);
          $stmt->execute();
        }
    
      
        public function create($table, $fields = array()){
          $columns = implode(',', array_keys($fields));
          $values  = ':'.implode(', :', array_keys($fields));
          $sql     = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
      
          if($stmt = $this->connect->prepare($sql)){
            foreach ($fields as $key => $data) {
              $stmt->bindValue(':'.$key, $data);
            }
            $stmt->execute();
            return $this->connect->lastInsertId();
          }
        }
       

        // il faut que je fixe ça l'upload ne marchep as surement le chemin -> j'ai repris le chemin d'un code pour faire ça.
    	public function uploadImage($file){
          $filename   = $file['name'];
          $fileTmp    = $file['tmp_name'];
          $fileSize   = $file['size'];
          $errors     = $file['error'];
    
          $ext = explode('.', $filename);
          $ext = strtolower(end($ext));
           
           $allowed_extensions  = array('jpg','png','jpeg');
      
          if(in_array($ext, $allowed_extensions)){
              
              if($errors ===0){
                  
                  if($fileSize <= 2097152){
    
                       $root = 'uploads/' . $filename;
                         move_uploaded_file($fileTmp,$_SERVER['DOCUMENT_ROOT'].'/social-network/'.$root);
                       return $root;
    
                  }else{
                          $GLOBALS['imgError'] = "trop gros";
                      }
              }
            }else{
                      $GLOBALS['imgError'] = " JPG, PNG JPEG autorisés";
                   }
       }
    
}