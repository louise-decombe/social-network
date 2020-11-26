<?php session_start();
require "../class/Config.php";
require "../class/Cursus.php";

$cursus = new Cursus($db);

if (isset($_POST['action'] )){
  if ($_POST['action'] == "recuperation"){
    $resultat = $cursus->getCursus();
    echo json_encode($resultat);
  }

  if ($_POST['action'] == "delete"){
     $id = $_POST['id'];
     $resultat = $cursus->DeleteCursus($id);
   echo $resultat;
  }
}


if(isset($_POST['submit_cursus'])){
  //enregistrement
  $name = $_POST['nom_cursus'];
  if (!empty($name)){
      $cursus->InsertCursus($name);
      echo true;
  }else{
    echo "Le champs ne peut pas etre vide";
  }
  

}

if (isset($_POST['action']) && $_POST['action'] == "recuperation cursus par l'id"){
  $id = $_POST['id'];
  $resultat = $cursus->GetCursusById($id);
  echo json_encode($resultat);
}

if (isset($_POST["btn_update_cursus"])){

  $id = $_POST['id'];
  $nom = $_POST['updtate_nom_cursus'];
  $resultat = $cursus-> UpdateCursus($id,$nom);
  echo $resultat;
}

if (isset($_POST['oui'])){
  $id = $_POST['id'];
  $resultat = $cursus->DeleteCursus($id);
  echo $resultat;
 
}


?>