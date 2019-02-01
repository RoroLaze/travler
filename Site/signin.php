

<?php 

$link = mysqli_connect('sqletud.u-pem.fr','root','hlytras','marronette');
        mysqli_set_charset($link, "utf8");
        $sql = 'SELECT * FROM Utilisateur';
        $req = mysqli_query($link, $sql)
            or die('Erreur SQL !<br>'.$sql.'<br>'.mysqli_error($link)); 

              if(isset($_POST['email'])){$email=$_POST['email'];
            } else {$email = "";}
            if(isset($_POST['mdp'])){$mdp=$_POST['mdp'];
            } else {$mdp = "";}

            
              
             if(empty($email) OR empty($mdp)){
            echo '<font color="red">Attention, un des champs est vide</font>';
            } else {


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