<?php


class Reactions{

    private $db;
    private $connect;
    

    public function __construct($db){
        $this->db = $db;
        $this->connect = $this->db->connectDb();

    }

    public function GetreactionByIdUser($id_user){
        $requete = $this->connect->prepare("SELECT * FROM `like_post` WHERE id_user = ? ");
        $requete->execute([$id_user]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;

    }

  
    public function GetreactionByIdUserAndIdPost($id_user,$id_post){
        $requete = $this->connect->prepare("SELECT * FROM `like_post` WHERE id_user = ? AND id_post = ?");
        $requete->execute([$id_user,$id_post]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;

    }


    public function GetreactionByReaction($id_post,$id_reaction){
        $requete = $this->connect->prepare("SELECT count(*)AS nbr FROM `like_post` WHERE id_reactions = ? AND id_post= ?");
        $requete->execute([$id_reaction,$id_post]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;

    }

    public function getAllreactionsByUser($id_user){
        $requete = $this->connect->prepare("SELECT * FROM `like_post` WHERE id_user = ? ");
        $requete->execute([$id_user]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function getAllreactions(){
        $requete = $this->connect->prepare("SELECT * FROM `like_post` ");
        $requete->execute();
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function getAllreactionsByIdPost($id_post){
        $requete = $this->connect->prepare("SELECT * FROM `like_post` INNER JOIN users ON like_post.id_user = users.id  WHERE id_post= ? ");
        $requete->execute([$id_post]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }
    

    public function SetReaction($id_user,$id_post,$id_reaction){
        $requete = $this->connect->prepare("INSERT INTO `like_post`( `id_user`, `id_post`, `id_reactions`) VALUES (?,?,?)");
        $requete->execute([$id_user,$id_post,$id_reaction]);
        return true;
    }

    public function DeleteReaction($id_post,$id_user){
        $requete = $this->connect->prepare("DELETE FROM `like_post` WHERE id_post = ? AND id_user= ?");
        $requete->execute([$id_post, $id_user]);
        return true;
    }

    public function UpdateReaction($id_reaction,$id_post,$id_user){
        $requete = $this->connect->prepare("UPDATE `like_post` SET `id_reactions`=? WHERE id_post = ? AND id_user = ?");
        $requete->execute([$id_reaction,$id_post,$id_user]);

    }


}

?>
