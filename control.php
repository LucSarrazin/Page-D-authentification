<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydata";


// créé une connexion
$conn = new mysqli($servername, $username, $password,$dbname);
$vide = "";

// Vérifier connexion
if ($conn->connect_error) {
  die("Connexion échouée : " . $conn->connect_error);
}
//echo "Connexion réussi \n";

if($_SERVER ['REQUEST_METHOD'] == 'POST'){
  $LoginSql = $_POST['Username'];

  
  $sql = "SELECT * FROM data WHERE Username = '$LoginSql'";
  $stmt = $conn->query($sql);
  $row = $stmt->fetch_assoc();

  if(!empty($_POST['Username']) && !empty($_POST['Password']) && $row['Username'] !=  $_POST['Username']){
    
    $vide = 1;
    $Login = $_POST['Username'];
    $Password = $_POST['Password'];
    $password_hash = password_hash($Password,  PASSWORD_DEFAULT);

    $sql = "INSERT INTO Data (Username,MDP) VALUES ('$Login', '$password_hash')";

    if ($conn->query($sql) === TRUE) {
        //echo "Nouvelle entrée créer avec succès !";
      } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
      }
      

  }
  else{
    $vide = 0;
    //echo "Tous les champs doivent être remplis ou le compte existe déjà!";
  }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
</head>
<body>
    <h1 id="Compte"><center>Merci d'avoir créer votre compte !</center></h1>
    <h1 id="Compte1"><center>Merci de remplir les instructions ou le compte existe déjà !</center></h1>
    <h1><center>Veuillez retourner à la page d'Authentification</center></h1>
    <center><button onclick="GoBack()">Retourner à la page précédente !</button></center>

<script language="JavaScript">
    vide = "<?= $vide ?>";
    compte = document.getElementById("Compte");
    compte1 = document.getElementById("Compte1");
    compte.style.display = 'none';
    compte1.style.display = 'none';

    if(vide == 0){
      compte.style.display = 'none';
      compte1.style.display = 'block';
    }
    else{
      compte1.style.display = 'none';
      compte.style.display = 'block';
    }

  function GoBack(){
    window.history.back();
  }
</script>

</body>
</html>