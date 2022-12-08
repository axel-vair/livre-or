<?php

include 'header.php'; // HEADER FILE LINK
include 'connect.php'; // BDD CONNECT


    // If post login and post password are not empty
    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        /* Stock login, password and confirmation inside variables */
        $login = $_POST['login'];
        $pass1 = $_POST['password'];
        $pass2 = $_POST['confirmation_password'];
        /*
            #1 - Request query inside variable. I use parameter marker for avoid SQL injection.
            With PDO we don't include input inside the request, we use these markers for
            bind users inputs at this request.

            #2 - Then, we prepare the request. That's help to ovoid SQL injection because we
            don't need to protect params manually.

            #3 - We use bindValue or bindParam to binds the parameter to the marker. The first
            param is the marker used inside the prepare query, second the value to bind at this
            first param. We can add a third parameter : type of param.

            #4 - Finally we execute the query and we fetch the result and we specify we wanna
            fetch data inside FETCH_ASSOC.
        */
        $sql = "SELECT * FROM utilisateurs WHERE login = :login";
        $sql_exe = $conn->prepare($sql);
        $sql_exe->bindValue(':login', $login);
        $sql_exe->execute();
        $results = $sql_exe->fetch(PDO::FETCH_ASSOC);


        /*
            #1 - If results is not false, so user exist and display error message.

            #2 - Else, if password and confirmation password are the same prepare the request, execute it and
            redirect to connexion.php. Display success message, then redirect to connexion.php.

            #3 - Else we display error message
        */
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
<form action="inscription.php" name='register' method='post'>
    <fieldset>
        <legend> Informations personnelles de l'utilisateur </legend>
        <label for="login">Votre login </label> <br>
        <input type = "text" name="login" id="login" required> <br>
        <label for="password">Mot de passe</label> <br>
        <input type = "password" name="password" id="password" required> <br>
        <label for="confirmation_password">Confirmer votre mot de passe</label> <br>
        <input type = "password" name= "confirmation_password" id="confirmation_password" required> <br>
        <br><button type="submit" value = "inscription">S'inscrire</button>
    </fieldset>
</form>
<?php include 'footer.php'?>
</body>
</html>

