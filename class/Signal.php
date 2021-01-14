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
        $requete = $this->connect->prepare("DELETE FROM `signal_post` INNER JOIN post ON signal_post.id_post = post.id  WHERE id_post = ?");
        $requete->execute([$id]);
        return true;
    }
    public function CancelSignalPost($id){
        $requete = $this->connect->prepare("DELETE FROM `signal_post` WHERE id = ?");
        $requete->execute([$id]);
        return true;  
    }

    public function setSignal($id_post,$id_user){
        $requete = $this->connect->prepare("INSERT INTO `signal_post`( `id_post` , id_user) VALUES (?,?)");
        $requete->execute([$id_post,$id_user]);
        return true;
    }

    public function GetPostSignal($id_user,$id_post){
        $requete = $this->connect->prepare("SELECT * FROM `signal_post` WHERE id_user = ? AND id_post= ?");
        $requete->execute([$id_user,$id_post]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
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

    public function GetCommentSignal($id_user,$id_comment){
        $requete = $this->connect->prepare("SELECT * FROM `signal_comment` WHERE id_user=? and id_comment=?");
        $requete->execute([$id_user,$id_comment]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function setCommentSignal($id_user,$id_comment){
        $requete = $this->connect->prepare("INSERT INTO `signal_comment`( `id_comment`, `id_user`) VALUES (?,?)");
        $requete->execute([$id_comment,$id_user]);
        return true;
    }
   
}


?>