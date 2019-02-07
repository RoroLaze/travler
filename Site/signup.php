
<?php 


            if(isset($_POST['nom'])){$nom=$_POST['nom'];
            } else {$nom = "";}
            if(isset($_POST['prenom'])){$prenom=$_POST['prenom'];
            } else {$prenom = "";}
            if(isset($_POST['pseudo'])){$pseudo=$_POST['pseudo'];
            } else {$pseudo = "";}
              if(isset($_POST['email'])){$email=$_POST['email'];
            } else {$email = "";}
            if(isset($_POST['mdp'])){$mdp=$_POST['mdp'];
            } else {$mdp = "";}
              if(isset($_POST['mdp2'])){$mdp2=$_POST['mdp2'];
            } else {$mdp2 = "";}
            
              
if(empty($nom) OR empty($prenom) OR empty($pseudo) OR empty($email) OR empty($mdp) OR empty($mdp2)){    
   echo '<font color="red">Attention, un des champs est vide</font>'; 
} else {   
 
    if ($mdp!=$mdp2) {
      echo '<font color="red">Mot de passe incorrect</font>'; 
    } else {

    
  $db = new PDO('mysql:host=localhost;dbname=travler;charset=utf8','root','');

  $req = $db ->query("INSERT INTO utilisateur (nom, prenom, pseudo, email, mdp) VALUES ('$nom', '$prenom', '$pseudo', '$email', '$mdp')");

  echo 'Vous avez été inscrits';


  header('Location: profil.php');

  // $query = "INSERT INTO utilisateur (id, nom, prenom, pseudo, email, mdp) VALUES ('', '$nom', '$prenom', '$pseudo', '$email', '$mdp')";  

}
}

?> 