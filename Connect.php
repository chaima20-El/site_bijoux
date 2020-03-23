<!doctype html>
<html lang="en">

<head>
    <title>Bijoux_FHE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="ACCUEIL.css">

</head>

<body>

    <div class="jumbotron">
        <div class="container register-form">
            <div class="form">
                <div class="note">
                    <p>Bienvenu </p>
                </div>
                <form method="post" action="Connect.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="Nom" id="Nom" class="form-control" placeholder="Nom et Prenom"
                                    value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="password"
                                    value="" />
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <input type="text" name="Prenom" id="Prenom" class="form-control" placeholder="username"
                                    value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" name="repeatpassword" class="form-control"
                                    placeholder="repeatpassword" value="">
                            </div>

                            <br><br>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Valider">

                </form>

                <?php
   
if (isset($_POST['submit']))
{
   
$Nom = htmlspecialchars(trim($_POST['Nom']));
$Prenom = htmlspecialchars(trim($_POST['Prenom']));

$password = htmlspecialchars(trim($_POST['password']));
$repeatpassword = htmlspecialchars(trim($_POST['repeatpassword']));
   
if ($Nom&&$Prenom&&$password&&$repeatpassword)
        {
        if (strlen($password)>=6)
            {
                if ($password==$repeatpassword)
                {

            // On crypte le mot de passe
               $password = md5($password);

    $serveur = "localhost";
    $dbname = "id13014500_ex_db";
    $user = "id13014500_root	";
    $pass = "chaimaelmejgari";
    
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $password = $_POST["password"];
    
    
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //On insère les données reçues
        $sth = $dbco->prepare("
            INSERT INTO user(nom, prenom, password)
            VALUES(:Nom, :Prenom, :password)");
        $sth->bindParam(':Nom',$Nom);
        $sth->bindParam(':Prenom',$Prenom);
        $sth->bindParam(':password',$password);
        $sth->execute();
        
        //On renvoie l'utilisateur vers la page de remerciement
        header("Location:index");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
  
}else echo "Les mots de passe ne sont pas identiques";
}else echo "Le mot de passe est trop court !";
}else echo "Veuillez saisir tous les champs !";
   
}
?>

            </div>
        </div>

    </div>
    <?php
     include("menu/menu.php")
  ?>
</body>

</html>