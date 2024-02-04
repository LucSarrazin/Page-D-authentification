<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydata";

// créé une connexion
$conn = new mysqli($servername, $username, $password,$dbname);
$Connexion = "";
$MotDePasse = "";
$Nom = "";

// Vérifier connexion
if ($conn->connect_error) {
    $Connexion = 0;
  die("Connexion échouée : " . $conn->connect_error);
}
$Connexion = 1;
//echo "Connexion réussi <br>";


if($_SERVER ['REQUEST_METHOD'] == 'POST'){
//echo "Teste get";
if(!empty($_POST['Username2']) && !empty($_POST['Password2'])){
    $Login = $_POST['Username2'];
    $Password = $_POST['Password2'];

    $sql = ("SELECT * FROM data WHERE Username = '$Login'");
    $stmt = $conn->query($sql);
    $row = $stmt->fetch_assoc();

    if (!empty($row['Username'])) {
       //echo "Bon nom";
        $Nom = 1;
    }
    else{
       // echo "Mauvais nom";
        $Nom = 0;
    }

    //echo "<br>";
    //echo $Password;

    if(password_verify($Password, $row['MDP'])){
        //echo "<br>";
        //echo "Mot de Passe valide !";
        $MotDePasse = 1;
    }
    else{
        //echo "<br>";
        //echo "Mot de passe invalide !";
        $MotDePasse = 0;
    }
}
else{
    echo "<script>document.write('');</script>";

    //echo "Alerte !";
}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion au compte</title>
</head>
<body>
    <h1 id="Bienvenue"><center>Bienvenue sur la page d'accueil !</center></h1>

    <h2 id="Connexion"><center>Connexion au serveur réussi !</center></h2>

    <h2 id="NOMvalide"><center>Nom valide !</center></h2>
    <h2 id="NOMFaux"><center>Nom Eronnée</center></h2>

    <h2 id="MDPvalide"><center>Mot de passe valide !</center></h2>
    <h2 id="MDPFaux"><center>Mot de passe Eronnée</center></h2>

<script language="JavaScript">
    
    ConnexionMessage = document.getElementById("Connexion");
    mdpvalide = document.getElementById("MDPvalide");
    mdpFaux = document.getElementById("MDPFaux");
    
    NOMvalide = document.getElementById("NOMvalide");
    NOMFaux = document.getElementById("NOMFaux");
    bienvenue = document.getElementById("Bienvenue");
    
    ConnexionMessage.style.display='none';
    mdpvalide.style.display='none';
    mdpFaux.style.display='none';
    NOMvalide.style.display='none';
    NOMFaux.style.display='none';
    bienvenue.style.display='none';

    Connexion = "<?= $Connexion ?>";
    Mdp = "<?= $MotDePasse ?>";
    Nom = "<?= $Nom ?>";
    nomU = "<?= $row['Username'] ?>";
    Connexion = parseInt(Connexion);
    

if(Connexion == 1){
    console.log(Connexion);
    ConnexionMessage.style.display='block';
}
else{
    console.log("Erreur de syncronisation !");
}
if(Nom == 1){
    console.log(Nom);
    NOMvalide.style.display='block';
}
else{
    console.log("Mauvais Nom d'utilisateur !");
    NOMFaux.style.display='block';
}
if(Mdp == 1){
    console.log(Mdp);
    mdpvalide.style.display='block';
}
else{
    
    mdpFaux.style.display='block';
    console.log("Mauvais MOT DE PASSE !");
}
if(Mdp == 1 && Nom == 1 && Connexion == 1){
    setTimeout(() => {
        ConnexionMessage.style.display='none';
        mdpvalide.style.display='none';
        mdpFaux.style.display='none';
        NOMvalide.style.display='none';
        NOMFaux.style.display='none';
        bienvenue.style.display='block';
        bienvenue.textContent = "Bienvenue sur la page d'accueil ! " + nomU;
    }, 3000);
}
</script>

</body>
</html>