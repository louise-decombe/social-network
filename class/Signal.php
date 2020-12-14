<?php

class Signal{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    }

    public function GetAllPostSignal(){
        $requete = $this->connect->prepare("SELECT users.firstname, users.lastname, post.content, count(post.id) as nbr ,post.id AS id_post, signal_post.id AS id_signal ,date_format(post.created_at,'%d/%m/%Y') AS date_created FROM signal_post INNER JOIN post ON signal_post.id_post = post.id INNER JOIN users ON users.id = post.id_user group by signal_post.id_post ");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function DeletePostsSignal($id){
        $requete = $this->connect->prepare("DELETE FROM `signal_post` WHERE id_post = ?");
        $requete->execute([$id]);
        return true;
    }
    public function CancelSignalPost($id){
        $requete = $this->connect->prepare("DELETE FROM `signal_post` WHERE id = ?");
        $requete->execute([$id]);
        return true;  
    }

  
}

class Signal_comment{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    }
    public function GetAllCommentSignal(){
        $requete = $this->connect->prepare("SELECT users.firstname, users.lastname, comment.content, count(comment.id) as nbr ,comment.id AS id_comment, signal_comment.id AS id_signal_comment ,date_format(comment.created_at,'%d/%m/%Y') AS date_created FROM comment INNER JOIN signal_comment ON signal_comment.id_comment = comment.id INNER JOIN users ON users.id = comment.id_user group by signal_comment.id_comment ");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function CancelSignalComment($id){
        $requete = $this->connect->prepare("DELETE FROM `signal_comment` WHERE id = ?");
        $requete->execute([$id]);
        return true;  
    }
   
}


?>