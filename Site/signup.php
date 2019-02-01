

<?php 

$link = mysqli_connect('sqletud.u-pem.fr','root','hlytras','marronette');
        mysqli_set_charset($link, "utf8");
        $sql = 'SELECT * FROM Utilisateur';
        $req = mysqli_query($link, $sql)
            or die('Erreur SQL !<br>'.$sql.'<br>'.mysqli_error($link)); 

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
            
              
             if(empty($nom) OR empty($prenom) OR empty($email) OR empty($pseudo) OR empty($texte) OR empty($sexe)){
            echo '<font color="red">Attention, un des champs est vide</font>';
            } else {

            $sql = "INSERT INTO Utilisateur(id,nom,prenom,pseudo,email,mpd,mdp2) VALUES('','$nom',
            '$prenom','$pseudo','$email','$mdp','$mdp2',)";
               
            mysqli_query($link,$sql);
            or die('Erreur SQL !'.$sql.'<br>'.mysqli_error($link));
            
            echo 'Merci';
            
            mysqli_close($link);
            }
?>


<html>
<body>


Welcome <?php echo $_POST["name"]; ?><br>
Your email address is: <?php echo $_POST["email"]; ?>

</body>
</html>