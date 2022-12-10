
<?php

include 'header.php'; // HEADER FILE LINK
include 'connect.php'; // BDD CONNECT


if(isset($_POST['submit'])){ // if user click on the button
    if($_POST['login'] > 3){ // if input are not null
        $login = htmlspecialchars($_POST['login']);
        $pass1 = htmlspecialchars($_POST['password']);
        $pass2 = htmlspecialchars($_POST['confirmation_password']);

        $sql ='SELECT * FROM utilisateurs WHERE login = :login';
        $sql_exe = $conn->prepare($sql);// so prepare request for search if login is taken
        $sql_exe->bindParam(':login', $login);
        $sql_exe->execute();
        $results = $sql_exe->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            echo "<p id='error'>Ce login est déjà pris</p>";
        } else {
            if ($pass1 == $pass2) {
                $request = $conn->prepare("INSERT INTO utilisateurs(login, password) VALUES(:login, :password)");
                $results = $request->execute(array(
                    'login' => htmlspecialchars($_POST['login']), // htmlspecialchars() is used to avoid Cross-site scripting (XSS) attacks
                    'password' => password_hash($_POST['password'], PASSWORD_BCRYPT) // password_hash() is used to hash password
                ));
                echo "<p id='valid'>Votre inscription est un succès</p>";
                header("Refresh:1; url=connexion.php");
            } else {
                echo "<p id='error'>Les mots de passe ne correspondent pas !";
            }
        }

    }else{
        echo "Veuillez remplir tous les champs";
    }
}


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" type="text/css" href="or-style.css">
</head>
<body>

<h1> Formulaire d'inscription </h1>
<form action="inscription.php" name='register' method='POST'>
    <fieldset>
        <legend> Informations personnelles de l'utilisateur </legend>
        <label for="login">Votre login </label> <br>
        <input type = "text" name="login" id="login" required> <br>
        <label for="password">Mot de passe</label> <br>
        <input type = "password" name="password" id="password" required> <br>
        <label for="confirmation_password">Confirmer votre mot de passe</label> <br>
        <input type = "password" name="confirmation_password" id="confirmation_password" required> <br>
        <br><button type="submit" name="submit" value = "inscription">S'inscrire</button>
    </fieldset>
</form>
<?php include 'footer.php'?>
</body>
</html>

